@extends('layouts.home')

@section('title', 'Lengkapi Biodata')

@section('content')

    <div class="bg-gray-200 flex items-center justify-center min-h-screen py-12">
        <div class="w-full max-w-5xl bg-white rounded-2xl shadow-lg p-10 lg:p-14 mx-6">

            <h2 class="text-3xl font-bold text-center text-primary mb-10">Lengkapi Biodata</h2>

            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                    {{session('success')}} Silahkan lengkapi biodata Anda terlebih dahulu.
                </div>
            @else
                <div class="mb-6 p-4 bg-amber-100 border border-amber-400 text-amber-700 rounded-lg">
                    Silahkan lengkapi biodata Anda terlebih dahulu.
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

            <form action="{{ route('biodata.update') }}" method="POST" class="space-y-8">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <div class="space-y-6">
                        <div>
                            <label for="usia" class="block text-gray-700 font-medium text-lg mb-2">
                                Usia <span class="text-red-600">*</span>
                            </label>

                            <div class="relative">
                                <select name="usia"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg  appearance-none cursor-pointer focus:ring-2 focus:ring-secondary focus:outline-none @error('usia') border-red-600 @enderror"
                                    required>
                                    <option value="" disabled selected>Pilih usia</option>
                                    @foreach(App\Models\User::USIA as $value)
                                        <option value="{{ $value }}" {{ old('usia', Auth::user()->usia) == $value ? 'selected' : '' }}>
                                            {{ str_replace('_', ' ', $value) }}
                                        </option>
                                    @endforeach
                                </select>

                                <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="pendidikan" class="block text-gray-700 font-medium text-lg mb-2">
                                Pendidikan <span class="text-red-600">*</span>
                            </label>

                            <div class="relative">
                                <select name="pendidikan"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg  appearance-none cursor-pointer focus:ring-2 focus:ring-secondary focus:outline-none @error('pendidikan') border-red-600 @enderror"
                                    required>
                                    <option value="" disabled selected>Pilih pendidikan</option>
                                    @foreach(App\Models\User::PENDIDIKAN as $value)
                                        <option value="{{ $value }}" {{ old('pendidikan', Auth::user()->pendidikan) == $value ? 'selected' : '' }}>
                                            {{ format_label($value)}}
                                        </option>
                                    @endforeach
                                </select>

                                <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="pekerjaan" class="block text-gray-700 font-medium text-lg mb-2">
                                Pekerjaan <span class="text-red-600">*</span>
                            </label>

                            <div class="relative">
                                <select name="pekerjaan"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg  appearance-none cursor-pointer focus:ring-2 focus:ring-secondary focus:outline-none @error('pekerjaan') border-red-600 @enderror"
                                    required>
                                    <option value="" disabled selected>Pilih pekerjaan</option>
                                    @foreach(App\Models\User::PEKERJAAN as $value)
                                        <option value="{{ $value }}" {{ old('pekerjaan', Auth::user()->pekerjaan) == $value ? 'selected' : '' }}>
                                            {{ format_label($value)}}
                                        </option>
                                    @endforeach
                                </select>

                                <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="status_perkawinan" class="block text-gray-700 font-medium text-lg mb-2">
                                Status Perkawinan <span class="text-red-600">*</span>
                            </label>

                            <div class="relative">
                                <select name="status_perkawinan"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg  appearance-none cursor-pointer focus:ring-2 focus:ring-secondary focus:outline-none @error('status_perkawinan') border-red-600 @enderror"
                                    required>
                                    <option value="" disabled selected>Pilih status perkawinan</option>
                                    @foreach(App\Models\User::STATUS_PERKAWINAN as $value)
                                        <option value="{{ $value }}" {{ old('status_perkawinan', Auth::user()->status_perkawinan) == $value ? 'selected' : '' }}>
                                            {{ format_label($value)}}
                                        </option>
                                    @endforeach
                                </select>

                                <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label for="lama_dm" class="block text-gray-700 font-medium text-lg mb-2">
                                Lama DM <span class="text-red-600">*</span>
                            </label>

                            <div class="relative">
                                <select name="lama_dm"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg  appearance-none cursor-pointer focus:ring-2 focus:ring-secondary focus:outline-none @error('lama_dm') border-red-600 @enderror"
                                    required>
                                    <option value="" disabled selected>Pilih lama dm</option>
                                    @foreach(App\Models\User::LAMA_DM as $value)
                                        <option value="{{ $value }}" {{ old('lama_dm', Auth::user()->lama_dm) == $value ? 'selected' : '' }}>
                                            {{ format_label($value)}}
                                        </option>
                                    @endforeach
                                </select>

                                <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="pengobatan_dm" class="block text-gray-700 font-medium text-lg mb-2">
                                Pengobatan DM <span class="text-red-600">*</span>
                            </label>

                            <div class="relative">
                                <select name="pengobatan_dm"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg  appearance-none cursor-pointer focus:ring-2 focus:ring-secondary focus:outline-none @error('pengobatan_dm') border-red-600 @enderror"
                                    required>
                                    <option value="" disabled selected>Pilih pengobatan dm</option>
                                    @foreach(App\Models\User::PENGOBATAN_DM as $value)
                                        <option value="{{ $value }}" {{ old('pengobatan_dm', Auth::user()->pengobatan_dm) == $value ? 'selected' : '' }}>
                                            {{ format_label($value)}}
                                        </option>
                                    @endforeach
                                </select>

                                <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium text-lg mb-3">
                                Tipe Diabetes <span class="text-red-600">*</span>
                            </label>
                            <div
                                class="flex flex-col sm:flex-row sm:space-x-6 space-y-3 sm:space-y-0 @error('callname') rounded-lg border-red-600 @enderror">
                                @foreach (App\Models\User::DIABETES_TYPE as $value)
                                    <label class="flex items-center space-x-3">
                                        <input type="radio" name="diabetes_type" value="{{ $value }}" @if(old('diabetes_type') == '1' || Auth::user()->diabetes_type == $value) checked @endif
                                            class="h-5 w-5 text-blue-600 accent-secondary focus:ring-secondary border-gray-300"
                                            required>
                                        <span class="text-gray-700 text-lg">Tipe {{ format_label($value)}}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div>
                            <label for="riwayat_keluarga" class="block text-gray-700 font-medium text-lg mb-2">
                                Riwayat Keluarga <span class="text-red-600">*</span>
                            </label>

                            <div class="relative">
                                <select name="riwayat_keluarga"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg  appearance-none cursor-pointer focus:ring-2 focus:ring-secondary focus:outline-none @error('riwayat_keluarga') border-red-600 @enderror"
                                    required>
                                    <option value="" disabled selected>Pilih riwayat keluarga</option>
                                    @foreach(App\Models\User::RIWAYAT_KELUARGA as $value)
                                        <option value="{{ $value }}" {{ old('riwayat_keluarga', Auth::user()->riwayat_keluarga) == $value ? 'selected' : '' }}>
                                            {{ format_label($value)}}
                                        </option>
                                    @endforeach
                                </select>

                                <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="mt-10"></div>
                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-lg font-semibold text-lg hover:bg-blue-700 transition">
                    Submit
                </button>
            </form>

            <p class="text-center text-gray-600 text-base mt-6">
                Sudah punya akun?
                <a href="{{ url('/login') }}" class="text-blue-600 font-semibold hover:underline">Login</a>
            </p>
        </div>
    </div>

@endsection