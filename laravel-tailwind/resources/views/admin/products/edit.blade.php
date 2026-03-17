@extends('layouts.admin')
@section('title', 'Edit Product')
@section('content')
<div class="max-w-3xl">
    <form method="POST" action="{{ route('admin.products.update', $product) }}" class="space-y-6">
        @csrf @method('PUT')
        <div class="bg-white rounded-xl shadow-sm p-6 space-y-4">
            <h2 class="font-bold text-lg">Edit: {{ Str::limit($product->name, 50) }}</h2>
            @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm">
                <ul class="list-disc list-inside">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
            @endif
            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Name *</label>
                    <input name="name" value="{{ old('name', $product->name) }}" required class="w-full border rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Category *</label>
                    <select name="category_id" required class="w-full border rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id',$product->category_id)==$cat->id?'selected':'' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Stock *</label>
                    <input name="stock" type="number" min="0" value="{{ old('stock',$product->stock) }}" required class="w-full border rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Price *</label>
                    <input name="price" type="number" step="0.01" min="0" value="{{ old('price',$product->price) }}" required class="w-full border rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Sale Price</label>
                    <input name="sale_price" type="number" step="0.01" min="0" value="{{ old('sale_price',$product->sale_price) }}" class="w-full border rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" rows="4" class="w-full border rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 outline-none">{{ old('description',$product->description) }}</textarea>
                </div>
                <div class="flex items-center gap-6 col-span-2">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" value="1" {{ $product->is_active?'checked':'' }} class="rounded text-blue-600">
                        <span class="text-sm text-gray-700">Active</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="hidden" name="is_featured" value="0">
                        <input type="checkbox" name="is_featured" value="1" {{ $product->is_featured?'checked':'' }} class="rounded text-blue-600">
                        <span class="text-sm text-gray-700">Featured</span>
                    </label>
                </div>
            </div>
        </div>
        <div class="flex gap-3">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2.5 rounded-xl">Update</button>
            <a href="{{ route('admin.products.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-2.5 rounded-xl">Cancel</a>
        </div>
    </form>
</div>
@endsection
