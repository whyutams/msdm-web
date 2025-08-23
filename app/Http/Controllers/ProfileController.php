<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Storage;

class ProfileController extends Controller
{

    public function profile()
    {
        return view('user.profile');
    }

    public function update_profile()
    {
        return view('user.update-profile');
    }

    public function proses_update_profile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'fullname' => 'required|string|max:100',
            'callname' => 'required|string|max:10',
            'email' => [
                'nullable',
                'email',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'no_hp' => [
                'required',
                'numeric',
                'digits_between:6,20',
                Rule::unique('users', 'no_hp')->ignore($user->id),
            ],
            'address' => 'nullable|string',
            'gender' => 'string|in:pria,wanita',
            'birth_date' => 'required|date',
            'diabetes_type' => 'string|in:1,2,gestasional',
            'password' => 'nullable|min:6|confirmed',
            'photo_profile' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = [
            'fullname' => $request->fullname ?? Auth::user()->fullname,
            'callname' => $request->callname ?? Auth::user()->callname,
            'email' => $request->email ?? Auth::user()->email,
            'no_hp' => $request->no_hp ?? Auth::user()->no_hp,
            'address' => $request->address ?? Auth::user()->address,
            'gender' => $request->gender ?? Auth::user()->gender,
            'birth_date' => $request->birth_date ?? Auth::user()->birth_date,
            'diabetes_type' => $request->diabetes_type ?? Auth::user()->diabetes_type,
            'username' => Auth::user()->username,
        ];

        if ($request->hasFile('photo_profile')) {
            if ($user->photo_profile) {
                Storage::disk('public')->delete($user->photo_profile);
            }

            $data['photo_profile'] = $request->file('photo_profile')->store('profile', 'public');
        }

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui.');
    }

    public function task()
    {
        return view('user.task');
    }
}
