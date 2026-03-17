<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Webhook;

class CheckoutController extends Controller
{
    public function createIntent(Request $request)
    {
        $request->validate([
            'shipping_address' => ['required', 'array'],
            'billing_address'  => ['nullable', 'array'],
        ]);

        $items = CartItem::with('product')
            ->where('user_id', $request->user()->id)
            ->get();

        if ($items->isEmpty()) {
            return response()->json(['message' => 'Cart is empty'], 422);
        }

        $subtotal = $items->sum('subtotal');
        $tax      = round($subtotal * 0.08, 2);
        $shipping = $subtotal >= 50 ? 0 : 9.99;
        $total    = round(($subtotal + $tax + $shipping) * 100); // cents

        Stripe::setApiKey(config('services.stripe.secret'));

        $intent = PaymentIntent::create([
            'amount'   => $total,
            'currency' => 'usd',
            'metadata' => ['user_id' => $request->user()->id],
        ]);

        // Store pending order
        $order = Order::create([
            'user_id'                  => $request->user()->id,
            'status'                   => 'pending',
            'subtotal'                 => $subtotal,
            'tax'                      => $tax,
            'shipping'                 => $shipping,
            'total'                    => $subtotal + $tax + $shipping,
            'payment_method'           => 'stripe',
            'payment_status'           => 'pending',
            'stripe_payment_intent_id' => $intent->id,
            'shipping_address'         => $request->shipping_address,
            'billing_address'          => $request->billing_address ?? $request->shipping_address,
        ]);

        foreach ($items as $item) {
            $order->items()->create([
                'product_id'    => $item->product_id,
                'product_name'  => $item->product->name,
                'product_image' => $item->product->images[0] ?? null,
                'price'         => $item->product->effective_price,
                'quantity'      => $item->quantity,
                'subtotal'      => $item->subtotal,
                'attributes'    => $item->attributes,
            ]);
        }

        return response()->json([
            'client_secret' => $intent->client_secret,
            'order_id'      => $order->id,
        ]);
    }

    public function complete(Request $request)
    {
        $request->validate([
            'payment_intent_id' => ['required', 'string'],
            'order_id'          => ['required', 'exists:orders,id'],
        ]);

        Stripe::setApiKey(config('services.stripe.secret'));
        $intent = PaymentIntent::retrieve($request->payment_intent_id);

        $order = Order::findOrFail($request->order_id);

        if ($intent->status === 'succeeded') {
            DB::transaction(function () use ($order, $request) {
                $order->update([
                    'status'         => 'processing',
                    'payment_status' => 'paid',
                ]);

                // Decrement stock
                foreach ($order->items as $item) {
                    $item->product->decrement('stock', $item->quantity);
                }

                // Clear cart
                CartItem::where('user_id', $order->user_id)->delete();
            });

            return response()->json(['message' => 'Order placed successfully', 'order' => $order]);
        }

        return response()->json(['message' => 'Payment not completed'], 422);
    }

    public function webhook(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $payload   = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');

        try {
            $event = Webhook::constructEvent($payload, $sigHeader, config('services.stripe.webhook_secret'));
        } catch (\Exception $e) {
            return response()->json(['message' => 'Invalid signature'], 400);
        }

        match ($event->type) {
            'payment_intent.succeeded' => $this->handlePaymentSucceeded($event->data->object),
            'payment_intent.payment_failed' => $this->handlePaymentFailed($event->data->object),
            default => null,
        };

        return response()->json(['received' => true]);
    }

    private function handlePaymentSucceeded($paymentIntent)
    {
        Order::where('stripe_payment_intent_id', $paymentIntent->id)
             ->update(['payment_status' => 'paid', 'status' => 'processing']);
    }

    private function handlePaymentFailed($paymentIntent)
    {
        Order::where('stripe_payment_intent_id', $paymentIntent->id)
             ->update(['payment_status' => 'failed', 'status' => 'cancelled']);
    }
}
