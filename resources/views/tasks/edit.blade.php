<!-- resources/views/tasks/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Task</h2>
    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ $task->title }}" required>
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ $task->description }}</textarea>
        </div>
        <label for="category_id">Category:</label>
        <select name="category_id" required>
            <option value="">Select a category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $task->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        <div class="form-group">
            <label for="parent_id">Parent Task</label>
            <select name="parent_id" class="form-control">
                <option value="">None</option>
                @foreach($tasks as $parent)
                    <option value="{{ $parent->id }}" {{ $task->parent_id == $parent->id ? 'selected' : '' }}>
                        {{ $parent->title }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="Pending" {{ $task->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="In Progress" {{ $task->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                <option value="Completed" {{ $task->status == 'Completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>

        <div class="form-group">
            <label>Deadline</label>
            <input type="date" name="deadline" class="form-control" value="{{ $task->deadline }}" required>
        </div>

        <div class="form-group">
            <label>Type</label>
            <select name="type" class="form-control">
                <option value="Work" {{ $task->type == 'Work' ? 'selected' : '' }}>Work</option>
                <option value="Personal" {{ $task->type == 'Personal' ? 'selected' : '' }}>Personal</option>
                <option value="Urgent" {{ $task->type == 'Urgent' ? 'selected' : '' }}>Urgent</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update Task</button>
    </form>
</div>
@endsection
