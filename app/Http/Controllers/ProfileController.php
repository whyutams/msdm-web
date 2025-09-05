<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use App\Models\User;
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
        if (Auth::user()->role == User::ROLE_USER) {
            return view('user.update-profile');
        } else {
            if (Auth::user()->role == User::ROLE_SUPERADMIN) {
                return abort('404', 'NOT FOUND');
            }
            return view('dashboard.admin.update-profile');
        }
    }

    public function proses_update_profile(Request $request)
    {
        $user = auth()->user();

        $data = [];

        if (Auth::user()->role == User::ROLE_USER) {
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
                'gender' => 'string|in:' . implode(',', User::GENDER),
                'birth_date' => 'required|date',
                'old_password' => 'nullable|min:6',
                'password' => 'nullable|min:6|confirmed',
                'photo_profile' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                // biodata
                'usia' => 'required|in:' . implode(',', User::USIA),
                'pendidikan' => 'required|in:' . implode(',', User::PENDIDIKAN),
                'pekerjaan' => 'required|in:' . implode(',', User::PEKERJAAN),
                'status_perkawinan' => 'required|in:' . implode(',', User::STATUS_PERKAWINAN),
                'lama_dm' => 'required|in:' . implode(',', User::LAMA_DM),
                'pengobatan_dm' => 'required|in:' . implode(',', User::PENGOBATAN_DM),
                'riwayat_keluarga' => 'required|in:' . implode(',', User::RIWAYAT_KELUARGA),
                'diabetes_type' => 'required|in:' . implode(',', User::DIABETES_TYPE),
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
                'usia' => $request->usia ?? Auth::user()->usia,
                'pendidikan' => $request->pendidikan ?? Auth::user()->pendidikan,
                'status_perkawinan' => $request->status_perkawinan ?? Auth::user()->status_perkawinan,
                'pekerjaan' => $request->pekerjaan ?? Auth::user()->pekerjaan,
                'lama_dm' => $request->lama_dm ?? Auth::user()->lama_dm,
                'pengobatan_dm' => $request->pengobatan_dm ?? Auth::user()->pengobatan_dm,
                'riwayat_keluarga' => $request->riwayat_keluarga ?? Auth::user()->riwayat_keluarga,
                'username' => Auth::user()->username,
            ];
        } else {
            if (Auth::user()->role == User::ROLE_SUPERADMIN) {
                return abort('404', 'NOT FOUND');
            }

            $request->validate([
                'fullname' => 'required|string|max:100',
                'callname' => 'nullable|string|max:10',
                'old_password' => 'nullable|min:6',
                'password' => 'nullable|min:6|confirmed',
                'photo_profile' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            $data = [
                'fullname' => $request->fullname ?? Auth::user()->fullname,
                'callname' => $request->callname ?? Auth::user()->callname,
            ];
        }

        if ($request->hasFile('photo_profile')) {
            if ($user->photo_profile) {
                Storage::disk('public')->delete($user->photo_profile);
            }

            $data['photo_profile'] = $request->file('photo_profile')->store('profile', 'public');
        }

        if ($request->filled('password')) {
            if (!Hash::check($request->old_password, $user->password)) {
                return back()->withErrors(['old_password' => 'Password lama tidak sesuai.']);
            }

            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->back()->with('success', 'Profil' . ($request->filled('password') ? ' dan Password' : '') . ' berhasil diperbarui.');
    }

    public function task()
    {
        $tasks = Tugas::with('creator','updater')->latest()->get();

        return view('user.task', compact('tasks'));
    }

    public function biodata_edit()
    {
        return view('update-biodata');
    }

    public function biodata_update(Request $request)
    {

        $request->validate([
            'usia' => 'required|in:' . implode(',', User::USIA),
            'pendidikan' => 'required|in:' . implode(',', User::PENDIDIKAN),
            'pekerjaan' => 'required|in:' . implode(',', User::PEKERJAAN),
            'status_perkawinan' => 'required|in:' . implode(',', User::STATUS_PERKAWINAN),
            'lama_dm' => 'required|in:' . implode(',', User::LAMA_DM),
            'pengobatan_dm' => 'required|in:' . implode(',', User::PENGOBATAN_DM),
            'riwayat_keluarga' => 'required|in:' . implode(',', User::RIWAYAT_KELUARGA),
            'diabetes_type' => 'required|in:' . implode(',', User::DIABETES_TYPE),
        ]);

        $user = Auth::user();
        $user->update($request->only([
            'usia',
            'pendidikan',
            'pekerjaan',
            'status_perkawinan',
            'lama_dm',
            'pengobatan_dm',
            'riwayat_keluarga',
            'diabetes_type'
        ]));

        return redirect('/')->with('success', 'Biodata berhasil dilengkapi.');
    }
}
