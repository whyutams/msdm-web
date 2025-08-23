@php
    use Carbon\Carbon;
    Carbon::setLocale('id'); 
@endphp

@extends('layouts.home')

@section('title', 'Profil')

@section('content')
    <section class="py-24 bg-white">        
        <div class="max-w-6xl mx-auto px-6 sm:px-8 lg:px-12">
            @if(session('success'))
                <div class="mb-10 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
                @endif 
            <div class="flex items-center mb-10 pb-6 border-b-2 border-slate-200">
                @if(Auth::user()->photo_profile)
                    <img src="{{ asset('storage/' . Auth::user()->photo_profile) }}" alt="Profile"
                        class="w-32 h-32 md:w-48 md:h-48 rounded-full object-cover shadow-lg bg-gray-300">
                @else
                    <div
                        class="md:w-48 md:h-48 w-32 h-32 bg-primary rounded-full flex items-center justify-center text-white font-bold md:text-7xl text-5xl shadow-lg">
                        {{ strtoupper(substr(Auth::user()->callname, 0, 1)) }}
                    </div>
                @endif

                <div class="ml-8">
                    <h3 class="font-semibold text-gray-800 text-4xl md:text-5xl">{{ Auth::user()->callname }}</h3>
                    <p class="text-xl md:text-2xl text-gray-600 mt-2">{{ Auth::user()->fullname }}</p>
                    <p class="text-gray-500 mt-2 md:text-lg text-sm">({{ Auth::user()->username }})</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-lg text-gray-700">
                <div class="space-y-4">
                    <div>
                        <h6 class="font-bold text-xl mb-1">Jenis Kelamin</h6>
                        <p>{{ ucfirst(Auth::user()->gender) }}</p>
                    </div>
                    <div>
                        <h6 class="font-bold text-xl mb-1">Tanggal Lahir</h6>
                        <p>{{ Carbon::parse(Auth::user()->birth_date)->translatedFormat('d M Y') }}</p>
                    </div>
                    <div>
                        <h6 class="font-bold text-xl mb-1">Tipe Diabetes</h6>
                        <p>Tipe {{ ucfirst(Auth::user()->diabetes_type) }}</p>
                    </div>
                </div>
                <div class="space-y-4">
                    <div>
                        <h6 class="font-bold text-xl mb-1">Email</h6>
                        <p>{{ Auth::user()->email ?? '-' }}</p>
                    </div>
                    <div>
                        <h6 class="font-bold text-xl mb-1">No HP</h6>
                        <p>{{ Auth::user()->no_hp }}</p>
                    </div>
                    <div>
                        <h6 class="font-bold text-xl mb-1">Akun Dibuat</h6>
                        <p>{{ Carbon::parse(Auth::user()->created_at)->translatedFormat('d M Y') }}</p>
                    </div>
                </div>
                <div class="space-y-4">
                    <div>
                        <h6 class="font-bold text-xl mb-1">Alamat</h6>
                        <p>{{ Auth::user()->address ?? '-' }}</p>
                    </div>
                </div>

            </div>

            <div class="mt-16 flex justify-between space-x-4">
                <a href="{{ url()->previous() }}"
                    class="bg-slate-500 text-white px-8 py-3 rounded-xl text-base font-semibold hover:bg-slate-600 hover:shadow-lg transition-all duration-200 w-60 text-center">
                    Kembali
                </a>
                <a href="{{route('profile.form')}}"
                    class="bg-primary text-white px-8 py-3 rounded-xl text-base font-semibold hover:bg-blue-800 hover:shadow-lg transition-all duration-200 w-60 text-center">
                    Ubah Profil
                </a>
            </div>
        </div>
    </section>
@endsection