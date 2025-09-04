<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = null;
        if (Auth::user()->role == User::ROLE_ADMIN) {
            $users = User::where('role', '=', User::ROLE_USER)->latest()->get();
        } else if (Auth::user()->role == User::ROLE_SUPERADMIN) {
            $users = User::where('role', '!=', User::ROLE_SUPERADMIN)->orderByRaw("FIELD(role, '" . User::ROLE_ADMIN . "', '" . User::ROLE_USER . "')")->latest()->get();
        }

        return view('dashboard.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:100',
            'callname' => 'string|max:10',
            'username' => 'required|string|min:6|max:50|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'fullname' => $request->fullname,
            'callname' => $request->callname,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => User::ROLE_ADMIN
        ]);

        return redirect()->route('dashboard.users.index')->with('success', 'Admin berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        if($user->role==User::ROLE_ADMIN) {
            return abort('404', 'NOT FOUND');
        }

        return view('dashboard.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        if ($user->role == User::ROLE_USER) {
            return abort('404', 'NOT FOUND');
        }

        return view('dashboard.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        if ($user->role == User::ROLE_USER) {
            return abort('404', 'NOT FOUND');
        }

        $request->validate([
            'fullname' => 'required|string|max:100',
            'callname' => 'nullable|string|max:10',
        ]);

        $data = [
            'fullname' => $request->fullname ?? Auth::user()->fullname,
            'callname' => $request->callname ?? Auth::user()->callname,
        ];

        $user->update($data);

        return redirect()->route('dashboard.users.index')->with('success', 'Admin berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->back()->with('success', 'User ' . $user->username . " berhasil dihapus.");
    }

    public function toggleSuspend(User $user)
    {
        $user->update(['suspended' => !$user->suspended]);

        return redirect()->back()->with('success', 'User ' . ($user->suspended ? "Dinonaktifkan" : "Diaktifkan") . ".");
    }
}
