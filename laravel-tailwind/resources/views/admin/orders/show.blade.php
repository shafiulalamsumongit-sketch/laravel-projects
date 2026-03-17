@extends('layouts.admin')
@section('title', 'Order Detail')
@section('content')
<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
    <div class="xl:col-span-2 space-y-6">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h2 class="font-bold text-lg mb-4">Order #{{ $order->order_number }} — Items</h2>
            <div class="space-y-3">
                @foreach($order->items as $item)
                <div class="flex items-center gap-4 py-3 border-b last:border-0">
                    <div class="w-14 h-14 bg-gray-100 rounded-lg flex-shrink-0 flex items-center justify-center">
                        <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    </div>
                    <div class="flex-1">
                        <p class="font-medium text-sm text-gray-800">{{ $item->product_name }}</p>
                        <p class="text-xs text-gray-400">Qty: {{ $item->quantity }} x ${{ number_format($item->price, 2) }}</p>
                    </div>
                    <span class="font-semibold text-sm">${{ number_format($item->subtotal, 2) }}</span>
                </div>
                @endforeach
            </div>
            <div class="mt-4 pt-4 border-t space-y-2 text-sm">
                <div class="flex justify-between text-gray-600"><span>Subtotal</span><span>${{ number_format($order->subtotal, 2) }}</span></div>
                <div class="flex justify-between text-gray-600"><span>Tax</span><span>${{ number_format($order->tax, 2) }}</span></div>
                <div class="flex justify-between text-gray-600"><span>Shipping</span><span>{{ $order->shipping == 0 ? 'FREE' : '$'.number_format($order->shipping, 2) }}</span></div>
                <div class="flex justify-between font-bold text-lg text-gray-800 pt-2 border-t"><span>Total</span><span>${{ number_format($order->total, 2) }}</span></div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h2 class="font-bold text-lg mb-3">Shipping Address</h2>
            <div class="text-sm text-gray-600 space-y-1">
                <p class="font-semibold text-gray-800">{{ ($order->shipping_address['first_name'] ?? '').' '.($order->shipping_address['last_name'] ?? '') }}</p>
                <p>{{ $order->shipping_address['address_line1'] ?? '' }}</p>
                <p>{{ ($order->shipping_address['city'] ?? '').', '.($order->shipping_address['state'] ?? '').' '.($order->shipping_address['postal_code'] ?? '') }}</p>
                <p>{{ $order->shipping_address['country'] ?? '' }}</p>
            </div>
        </div>
    </div>
    <div class="space-y-6">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h2 class="font-bold text-lg mb-4">Update Status</h2>
            <form method="POST" action="{{ route('admin.orders.status', $order) }}">
                @csrf
                <select name="status" class="w-full border rounded-lg px-3 py-2 text-sm mb-3 focus:ring-2 focus:ring-blue-500 outline-none">
                    @foreach(['pending','processing','shipped','delivered','cancelled','refunded'] as $s)
                    <option value="{{ $s }}" {{ $order->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg text-sm">Update</button>
            </form>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h2 class="font-bold text-lg mb-3">Customer</h2>
            <p class="font-medium text-gray-800">{{ $order->user->name }}</p>
            <p class="text-sm text-gray-500">{{ $order->user->email }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h2 class="font-bold text-lg mb-3">Payment</h2>
            <div class="text-sm space-y-2">
                <div class="flex justify-between"><span class="text-gray-500">Status</span>
                    <span class="{{ $order->payment_status === 'paid' ? 'text-green-600' : 'text-yellow-600' }} font-medium capitalize">{{ $order->payment_status }}</span>
                </div>
                <div class="flex justify-between"><span class="text-gray-500">Method</span><span class="capitalize">{{ $order->payment_method }}</span></div>
            </div>
        </div>
    </div>
</div>
@endsection
