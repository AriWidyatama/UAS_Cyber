<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        if ($user->akses === 'admin') {
            return view('admin.profil.show', compact('user'));
        }
        return view('user.profil.show', compact('user'));
    }

    // public function edit()
    // {
    //     $user = Auth::user();

    public function edit($id)
    {
        $user = User::findOrFail($id);
        if ($user->akses === 'admin') {
            return view('admin.profil.edit', compact('user'));
        }
        return view('user.profil.edit', compact('user'));
    }


    public function update(Request $request)
    {
        $user = Auth::user();
        // dd($user, get_class($user));

        $rules = [
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        $data = $request->validate($rules);

        if ($request->hasFile('image')) {
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }
            $file = $request->file('image');
            $filename = Str::slug($user->username ?: $user->nama) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('profiles', $filename, 'public');
            $data['image'] = $path;
        }

        $user->update($data);

        if ($user->akses === 'admin') {
            return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui.');
        }
        return redirect()->route('user.profil.show')->with('success', 'Profil berhasil diperbarui.');
    }
}
