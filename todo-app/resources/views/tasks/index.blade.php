@extends('layouts.app') {{-- or layouts from Breeze, e.g. 'layouts.app' / 'layouts.guest' --}}

@section('content')
<div class="max-w-2xl mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">My Tasks</h1>

    {{-- Add Task Form --}}
    <form action="{{ route('tasks.store') }}" method="POST" class="mb-6">
        @csrf
        <div class="mb-2">
            <input type="text" name="title" class="border rounded w-full p-2"
                   placeholder="New task..." value="{{ old('title') }}" required>
            @error('title')
                <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-2">
            <textarea name="description" class="border rounded w-full p-2"
                      placeholder="Description (optional)">{{ old('description') }}</textarea>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
            Add Task
        </button>
    </form>

    {{-- Task List --}}
    @if($tasks->count())
        <ul class="space-y-2">
            @foreach($tasks as $task)
                <li class="flex items-center justify-between border rounded p-2">
                    <div>
                        <form action="{{ route('tasks.toggle', $task) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="mr-2">
                                <input type="checkbox" {{ $task->is_completed ? 'checked' : '' }}
                                       onchange="this.form.submit()">
                            </button>
                        </form>

                        <span class="{{ $task->is_completed ? 'line-through text-gray-500' : '' }}">
                            {{ $task->title }}
                        </span>
                        @if($task->description)
                            <div class="text-sm text-gray-600">
                                {{ $task->description }}
                            </div>
                        @endif
                    </div>

                    <div class="flex gap-2">
                        <a href="{{ route('tasks.edit', $task) }}"
                           class="text-blue-600 text-sm">Edit</a>

                        <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                              onsubmit="return confirm('Delete this task?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 text-sm">
                                Delete
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <p>No tasks yet. Add one above 👆</p>
    @endif
</div>
@endsection