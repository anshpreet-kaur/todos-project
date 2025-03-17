@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Task</h2>
    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control">
                <option>Pending</option>
                <option>In Progress</option>
                <option>Completed</option>
            </select>
        </div>
        <div class="form-group">
            <label>Deadline</label>
            <input type="date" name="deadline" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Type</label>
            <select name="type" class="form-control">
                <option>Work</option>
                <option>Personal</option>
                <option>Urgent</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Create Task</button>
    </form>
</div>
@endsection
