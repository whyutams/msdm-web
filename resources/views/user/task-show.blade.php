@php
    use Carbon\Carbon;
    Carbon::setLocale('id'); 
@endphp

@extends('layouts.home')

@section('title', 'Materi ' . $materi->urutan . ' - ' . $materi->name)

@section('content')
    <section class="pb-24 pt-12 bg-white">
        <div class="max-w-6xl mx-auto px-6 sm:px-8 lg:px-12">

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <h1 class="text-2xl lg:text-3xl font-semibold text-gray-800">
                Materi {{ $materi->urutan }} - {{ $materi->name }}
            </h1>
            <div class="mb-6">
                <span class="text-slate-600">Minggu ke-{{ $minggu ?? '?' }}</span> 
            </div>


            <div class="border rounded-lg p-6 bg-gray-50 shadow-sm">
                @if($materi->jenis === 'text')
                    <div class="prose max-w-none">
                        {!! $materi->content !!}
                    </div>

                @elseif($materi->jenis === 'file')
                    @if(strtolower($materi->file_type) === 'pdf')
                        <embed src="{{ asset('storage/' . $materi->file_path) }}" height="500" width="100%">

                        <div class="mt-4">
                            <a href="{{ asset('storage/' . $materi->file_path) }}" target="_blank"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                                Buka di tab baru
                            </a>
                        </div>
                    @elseif(in_array($materi->file_type, ['ppt', 'pptx']))
                        <iframe
                            src="https://docs.google.com/gview?url={{ urlencode(url('storage/' . $materi->file_path)) }}&embedded=true"
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
                        <p class="text-red-500">Link tidak valid.</p>
                    @endif
                @endif
            </div>

            <div class="mt-8 flex justify-between flex-wrap gap-4">
                <a href="{{ route('task') }}"
                    class="bg-slate-500 text-white px-12 py-3 rounded-xl text-base font-semibold hover:bg-slate-600 hover:shadow transition">
                    Kembali
                </a>

                @if(!in_array($materi->id, $user_completed ?? []))
                    <form action="{{ route('task.show.complete', $materi->id) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                            class="bg-green-500 text-white px-6 py-3 rounded-xl text-base font-semibold hover:bg-green-600 hover:shadow transition">
                            Tandai Selesai
                        </button>
                    </form>
                @else
                    <span class="bg-gray-300 text-gray-700 px-6 py-3 rounded-xl text-base font-semibold">
                        Materi Telah Selesai
                    </span>
                @endif
            </div>

        </div>
    </section>
@endsection