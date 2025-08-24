<?php

namespace App\Http\Controllers;

use App\Models\Cerita;
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
        $ceritas = Cerita::with('user')->limit(2)->latest()->get();

        if (User::ROLE_SUPERADMIN || User::ROLE_ADMIN) {
            return view('index', compact('ceritas'));
        } else {
            return view('index', compact('ceritas'));
        }
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
            return redirect()->intended(Auth::user()->role == User::ROLE_USER ? '/mytask' : '/')->with('success', 'Login berhasil, Selamat datang ' . Auth::user()->callname . '.'); 
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
        $credentials=$request->validate([
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

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/mytask')->with('success', 'Registrasi berhasil, Selamat datang ' . $request->callname . '.'); 
        } 
    }

    public function cerita()
    {
        return view("cerita");
    }

    public function detail()
    {
        return view("detail-cerita");
    }

    public function kelas_sebaya()
    {
        return view("kelas-sebaya");
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'Berhasil logout.');
        ;
    }

}
