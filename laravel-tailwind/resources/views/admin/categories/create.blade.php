@extends('layouts.admin')
@section('title', 'Add Category')
@section('content')
<div class="max-w-lg">
    <form method="POST" action="{{ route('admin.categories.store') }}" class="space-y-6">
        @csrf
        <div class="bg-white rounded-xl shadow-sm p-6 space-y-4">
            <h2 class="font-bold text-lg">New Category</h2>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Name *</label>
                <input name="name" value="{{ old('name') }}" required class="w-full border rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" rows="3" class="w-full border rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 outline-none">{{ old('description') }}</textarea>
            </div>
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" checked class="rounded text-blue-600">
                <span class="text-sm text-gray-700">Active</span>
            </label>
        </div>
        <div class="flex gap-3">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2.5 rounded-xl">Create</button>
            <a href="{{ route('admin.categories.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-2.5 rounded-xl">Cancel</a>
        </div>
    </form>
</div>
@endsection
