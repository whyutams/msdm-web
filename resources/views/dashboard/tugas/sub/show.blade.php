@extends('layouts.dashboard')

@section('title', 'Detail Materi')

@section('content')
    @if(session('success'))
        <div class="mt-6 mx-auto">
            <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section>
        <div class="bg-white shadow rounded-2xl py-8 px-6 sm:px-8 lg:px-12">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
                <h1 class="text-2xl font-semibold text-gray-800">Detail Materi</h1>
                <nav aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 sm:space-x-3 text-sm text-gray-600">
                        <li>
                            <a href="{{ url('dashboard') }}" class="hover:text-blue-600">Dashboard</a>
                        </li>
                        <li class="before:content-['/'] before:mx-2 hover:text-blue-600">
                            <a href="{{ route('dashboard.tugas.index') }}" class="hover:text-blue-600">Tugas</a>
                        </li>
                        <li class="before:content-['/'] before:mr-2 text-gray-400">Materi</li>
                        <li class="before:content-['/'] before:mr-2 text-gray-400">Detail</li>
                    </ol>
                </nav>
            </div>

            <div class="space-y-6">
                {{-- Nama materi --}}
                <div>
                    <h2 class="text-xl font-semibold text-gray-700">{{ $materi->name }}</h2>
                    <p class="text-sm text-gray-500">Materi {{ $materi->urutan }}</p>
                </div>

                {{-- Konten materi --}}
                <div class="border rounded-lg p-4 bg-gray-50">
                    @if($materi->jenis === 'text')
                        <div class="prose max-w-none">
                            {!! nl2br($materi->content) !!}
                        </div>

                    @elseif($materi->jenis === 'file')
                        @if($materi->jenis === 'file' && strtolower($materi->file_type) === 'pdf')
                            <embed src="{{ asset('storage/' . $materi->file_path) }}" height="500" width="1000">

                            <div class="mt-4">
                                <a href="{{ route('dashboard.tugas.materi.preview', ['tugas' => $tugas->id, 'subTugas' => $materi->id]) }}"
                                    target="_blank" class="px-4 py-2 bg-blue-600 text-white rounded">Buka di tab baru</a>
                            </div>

                        @elseif(in_array($materi->file_type, ['ppt', 'pptx']))
                            <iframe src="https://docs.google.com/gview?url={{ urlencode($fileUrl) }}&embedded=true"
                                class="w-full h-[600px] border rounded">
                            </iframe>
                        @endif

                    @elseif($materi->jenis === 'link')
                        @if($embedUrl)
                            <div class="flex justify-center">
                                <div class="aspect-video w-full md:w-2/3 lg:w-1/2">
                                    <iframe src="{{ $embedUrl }}" class="w-full h-full rounded" frameborder="0" allowfullscreen>
                                    </iframe>
                                </div>
                            </div>
                        @else
                            <p class="text-red-500">Link YouTube tidak valid.</p>
                        @endif
                    @endif
                </div>
            </div>

            <div class="flex justify-start mt-6">
                <a href="{{ route('dashboard.tugas.show', $tugas->id) }}"
                    class="bg-slate-500 text-white px-4 py-2 rounded hover:bg-slate-600 hover:shadow transition w-40 text-center">
                    Kembali
                </a>
            </div>
        </div>
    </section>
@endsection