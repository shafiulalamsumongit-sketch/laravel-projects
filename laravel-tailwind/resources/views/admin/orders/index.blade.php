@extends('layouts.admin')
@section('title', 'Orders')
@section('content')
<div class="mb-6">
    <form method="GET" class="flex gap-2 flex-wrap">
        <input name="search" value="{{ request('search') }}" placeholder="Order number..."
               class="border rounded-lg px-4 py-2 text-sm w-56 focus:ring-2 focus:ring-blue-500 outline-none">
        <select name="status" class="border rounded-lg px-3 py-2 text-sm">
            <option value="">All Statuses</option>
            @foreach(['pending','processing','shipped','delivered','cancelled','refunded'] as $s)
            <option value="{{ $s }}" {{ request('status')===$s?'selected':'' }}>{{ ucfirst($s) }}</option>
            @endforeach
        </select>
        <button class="bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg text-sm">Filter</button>
    </form>
</div>
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wider">
            <tr>
                <th class="px-6 py-3 text-left">Order #</th>
                <th class="px-6 py-3 text-left">Customer</th>
                <th class="px-6 py-3 text-left">Date</th>
                <th class="px-6 py-3 text-left">Status</th>
                <th class="px-6 py-3 text-left">Payment</th>
                <th class="px-6 py-3 text-right">Total</th>
                <th class="px-6 py-3 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($orders as $order)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 text-sm font-bold text-blue-600">
                    <a href="{{ route('admin.orders.show', $order) }}">#{{ $order->order_number }}</a>
                </td>
                <td class="px-6 py-4 text-sm">{{ $order->user->name }}</td>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $order->created_at->format('M d, Y') }}</td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 text-xs rounded-full capitalize font-medium
                        @switch($order->status)
                            @case('pending') bg-yellow-100 text-yellow-800 @break
                            @case('processing') bg-blue-100 text-blue-800 @break
                            @case('shipped') bg-purple-100 text-purple-800 @break
                            @case('delivered') bg-green-100 text-green-800 @break
                            @default bg-red-100 text-red-800
                        @endswitch">
                        {{ $order->status }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 text-xs rounded-full capitalize
                        {{ $order->payment_status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                        {{ $order->payment_status }}
                    </span>
                </td>
                <td class="px-6 py-4 text-sm font-bold text-right">${{ number_format($order->total, 2) }}</td>
                <td class="px-6 py-4 text-right">
                    <a href="{{ route('admin.orders.show', $order) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View</a>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" class="px-6 py-12 text-center text-gray-400">No orders found</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4 border-t">{{ $orders->links() }}</div>
</div>
@endsection
