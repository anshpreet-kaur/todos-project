@extends('layouts.app')

@section('content')
<div class="container">
    <h2>My Tasks</h2>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Add Task</a>
    
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
                    <strong>{{ $task->title }}</strong>
                    @if($task->children->count())
                        <ul>
                            @foreach($task->children as $child)
                                <li>{{ $child->title }}</li>
                            @endforeach
                        </ul>
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
