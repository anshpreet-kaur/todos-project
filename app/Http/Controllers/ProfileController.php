<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index() {
        return view('profile.index');
    }
    public function show()
{
    $user = Auth::user();
    
    // Create profile if it doesn't exist
    if (!$user->profile) {
        $user->profile()->create([
            'bio' => null,
            'phone' => null,
        ]);
    }

    $profile = $user->profile;
    return view('profile.show', compact('profile'));
}

public function edit()
{
    $user = Auth::user();
    
    // Create profile if it doesn't exist
    if (!$user->profile) {
        $user->profile()->create([
            'bio' => null,
            'phone' => null,
        ]);
    }

    $profile = $user->profile;
    return view('profile.edit', compact('profile'));
}


    public function update(Request $request)
    {
        $request->validate([
            'bio' => 'nullable|string',
            'phone' => 'nullable|string|max:15',
        ]);

        $profile = Auth::user()->profile;
        $profile->update($request->only(['bio', 'phone']));

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
    }
}
