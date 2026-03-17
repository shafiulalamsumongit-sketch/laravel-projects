@extends('layouts.admin')
@section('title', 'Categories')
@section('content')
<div class="flex justify-end mb-6">
    <a href="{{ route('admin.categories.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium">+ Add Category</a>
</div>
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50 text-xs text-gray-500 uppercase"><tr>
            <th class="px-6 py-3 text-left">Name</th><th class="px-6 py-3 text-left">Slug</th>
            <th class="px-6 py-3 text-left">Products</th><th class="px-6 py-3 text-left">Status</th>
            <th class="px-6 py-3 text-right">Actions</th>
        </tr></thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($categories as $cat)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 font-medium text-sm">{{ $cat->name }}</td>
                <td class="px-6 py-4 text-sm text-gray-400 font-mono">{{ $cat->slug }}</td>
                <td class="px-6 py-4 text-sm">{{ $cat->products_count }}</td>
                <td class="px-6 py-4"><span class="px-2 py-1 text-xs rounded-full {{ $cat->is_active?'bg-green-100 text-green-800':'bg-gray-100 text-gray-600' }}">{{ $cat->is_active?'Active':'Inactive' }}</span></td>
                <td class="px-6 py-4 text-right"><div class="flex items-center justify-end gap-3">
                    <a href="{{ route('admin.categories.edit',$cat) }}" class="text-blue-600 hover:text-blue-800 text-sm">Edit</a>
                    <form method="POST" action="{{ route('admin.categories.destroy',$cat) }}" onsubmit="return confirm('Delete?')">
                        @csrf @method('DELETE')
                        <button class="text-red-500 hover:text-red-700 text-sm">Delete</button>
                    </form>
                </div></td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-6 py-10 text-center text-gray-400">No categories yet</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
