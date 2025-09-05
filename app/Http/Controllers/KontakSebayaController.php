<?php

namespace App\Http\Controllers;

use App\Models\KontakSebaya;
use App\Models\sc;
use Auth;
use Illuminate\Http\Request;

class KontakSebayaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kontak_sebayas = KontakSebaya::with(['creator', 'updater'])->get();

        return view('dashboard.kontak_sebaya.index', compact('kontak_sebayas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kontak_sebayas = KontakSebaya::with(['creator', 'updater'])->get();

        return view('dashboard.kontak_sebaya.create', compact('kontak_sebayas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'string|required',
            'description' => 'string|required',
            'number' => 'numeric|required'
        ]);

        $validated['updated_by'] = Auth::id();
        $validated['created_by'] = Auth::id();

        KontakSebaya::create($validated);

        return redirect()->route('dashboard.kontak_sebaya.index')->with('success', 'Berhasil menambahkan data.');
    }

    /**
     * Display the specified resource.
     */
    public function show(KontakSebaya $kontakSebaya)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KontakSebaya $kontakSebaya)
    {
        return view('dashboard.kontak_sebaya.edit', compact('kontakSebaya'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KontakSebaya $kontakSebaya)
    {
        $validated = $request->validate([
            'name' => 'string|required',
            'description' => 'string|required',
            'number' => 'numeric|required'
        ]);

        $validated['updated_by'] = Auth::id();

        $kontakSebaya->update($validated);

        return redirect()->route('dashboard.kontak_sebaya.index')->with('success', 'Berhasil memperbarui data.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KontakSebaya $kontakSebaya)
    {
        $kontakSebaya->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
