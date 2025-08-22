@extends('layouts.home')

@section('title', 'Daftar')

@section('content')

    <div class="bg-gray-100 flex items-center justify-center min-h-screen py-12">
        <div class="w-full max-w-5xl bg-white rounded-2xl shadow-lg p-10 lg:p-14 mx-6">

            <h2 class="text-3xl font-bold text-center text-primary mb-10">Daftar</h2>
            <form action="#" method="POST" class="space-y-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <div class="space-y-6">
                        <div>
                            <label for="fullname" class="block text-gray-700 font-medium text-lg mb-2">
                                Nama Lengkap <span class="text-red-600">*</span>
                            </label>
                            <input type="text" id="fullname" name="fullname"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                placeholder="Masukkan nama lengkap" required>
                        </div>

                        <div>
                            <label for="callname" class="block text-gray-700 font-medium text-lg mb-2">
                                Nama Panggilan <span class="text-red-600">*</span>
                            </label>
                            <input type="text" id="callname" name="callname"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                placeholder="Masukkan nama panggilan" required>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium text-lg mb-3">
                                Jenis Kelamin <span class="text-red-600">*</span>
                            </label>
                            <div class="flex flex-row space-x-6">
                                <label class="flex items-center space-x-3">
                                    <input type="radio" name="jk" value="pria"
                                        class="h-5 w-5 text-blue-600 accent-secondary focus:ring-blue-500 border-gray-300"
                                        required>
                                    <span class="text-gray-700 text-lg">Pria</span>
                                </label>
                                <label class="flex items-center space-x-3">
                                    <input type="radio" name="jk" value="wanita"
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
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                placeholder="Masukkan nomor HP" required>
                        </div>

                        <div>
                            <label for="email" class="block text-gray-700 font-medium text-lg mb-2">
                                Email <span class="text-red-600"></span>
                            </label>
                            <input type="text" id="email" name="email"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                placeholder="Masukkan email">
                        </div>
                        
                        <div>
                            <label for="birth_date" class="block text-gray-700 font-medium text-lg mb-2">
                                Tanggal Lahir <span class="text-red-600">*</span>
                            </label>

                            <input type="date" id="birth_date" name="birth_date"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                value="{{ old('birth_date', date('Y-m-d')) }}" required>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label for="address" class="block text-gray-700 font-medium text-lg mb-2">
                                Alamat <span class="text-red-600">*</span>
                            </label>

                            <textarea rows="3" name="address" id="address"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                placeholder="Masukkan alamat"></textarea>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium text-lg mb-3">
                                Tipe Diabetes <span class="text-red-600">*</span>
                            </label>
                            <div class="flex flex-col sm:flex-row sm:space-x-6 space-y-3 sm:space-y-0">
                                <label class="flex items-center space-x-3">
                                    <input type="radio" name="diabetes_type" value="1"
                                        class="h-5 w-5 text-blue-600 accent-secondary focus:ring-blue-500 border-gray-300"
                                        required>
                                    <span class="text-gray-700 text-lg">Tipe 1</span>
                                </label>
                                <label class="flex items-center space-x-3">
                                    <input type="radio" name="diabetes_type" value="2"
                                        class="h-5 w-5 text-blue-600 accent-secondary focus:ring-blue-500 border-gray-300">
                                    <span class="text-gray-700 text-lg">Tipe 2</span>
                                </label>
                                <label class="flex items-center space-x-3">
                                    <input type="radio" name="diabetes_type" value="gestasional"
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
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                placeholder="Masukkan username" required>
                        </div>

                        <div>
                            <label for="password" class="block text-gray-700 font-medium text-lg mb-2">
                                Password <span class="text-red-600">*</span>
                            </label>
                            <input type="password" id="password" name="password"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                placeholder="Masukkan password" required>
                        </div>

                        <div>
                            <label for="confirm_password" class="block text-gray-700 font-medium text-lg mb-2">
                                Konfirmasi Password <span class="text-red-600">*</span>
                            </label>
                            <input type="password" id="confirm_password" name="confirm_password"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
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