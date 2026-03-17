@extends('layouts.admin')
@section('title', 'Reviews')
@section('content')
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50 text-xs text-gray-500 uppercase"><tr>
            <th class="px-6 py-3 text-left">Customer</th><th class="px-6 py-3 text-left">Product</th>
            <th class="px-6 py-3 text-left">Rating</th><th class="px-6 py-3 text-left">Review</th>
            <th class="px-6 py-3 text-left">Status</th><th class="px-6 py-3 text-right">Actions</th>
        </tr></thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($reviews as $r)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 text-sm font-medium">{{ $r->user->name }}</td>
                <td class="px-6 py-4 text-sm text-gray-600 max-w-xs truncate">{{ $r->product->name ?? 'N/A' }}</td>
                <td class="px-6 py-4 text-sm">
                    <div class="flex items-center gap-0.5">
                        @for($i=1;$i<=5;$i++)
                        <svg class="w-4 h-4 {{ $i<=$r->rating?'text-yellow-400':'text-gray-200' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        @endfor
                    </div>
                </td>
                <td class="px-6 py-4 text-sm text-gray-600 max-w-xs"><p class="truncate">{{ $r->body }}</p></td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 text-xs rounded-full {{ $r->is_approved?'bg-green-100 text-green-800':'bg-yellow-100 text-yellow-800' }}">
                        {{ $r->is_approved?'Approved':'Pending' }}
                    </span>
                </td>
                <td class="px-6 py-4 text-right"><div class="flex items-center justify-end gap-3">
                    <form method="POST" action="{{ route('admin.reviews.update',$r) }}">
                        @csrf @method('PUT')
                        <button class="text-blue-600 hover:text-blue-800 text-sm">{{ $r->is_approved?'Unapprove':'Approve' }}</button>
                    </form>
                    <form method="POST" action="{{ route('admin.reviews.destroy',$r) }}" onsubmit="return confirm('Delete?')">
                        @csrf @method('DELETE')
                        <button class="text-red-500 hover:text-red-700 text-sm">Delete</button>
                    </form>
                </div></td>
            </tr>
            @empty
            <tr><td colspan="6" class="px-6 py-10 text-center text-gray-400">No reviews yet</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4 border-t">{{ $reviews->links() }}</div>
</div>
@endsection
