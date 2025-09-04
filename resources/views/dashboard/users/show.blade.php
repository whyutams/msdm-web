@extends('layouts.dashboard')

@section('title', 'Add Admin')

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
            <div class="max-w-6xl mx-auto px-6 sm:px-8 lg:px-12">
                @if(session('success'))
                    <div class="mb-10 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="flex justify-between mb-6 pb-6 border-b-2 border-slate-200">
                    <div class="flex items-center">
                        @if($user->photo_profile)
                            <img src="{{ asset('storage/' . $user->photo_profile) }}" alt="Profile"
                                class="w-32 h-32 md:w-48 md:h-48 rounded-full object-cover shadow-lg bg-gray-300">
                        @else
                            <div
                                class="md:w-48 md:h-48 w-32 h-32 bg-primary rounded-full flex items-center justify-center text-white font-bold md:text-7xl text-5xl shadow-lg">
                                {{ strtoupper(substr($user->callname, 0, 1)) }}
                            </div>
                        @endif

                        <div class="ml-8">
                            <h3 class="font-semibold text-gray-800 text-4xl md:text-5xl">{{ $user->callname }}</h3>
                            <p class="text-xl md:text-2xl text-gray-600 mt-2">{{ $user->fullname }}</p>
                            <p class="text-gray-500 mt-2 md:text-lg text-sm">({{ $user->username }})</p>
                        </div>

                    </div>
                </div>

                @if ($user->suspended)
                    <div class="mb-10 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                        Pengguna ini dinonaktifkan.
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-lg text-gray-700">
                    <div class="space-y-4">
                        <div>
                            <h6 class="font-bold text-xl mb-1">Jenis Kelamin</h6>
                            <p>{{ ucfirst($user->gender ?? '-') }}</p>
                        </div>
                        <div>
                            <h6 class="font-bold text-xl mb-1">Tanggal Lahir</h6>
                            <p>{{ $user->birth_date ? Carbon\Carbon::parse($user->birth_date)->translatedFormat('d M Y') : '-' }}
                            </p>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <h6 class="font-bold text-xl mb-1">Email</h6>
                            <p>{{ $user->email ?? '-' }}</p>
                        </div>
                        <div>
                            <h6 class="font-bold text-xl mb-1">No HP</h6>
                            <p>{{ $user->no_hp ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <h6 class="font-bold text-xl mb-1">Akun Dibuat</h6>
                            <p>{{ Carbon\Carbon::parse($user->created_at)->translatedFormat('d M Y') }}</p>
                        </div>
                        <div>
                            <h6 class="font-bold text-xl mb-1">Alamat</h6>
                            <p>{{ $user->address ?? '-' }}</p>
                        </div>
                    </div>

                </div>
                <div class="my-12"></div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-lg text-gray-700">
                    <div class="space-y-4">
                        <div>
                            <h6 class="font-bold text-xl mb-1">Usia</h6>
                            <p>{{ $user->usia ? str_replace('_', ' ', $user->usia) : '-' }}</p>
                        </div>
                        <div>
                            <h6 class="font-bold text-xl mb-1">Pendidikan</h6>
                            <p>{{ format_label($user->pendidikan) }}</p>
                        </div>
                        <div>
                            <h6 class="font-bold text-xl mb-1">Pekerjaan</h6>
                            <p>{{ format_label($user->pekerjaan) }}</p>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <h6 class="font-bold text-xl mb-1">Status Perkawinan</h6>
                            <p>{{ format_label($user->status_perkawinan) }}</p>
                        </div>
                        <div>
                            <h6 class="font-bold text-xl mb-1">Lama DM</h6>
                            <p>{{ format_label($user->lama_dm) }}</p>
                        </div>
                        <div>
                            <h6 class="font-bold text-xl mb-1">Tipe Diabetes</h6>
                            <p>{{ ucfirst($user->diabetes_type ? 'Tipe ' . $user->diabetes_type : '-') }}</p>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <h6 class="font-bold text-xl mb-1">Pengobatan DM</h6>
                            <p>{{ format_label($user->pengobatan_dm) }}</p>
                        </div>
                        <div>
                            <h6 class="font-bold text-xl mb-1">Riwayat Keluarga</h6>
                            <p>{{ format_label($user->riwayat_keluarga) }}</p>
                        </div>
                    </div>

                </div>

                <div class="mt-16 flex justify-between space-x-4">
                    <a href="{{ route('dashboard.users.index') }}"
                        class="bg-slate-500 text-white px-8 py-3 rounded-xl text-base font-semibold hover:bg-slate-600 hover:shadow-lg transition-all duration-200 w-60 text-center">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection