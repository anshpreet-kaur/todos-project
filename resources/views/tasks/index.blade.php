@extends('layouts.app')

@section('content')
<div class="container">
    <h2>My Tasks</h2>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Add Task</a>
    <div class="mb-3">
        <form method="GET" action="{{ route('tasks.index') }}" class="form-inline">
            <select name="status" class="form-control mb-2 mr-2">
                <option value="">Filter by Status</option>
                <option value="Pending">Pending</option>
                <option value="In Progress">In Progress</option>
                <option value="Completed">Completed</option>
            </select>
    
            <select name="type" class="form-control mb-2 mr-2">
                <option value="">Filter by Type</option>
                <option value="Work">Work</option>
                <option value="Personal">Personal</option>
                <option value="Urgent">Urgent</option>
            </select>
    
            <select name="category_id" class="form-control mb-2 mr-2">
                <option value="">Filter by Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
    
            <select name="sort" class="form-control mb-2 mr-2">
                <option value="deadline">Sort by Deadline</option>
                <option value="status">Sort by Status</option>
                <option value="type">Sort by Type</option>
            </select>
    
            <select name="order" class="form-control mb-2 mr-2">
                <option value="asc">Ascending</option>
                <option value="desc">Descending</option>
            </select>
    
            <button type="submit" class="btn btn-primary mb-2">Apply</button>
        </form>
    </div>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Parent id</th>
                <th>Status</th>
                <th>Deadline</th>
                <th>Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
            <tr>
                <td>{{ $task->title }}</td>
                <td>{{ $task->category ? $task->category->name : 'No Category' }}</td>
                <td style="margin-left: {{ $task->parent_id ? '20px' : '0' }};">
                    {{-- <strong>{{ $task->title }}</strong> --}}
                    @if($task->parent)
        <strong>{{ $task->parent->title }}</strong>

                    @endif
                    </td>
                <td>{{ $task->status }}</td>
                <td>{{ $task->deadline }}</td>
                <td>{{ $task->type }}</td>
                <td>
                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
