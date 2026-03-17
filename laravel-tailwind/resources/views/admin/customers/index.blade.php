@extends('layouts.admin')
@section('title', 'Customers')
@section('content')
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50 text-xs text-gray-500 uppercase"><tr>
            <th class="px-6 py-3 text-left">Name</th><th class="px-6 py-3 text-left">Email</th>
            <th class="px-6 py-3 text-left">Orders</th><th class="px-6 py-3 text-left">Joined</th>
            <th class="px-6 py-3 text-right">Actions</th>
        </tr></thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($customers as $c)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 font-medium text-sm text-gray-800">{{ $c->name }}</td>
                <td class="px-6 py-4 text-sm text-gray-500">{{ $c->email }}</td>
                <td class="px-6 py-4 text-sm">{{ $c->orders_count }}</td>
                <td class="px-6 py-4 text-sm text-gray-400">{{ $c->created_at->format('M d, Y') }}</td>
                <td class="px-6 py-4 text-right">
                    <a href="{{ route('admin.customers.show',$c) }}" class="text-blue-600 hover:text-blue-800 text-sm">View</a>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-6 py-10 text-center text-gray-400">No customers yet</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4 border-t">{{ $customers->links() }}</div>
</div>
@endsection
