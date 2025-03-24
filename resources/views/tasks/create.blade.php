@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Task</h2>
    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
    
        <label for="title">Title:</label>
        <input type="text" name="title" value="{{ old('title') }}" required>
    
        <label for="description">Description:</label>
        <textarea name="description">{{ old('description') }}</textarea>
        
        <label for="category_id">Category:</label>
<select name="category_id" required>
    <option value="">Select a category</option>
    @foreach($categories as $category)
        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
            {{ $category->name }}
        </option>
    @endforeach
</select>
<label for="parent_id">Parent Task:</label>
<select name="parent_id" class="form-control">
    <option value="">None</option>
    @foreach($tasks as $parent)
        <option value="{{ $parent->id }}" {{ old('parent_id', $task->parent_id ?? '') == $parent->id ? 'selected' : '' }}>
            {{ $parent->title }}
        </option>
    @endforeach
</select>


        <label for="status">Status:</label>
        <select name="status" required>
            <option value="Pending" selected>Pending</option>
            <option value="In Progress">In Progress</option>
            <option value="Completed">Completed</option>
        </select>
    
        <label for="deadline">Deadline:</label>
        <input type="date" name="deadline" value="{{ old('deadline') }}" required>
    
        <label for="type">Type:</label>
        <select name="type" required>
            <option value="Work" selected>Work</option>
            <option value="Personal">Personal</option>
            <option value="Urgent">Urgent</option>
        </select>
    
        <button type="submit">Create Task</button>
    </form>
        
    
</div>
@endsection
