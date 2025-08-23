@extends('layouts.home')

@section('title', 'Daftar')

@section('content')

    <div class="bg-gray-200 flex items-center justify-center min-h-screen py-12">
        <div class="w-full max-w-5xl bg-white rounded-2xl shadow-lg p-10 lg:p-14 mx-6">

            <h2 class="text-3xl font-bold text-center text-primary mb-10">Daftar</h2>

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" class="space-y-8">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <div class="space-y-6">
                        <div>
                            <label for="fullname" class="block text-gray-700 font-medium text-lg mb-2">
                                Nama Lengkap <span class="text-red-600">*</span>
                            </label>
                            <input type="text" id="fullname" name="fullname"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('fullname') border-red-600 @enderror"
                                placeholder="Masukkan nama lengkap" value="{{ old('fullname') }}" required>
                        </div>

                        <div>
                            <label for="callname" class="block text-gray-700 font-medium text-lg mb-2">
                                Nama Panggilan <span class="text-red-600">*</span>
                            </label>
                            <input type="text" id="callname" name="callname"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('callname') border-red-600 @enderror"
                                placeholder="Masukkan nama panggilan" value="{{ old(key: 'callname') }}" required>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium text-lg mb-3">
                                Jenis Kelamin <span class="text-red-600">*</span>
                            </label>
                            <div class="flex flex-row space-x-6 @error('callname') border-red-600 rounded-lg @enderror">
                                <label class="flex items-center space-x-3">
                                    <input type="radio" name="gender" value="pria" @if(old('gender') == 'pria') checked @endif
                                        class="h-5 w-5 text-blue-600 accent-secondary focus:ring-blue-500 border-gray-300"
                                        required>
                                    <span class="text-gray-700 text-lg">Pria</span>
                                </label>
                                <label class="flex items-center space-x-3">
                                    <input type="radio" name="gender" value="wanita" @if(old('gender') == 'wanita') checked @endif
                                        class="h-5 w-5 text-blue-600 accent-secondary focus:ring-blue-500 border-gray-300">
                                    <span class="text-gray-700 text-lg">Wanita</span>
                                </label>
                            </div>
                        </div>

                        <div>
                            <label for="no_hp" class="block text-gray-700 font-medium text-lg mb-2">
                                Nomor HP <span class="text-red-600">*</span>
                            </label>
                            <input type="text" id="no_hp" name="no_hp"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('no_hp') border-red-600 @enderror"
                                placeholder="Masukkan nomor HP" value="{{ old('no_hp') }}"  required>
                        </div>

                        <div>
                            <label for="email" class="block text-gray-700 font-medium text-lg mb-2">
                                Email <span class="text-red-600"></span>
                            </label>
                            <input type="text" id="email" name="email"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('email') border-red-600 @enderror"
                                placeholder="Masukkan email" value="{{ old('email') }}">
                        </div>

                        <div>
                            <label for="birth_date" class="block text-gray-700 font-medium text-lg mb-2">
                                Tanggal Lahir <span class="text-red-600">*</span>
                            </label>

                            <input type="date" id="birth_date" name="birth_date"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('birth_date') border-red-600 @enderror"
                                value="{{ old('birth_date') }}" required>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label for="address" class="block text-gray-700 font-medium text-lg mb-2">
                                Alamat <span class="text-red-600">*</span>
                            </label>

                            <textarea rows="3" name="address" id="address"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('address') border-red-600 @enderror"
                                placeholder="Masukkan alamat" required>{{ old('address') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium text-lg mb-3">
                                Tipe Diabetes <span class="text-red-600">*</span>
                            </label>
                            <div class="flex flex-col sm:flex-row sm:space-x-6 space-y-3 sm:space-y-0 @error('callname') rounded-lg border-red-600 @enderror">
                                <label class="flex items-center space-x-3">
                                    <input type="radio" name="diabetes_type" value="1" @if(old('diabetes_type') == '1') checked @endif
                                        class="h-5 w-5 text-blue-600 accent-secondary focus:ring-blue-500 border-gray-300"
                                        required>
                                    <span class="text-gray-700 text-lg">Tipe 1</span>
                                </label>
                                <label class="flex items-center space-x-3">
                                    <input type="radio" name="diabetes_type" value="2" @if(old('diabetes_type') == '2') checked @endif
                                        class="h-5 w-5 text-blue-600 accent-secondary focus:ring-blue-500 border-gray-300">
                                    <span class="text-gray-700 text-lg">Tipe 2</span>
                                </label>
                                <label class="flex items-center space-x-3">
                                    <input type="radio" name="diabetes_type" value="gestasional" @if(old('diabetes_type') == 'gestasional') checked @endif
                                        class="h-5 w-5 text-blue-600 accent-secondary focus:ring-blue-500 border-gray-300">
                                    <span class="text-gray-700 text-lg">Gestasional</span>
                                </label>
                            </div>
                        </div>

                        <div>
                            <label for="username" class="block text-gray-700 font-medium text-lg mb-2">
                                Username <span class="text-red-600">*</span>
                            </label>
                            <input type="text" id="username" name="username"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('username') border-red-600 @enderror"
                                placeholder="Masukkan username" value="{{ old('username') }}" required>
                        </div>

                        <div>
                            <label for="password" class="block text-gray-700 font-medium text-lg mb-2">
                                Password <span class="text-red-600">*</span>
                            </label>
                            <input type="password" id="password" name="password"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('password') border-red-600 @enderror"
                                placeholder="Masukkan password" required>
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-gray-700 font-medium text-lg mb-2">
                                Konfirmasi Password <span class="text-red-600">*</span>
                            </label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('password_confirmation') border-red-600 @enderror"
                                placeholder="Ulangi password" required>
                        </div>
                    </div>
                </div>

                <div class="mt-10"></div>
                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-lg font-semibold text-lg hover:bg-blue-700 transition">
                    Daftar
                </button>
            </form>

            <p class="text-center text-gray-600 text-base mt-6">
                Sudah punya akun?
                <a href="{{ url('/login') }}" class="text-blue-600 font-semibold hover:underline">Login</a>
            </p>
        </div>
    </div>

@endsection