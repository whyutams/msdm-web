<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use App\Models\SubTugas;
use Auth;
use Illuminate\Http\Request;
use Storage;

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
        $last_urutan = SubTugas::where('tugas_id', $tugas->id)->count();

        $validated = $request->validate([
            'name' => 'required|max:255',
            'jenis' => 'required|in:text,file,link',
            'content' => 'nullable',
            'file_type' => 'nullable|in:pdf,ppt,pptx',
            'file_path' => 'nullable',
            'link' => 'nullable|url',
        ]);

        $validated['urutan'] = $last_urutan + 1;
        $validated['tugas_id'] = $tugas->id;
        $validated['created_by'] = Auth::id();

        if ($request->jenis == 'text') {
            $validated['content'] = $request['content'];
            $validated['file_path'] = null;
            $validated['file_type'] = null;

        } else if ($request->jenis == 'file') {
            if ($request->hasFile('file_path')) {
                $file = $request->file('file_path');
                $extension = strtolower($file->getClientOriginalExtension());

                if (!in_array($extension, ['pdf', 'ppt', 'pptx'])) {
                    return back()->with('error', 'Format file hanya pdf, ppt, atau pptx.');
                }

                $path = $file->storeAs('materi', time() . '.' . $extension, 'public');

                $validated['file_path'] = $path;
                $validated['file_type'] = $extension;
                $validated['content'] = null;
            }

        } else if ($request->jenis == 'link') {
            $validated['file_type'] = null;
            $validated['content'] = null;

            $validated['link'] = $request->input('link');
        }

        SubTugas::create($validated);

        return redirect()
            ->route('dashboard.tugas.show', $tugas->id)
            ->with('success', 'Materi berhasil ditambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Tugas $tugas, SubTugas $subTugas)
    {
        $fileUrl = null;
        $embedUrl = null;

        if ($subTugas->jenis === 'file' && $subTugas->file_path) {
            $fileUrl = url('storage/' . $subTugas->file_path);
        }

        if ($subTugas->jenis === 'link' && $subTugas->link) {
            $embedUrl = $this->getYoutubeEmbedUrl($subTugas->link);
        }

        return view('dashboard.tugas.sub.show', [
            'tugas' => $tugas,
            'materi' => $subTugas,
            'fileUrl' => $fileUrl,
            'embedUrl' => $embedUrl,
        ]);
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

    public function preview(Tugas $tugas, SubTugas $subTugas)
    {
        $fullPath = storage_path('app/public/' . $subTugas->file_path);

        if (!file_exists($fullPath)) {
            abort(404, 'File tidak ditemukan.');
        }

        return response()->stream(function () use ($fullPath) {
            readfile($fullPath);
        }, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . basename($fullPath) . '"',
        ]);
    }


    private function getYoutubeEmbedUrl($url)
    {
        $pattern = '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i';

        if (preg_match($pattern, $url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }

        return null;
    }



}
