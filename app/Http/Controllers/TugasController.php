<?php

namespace App\Http\Controllers;

use App\Models\SubTugas;
use App\Models\Tugas;
use Auth;
use Illuminate\Http\Request;

class TugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tugass = Tugas::with(['creator', 'updater'])->latest()->get();

        return view('dashboard.tugas.index', compact('tugass'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $last_week = Tugas::all()->count();

        return view('dashboard.tugas.create', compact('last_week'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $last_week = Tugas::all()->count();

        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        $validated['minggu'] = $last_week + 1;
        $validated['created_by'] = Auth::id();
        $validated['updated_by'] = Auth::id();

        Tugas::create($validated);

        return redirect()->route('dashboard.tugas.index')->with('success', 'Tugas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tugas $tugas)
    {
        $subtugas = SubTugas::with(['creator'])->where('tugas_id', $tugas->id)->latest()->get();

        return view('dashboard.tugas.show', compact('tugas', 'subtugas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tugas $tugas)
    {
        return view('dashboard.tugas.edit', compact('tugas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tugas $tugas)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        $validated['updated_by'] = Auth::id();

        $tugas->update($validated);

        return redirect()->route('dashboard.tugas.show', $tugas->id)->with('success', 'Tugas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tugas $tugas)
    {
        $last_week = Tugas::all()->count();

        if ($last_week != $tugas->minggu) {
            return redirect()->back()->withErrors(['Tidak dapat menghapus tugas minggu ke-' . $tugas->minggu . ' sebelum tugas minggu ke-' . $last_week . ' terhapus.']);
        }

        $tugas->delete();

        return redirect()->route('dashboard.tugas.index')->with('success', 'Data tugas minggu ke-' . $tugas->minggu . ' berhasil dihapus.');
    }
}
