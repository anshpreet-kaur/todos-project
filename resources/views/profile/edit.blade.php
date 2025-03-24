@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Profile</h2>
    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="bio" class="form-label">Bio</label>
            <textarea name="bio" class="form-control">{{ old('bio', $profile->bio) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" name="phone" value="{{ old('phone', $profile->phone) }}" class="form-control" />
        </div>

        <button type="submit" class="btn btn-success">Update Profile</button>
    </form>
</div>
@endsection
