<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Stripe\Event;
use Stripe\Stripe;
use Stripe\Webhook;

class StripeController extends Controller
{
    public function webhook(Request $request): JsonResponse
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $payload   = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $secret    = config('services.stripe.webhook_secret');

        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $secret);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Invalid signature'], 400);
        }

        switch ($event->type) {
            case 'payment_intent.succeeded':
                $paymentIntent = $event->data->object;
                Order::where('payment_intent_id', $paymentIntent->id)
                    ->update(['payment_status' => 'paid']);
                break;

            case 'payment_intent.payment_failed':
                $paymentIntent = $event->data->object;
                Order::where('payment_intent_id', $paymentIntent->id)
                    ->update(['payment_status' => 'failed', 'status' => 'cancelled']);
                break;

            case 'charge.refunded':
                // Handle refund
                break;
        }

        return response()->json(['received' => true]);
    }
}
