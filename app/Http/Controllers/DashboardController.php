<?php

namespace App\Http\Controllers;

use App\Models\Cerita;
use App\Models\KontakSebaya;
use App\Models\sc;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->get();
        $kontak_sebayas = KontakSebaya::latest()->get();

        $ceritas = Cerita::with('user')->latest()->get();
        return view('dashboard.index', compact('ceritas', 'users', 'kontak_sebayas'));
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
}
