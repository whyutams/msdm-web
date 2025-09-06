<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use App\Models\SubTugas;
use Auth;
use Illuminate\Http\Request;

class SubTugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Tugas $tugas)
    {
        $last_urutan = SubTugas::where('tugas_id', $tugas->id)->get()->count();

        return view('dashboard.tugas.sub.create', compact('tugas', 'last_urutan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Tugas $tugas)
    {
        $last_urutan = SubTugas::where('tugas_id', $tugas->id)->get()->count();

        $validated = $request->validate([
            'name' => 'required|max:255',
            'jenis' => 'required|in:text,file',
            'content' => 'nullable',
            'file_type' => 'nullable|in:pdf,ppt,video',
            'file_path' => 'nullable',
        ]);

        $validated['urutan'] = $last_urutan + 1;
        $validated['tugas_id'] = $tugas->id;
        $validated['created_by'] = Auth::id();
        // $validated['updated_by'] = Auth::id();

        SubTugas::create($validated);

        return redirect()->route('dashboard.tugas.show', $tugas->id)->with('success', 'Materi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubTugas $subTugas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubTugas $subTugas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubTugas $subTugas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tugas $tugas, SubTugas $subTugas)
    {
        $last_urutan = SubTugas::where('tugas_id', $tugas->id)->get()->count();

        if ($last_urutan != $subTugas->urutan) {
            return redirect()->back()->withErrors(['Tidak dapat menghapus materi ' . $subTugas->urutan . ' sebelum materi ' . $last_urutan . ' terhapus.']);
        }

        $subTugas->delete();

        return redirect()->route('dashboard.tugas.show', $tugas->id)->with('success', 'Materi ' . $subTugas->urutan . ' berhasil dihapus.');
    }
}
