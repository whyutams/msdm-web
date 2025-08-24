<?php

namespace App\Http\Controllers;

use App\Models\Cerita;
use Auth;
use Illuminate\Http\Request;

class CeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ceritas = Cerita::with('user')->latest()->get();

        return view("cerita.index", compact('ceritas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("cerita.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "cerita" => "string|required|min:100"
        ]);

        Cerita::create([
            "cerita" => $request->cerita,
            "user_id" => Auth::user()->id
        ]);

        return redirect()->route('cerita')->with('success', 'Cerita dibagikan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cerita $cerita)
    {
        return view("cerita.show", compact('cerita'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cerita $cerita)
    {
        if (Auth::id() != $cerita->user_id) {
            return abort('404', 'Not Found');
        }

        return view("cerita.edit", compact('cerita'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cerita $cerita)
    {
        if (Auth::id() != $cerita->user_id) {
            return abort('404', 'Not Found');
        }

        $request->validate([
            "cerita" => "string|required|min:100"
        ]);

        $cerita->update([
            "cerita" => $request->cerita
        ]);

        return redirect()->route('cerita.show', ['cerita' => $cerita->id])->with('success', 'Cerita diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cerita $cerita)
    {
        if (Auth::id() != $cerita->user_id) {
            return abort('404', 'Not Found');
        }

        $cerita->delete();

        return redirect()->route('cerita')->with('success', 'Cerita berhasil dihapus.');
    }
}
