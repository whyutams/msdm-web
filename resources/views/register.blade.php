@extends('layouts.home')

@section('title', 'Daftar')

@section('content')

    <div class="bg-gray-200 flex items-center justify-center min-h-screen">

        <div class="w-full max-w-xl bg-white rounded-2xl shadow-lg p-8 lg:mx-10 mx-6 mb-20 mt-20 lg:mt-10">
            <h2 class="text-3xl font-bold text-center text-blue-900 mb-6">Daftar</h2>

            <form action="#" method="POST" class="space-y-5">
                <div>
                    <label for="fullname" class="block text-gray-700 font-medium text-lg mb-1">Nama Lengkap <span
                            class="text-red-600">*</span></label>
                    <input type="text" id="fullname" name="fullname"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="Masukkan nama lengkap" required>
                </div>

                <div>
                    <label for="callname" class="block text-gray-700 font-medium text-lg mb-1">Nama Panggilan <span
                            class="text-red-600">*</span></label>
                    <input type="text" id="callname" name="callname"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="Masukkan nama panggilan" required>
                </div>

                <div>
                    <label for="no_hp" class="block text-gray-700 font-medium text-lg mb-1">Nomor HP <span
                            class="text-red-600">*</span></label>
                    <input type="text" id="no_hp" name="no_hp"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="Masukkan nomor HP" required>
                </div>

                <div>
                    <label class="block text-gray-700 font-medium text-lg mb-2">
                        Tingkat Diabetes <span class="text-red-600">*</span>
                    </label>
                    <div class="space-x-4 flex">
                        <label class="flex items-center space-x-3">
                            <input type="radio" name="tingkat_diabetes" value="rendah"
                                class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 accent-secondary" required>
                            <span class="text-gray-700 text-lg">Rendah</span>
                        </label>

                        <label class="flex items-center space-x-3">
                            <input type="radio" name="tingkat_diabetes" value="sedang"
                                class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 accent-secondary">
                            <span class="text-gray-700 text-lg">Sedang</span>
                        </label>

                        <label class="flex items-center space-x-3">
                            <input type="radio" name="tingkat_diabetes" value="tinggi"
                                class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 accent-secondary">
                            <span class="text-gray-700 text-lg">Tinggi</span>
                        </label>
                    </div>
                </div>

                <div>
                    <label for="username" class="block text-gray-700 font-medium text-lg mb-1">Username<span
                            class="text-red-600">*</span></label>
                    <input type="text" id="username" name="username"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="Masukkan username" required>
                </div>

                <div>
                    <label for="password" class="block text-gray-700 text-lg font-medium mb-1">Password <span
                            class="text-red-600">*</span></label>
                    <input type="password" id="password" name="password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="Masukkan password" required>
                </div>

                <div>
                    <label for="confirm_password" class="block text-gray-700 text-lg font-medium mb-1">Konfirmasi Password <span
                            class="text-red-600">*</span></label>
                    <input type="password" id="confirm_password" name="confirm_password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="Ulangi password" required>
                </div>

                <div class="mt-10"></div>
                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-lg font-semibold hover:bg-blue-700 transition text-lg">
                    Daftar
                </button>
            </form>

            <p class="text-base text-center text-gray-600 mt-5">
                Sudah punya akun?
                <a href="{{ url('/login') }}" class="text-blue-600 font-semibold hover:underline">Login</a>
            </p>
        </div>

    </div>

@endsection