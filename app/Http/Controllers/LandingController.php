<?php

namespace App\Http\Controllers;

use App\Models\sc;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Storage;

class LandingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (User::ROLE_SUPERADMIN || User::ROLE_ADMIN) {
            return view('index');
        } else {
            return view('index');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(sc $sc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(sc $sc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, sc $sc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(sc $sc)
    {
        //
    }

    public function login()
    {
        return view("login");
    }

    public function proses_login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/')->with('success', 'Login berhasil, Selamat datang ' . Auth::user()->callname . '.');
            ;
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->withInput();
    }

    public function register()
    {
        return view("register");
    }

    public function proses_register(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:100',
            'callname' => 'required|string|max:10',
            'email' => 'nullable|email|unique:users,email',
            'no_hp' => 'required|numeric|digits_between:6,20|unique:users,no_hp',
            'address' => 'nullable|string',
            'gender' => 'string|in:pria,wanita',
            'birth_date' => 'required|date',
            'diabetes_type' => 'string|in:1,2,gestasional',
            'username' => 'required|string|min:6|max:50|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'fullname' => $request->fullname,
            'callname' => $request->callname,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'address' => $request->address,
            'gender' => $request->gender,
            'birth_date' => $request->birth_date,
            'diabetes_type' => $request->diabetes_type,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('index')->with('success', 'Registrasi berhasil, Selamat datang ' . $request->callname . '.');
    }

    public function cerita()
    {
        return view("cerita");
    }

    public function detail()
    {
        return view("detail-cerita");
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'Berhasil logout.');
        ;
    }

    public function profile()
    {
        return view('profile');
    }

    public function update_profile()
    {
        return view('update-profile');
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

}
