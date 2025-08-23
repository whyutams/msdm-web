@extends('layouts.home')

@section('title', 'Masuk')

@section('content')

    <div class="bg-gray-200 flex items-center justify-center min-h-screen">

        <div class="w-full max-w-xl bg-white rounded-2xl shadow-lg p-8 lg:mx-10 mx-6 mb-20">
            <h2 class="text-3xl font-bold text-center text-blue-900 mb-6">Masuk</h2>

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label for="username" class="block text-gray-700 font-medium text-lg mb-1">Username <span
                            class="text-red-600">*</span></label>
                    <input type="text" id="username" name="username"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="Masukkan username" value="{{ old('username') }}" required>
                </div>

                <div>
                    <label for="password" class="block text-gray-700 text-lg font-medium mb-1">Password <span
                            class="text-red-600">*</span></label>
                    <input type="password" id="password" name="password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="Masukkan password" required>
                </div>

                <div class="mt-10"></div>
                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-lg font-semibold hover:bg-blue-700 transition text-lg">
                    Masuk
                </button>
            </form>

            <p class="text-base text-center text-gray-600 mt-5">
                Belum punya akun?
                <a href="{{ url('/register') }}" class="text-blue-600 font-semibold hover:underline">Daftar</a>
            </p>
        </div>

    </div>

@endsection