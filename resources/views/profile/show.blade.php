@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Profile</h2>
    <p><strong>Bio:</strong> {{ $profile->bio ?? 'N/A' }}</p>
    <p><strong>Phone:</strong> {{ $profile->phone ?? 'N/A' }}</p>

    <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>
</div>
@endsection
