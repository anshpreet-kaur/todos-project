
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Category</h2>
    <form action="{{ route('categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Category name</label>
            <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
        </div>
        

        <button type="submit" class="btn btn-success">Update Task</button>
    </form>
</div>
@endsection
