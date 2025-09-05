@extends('layouts.dashboard')

@section('title', 'Detail')

@section('content')
    @if(session('success'))
        <div class="mt-6 mx-auto">
            <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        </div>
    @endif

    <section class="">
        <div class="bg-white shadow rounded-lg py-6">
            <div class="px-5 pb-5">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4">
                    <div>
                        <h1 class="text-2xl font-semibold text-gray-800">Detail</h1>
                    </div>
                    <div>
                        <nav class="flex" aria-label="Breadcrumb">
                            <ol class="inline-flex items-center space-x-1 sm:space-x-3 text-sm text-gray-600">
                                <li>
                                    <a href="{{ url('dashboard') }}" class="hover:text-blue-600">Dashboard</a>
                                </li>
                                <li class="before:content-['/'] before:mr-2 hover:text-blue-600">
                                    <a href="{{ url('dashboard/cerita') }}" class="hover:text-blue-600">
                                        Cerita
                                    </a>
                                </li>
                                <li class="before:content-['/'] before:mr-2 text-gray-400">Detail</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="max-w-6xl mx-auto px-6 sm:px-8 lg:px-12 py-8">
                @if(session('success'))
                    <div class="mb-10 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="flex items-center mb-8">
                    <div class="w-24 h-24 rounded-full bg-gray-300 flex items-center justify-center overflow-hidden">
                        @if($cerita->user->photo_profile)
                            <img src="{{ asset(path: 'storage/' . $cerita->user->photo_profile) }}" alt="Profile"
                                class="w-full h-full object-cover">
                        @else
                            <span
                                class="text-white font-bold text-4xl bg-primary w-full h-full flex items-center justify-center rounded-full">
                                {{ strtoupper(substr($cerita->user->callname, 0, 1)) }}
                            </span>
                        @endif
                    </div>
                    <div class="ml-6">
                        <h3 class="font-semibold text-gray-800 text-2xl">{{ $cerita->user->callname }}</h3>
                        <h6 class="font-semibold text-gray-600 mb-2 text-lg">{{ $cerita->user->fullname }}</h6>
                        <p class="text-lg text-gray-600">Tipe {{ $cerita->user->diabetes_type }}</p>
                    </div>
                </div>

                @if ($cerita->suspended)
                    <div class="mb-10 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                        Cerita ini ditangguhkan.
                    </div>
                @endif

                <p class="text-primary"><i class="fas fa-calendar mr-1 mb-4"></i>
                    {{ \Carbon\Carbon::parse($cerita->created_at)->translatedFormat('d M Y') }}</p>

                <p class="text-gray-700 leading-relaxed mb-8 text-lg text-justify break-words whitespace-pre-line">
                    {{ strip_tags($cerita->cerita) }}
                </p>

                <div class="mt-12 flex lg:justify-between justify-center flex-wrap gap-4">
                    <a href="{{ route('dashboard.cerita.index') }}"
                        class="bg-slate-500 text-white px-4 py-2 rounded hover:bg-slate-600 hover:shadow-lg transition-all duration-200 w-60 text-center">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection