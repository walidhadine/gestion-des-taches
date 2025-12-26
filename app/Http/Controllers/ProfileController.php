<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $user->load(['profile', 'tasks']);
        return view('profile.show', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        $user->load('profile');
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'telephone' => 'nullable|string|max:20',
            'poste' => 'nullable|string|max:100',
            'departement' => 'nullable|string|max:100',
            'bureau' => 'nullable|string|max:50',
            'bio' => 'nullable|string',
            'signature' => 'nullable|string',
            'theme' => 'required|in:clair,sombre,auto',
            'langue' => 'required|string|max:5',
            'notifications_email' => 'boolean',
            'notifications_app' => 'boolean',
            'avatar' => 'nullable|image|max:2048',
        ]);

        $user->update([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'email' => $validated['email'],
        ]);

        $profile = $user->profile ?? new UserProfile(['user_id' => $user->id]);
        
        if ($request->hasFile('avatar')) {
            if ($profile->avatar && $profile->avatar !== 'default-avatar.png') {
                Storage::disk('public')->delete('avatars/' . $profile->avatar);
            }
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = basename($avatarPath);
        }

        $profile->fill([
            'telephone' => $validated['telephone'] ?? null,
            'poste' => $validated['poste'] ?? null,
            'departement' => $validated['departement'] ?? null,
            'bureau' => $validated['bureau'] ?? null,
            'bio' => $validated['bio'] ?? null,
            'signature' => $validated['signature'] ?? null,
            'theme' => $validated['theme'],
            'langue' => $validated['langue'],
            'notifications_email' => $request->has('notifications_email'),
            'notifications_app' => $request->has('notifications_app'),
            'avatar' => $validated['avatar'] ?? $profile->avatar,
        ]);

        $profile->save();

        return redirect()->route('profile.show')->with('success', 'Profil mis à jour!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('profile.show')->with('success', 'Mot de passe modifié!');
    }
}

