<x-app-layout>
<div class="max-w-xl mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">Edit Task</h1>

    <form action="{{ route('tasks.update', $task) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-2">
            <label class="block text-sm font-medium mb-1">Title</label>
            <input type="text" name="title" class="border rounded w-full p-2"
                   value="{{ old('title', $task->title) }}" required>
            @error('title')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-2">
            <label class="block text-sm font-medium mb-1">Description</label>
            <textarea name="description" class="border rounded w-full p-2">{{ old('description', $task->description) }}</textarea>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
            Save
        </button>
        <a href="{{ route('tasks.index') }}" class="ml-2 text-gray-600">Cancel</a>
    </form>
</div>
</x-app-layout>
