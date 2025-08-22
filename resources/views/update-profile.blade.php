@extends('layouts.home')

@section('title', 'Ubah Profil')

@section('content')

    <div class="bg-gray-200 flex items-center justify-center min-h-screen py-12">
        <div class="w-full max-w-5xl bg-white rounded-2xl shadow-lg p-10 lg:p-14 mx-6">

            <h2 class="text-3xl font-bold text-center text-primary mb-10">Ubah Profil</h2>

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                <div>
                    <div class="flex justify-center pb-6">
                        @if(Auth::user()->photo_profile)
                            <img id="preview-image" src="{{ asset('storage/' . Auth::user()->photo_profile) }}" alt="Profile"
                                class="w-48 h-48 md:w-56 md:h-56 rounded-full object-cover shadow-lg bg-gray-300">
                        @else
                            <div id="preview-placeholder"
                                class="md:w-56 md:h-56 w-48 h-48 bg-primary rounded-full flex items-center justify-center text-white font-bold md:text-7xl text-5xl shadow-lg">
                                {{ strtoupper(substr(Auth::user()->callname, 0, 1)) }}
                            </div>
                            <img id="preview-image"
                                class="hidden w-48 h-48 md:w-56 md:h-56 rounded-full object-cover shadow-lg bg-gray-300" />
                        @endif
                    </div>

                    <div class="flex justify-center">
                        <label for="photo_profile"
                            class="cursor-pointer px-6 py-2 bg-primary hover:bg-blue-800 text-white rounded-lg shadow-lg text-base font-medium transition">
                            Ganti Foto
                        </label>
                        <input type="file" name="photo_profile" id="photo_profile" accept="image/*" class="hidden">
                    </div>
                </div>

                <script>
                    document.getElementById('photo_profile').addEventListener('change', function (event) {
                        const file = event.target.files[0];
                        const previewImage = document.getElementById('preview-image');
                        const previewPlaceholder = document.getElementById('preview-placeholder');

                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function (e) {
                                previewImage.src = e.target.result;
                                previewImage.classList.remove('hidden');
                                if (previewPlaceholder) {
                                    previewPlaceholder.classList.add('hidden');
                                }
                            };
                            reader.readAsDataURL(file);
                        }
                    });
                </script>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <div class="space-y-6">
                        <div>
                            <label for="fullname" class="block text-gray-700 font-medium text-lg mb-2">
                                Nama Lengkap <span class="text-red-600">*</span>
                            </label>
                            <input type="text" id="fullname" name="fullname"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                placeholder="Masukkan nama lengkap" value="{{ old('fullname', Auth::user()->fullname) }}"
                                required>
                        </div>

                        <div>
                            <label for="callname" class="block text-gray-700 font-medium text-lg mb-2">
                                Nama Panggilan <span class="text-red-600">*</span>
                            </label>
                            <input type="text" id="callname" name="callname"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                placeholder="Masukkan nama panggilan" value="{{ old('callname', Auth::user()->callname) }}"
                                required>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium text-lg mb-3">
                                Jenis Kelamin <span class="text-red-600">*</span>
                            </label>
                            <div class="flex flex-row space-x-6">
                                <label class="flex items-center space-x-3">
                                    <input type="radio" name="gender" value="pria"
                                        class="h-5 w-5 text-blue-600 accent-secondary focus:ring-blue-500 border-gray-300"
                                        required @if(Auth::user()->gender == "pria") checked @endif>
                                    <span class="text-gray-700 text-lg">Pria</span>
                                </label>
                                <label class="flex items-center space-x-3">
                                    <input type="radio" name="gender" value="wanita"
                                        class="h-5 w-5 text-blue-600 accent-secondary focus:ring-blue-500 border-gray-300">
                                    <span class="text-gray-700 text-lg" @if(Auth::user()->gender == "wanita") checked
                                    @endif>Wanita</span>
                                </label>
                            </div>
                        </div>

                        <div>
                            <label for="no_hp" class="block text-gray-700 font-medium text-lg mb-2">
                                Nomor HP <span class="text-red-600">*</span>
                            </label>
                            <input type="text" id="no_hp" name="no_hp"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                placeholder="Masukkan nomor HP" value="{{ old('no_hp', Auth::user()->no_hp) }}" required>
                        </div>

                        <div>
                            <label for="email" class="block text-gray-700 font-medium text-lg mb-2">
                                Email <span class="text-red-600"></span>
                            </label>
                            <input type="text" id="email" name="email"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                placeholder="Masukkan email" value="{{ old('email', Auth::user()->email ?? '') }}">
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label for="birth_date" class="block text-gray-700 font-medium text-lg mb-2">
                                Tanggal Lahir <span class="text-red-600">*</span>
                            </label>

                            <input type="date" id="birth_date" name="birth_date"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                value="{{ old('birth_date', \Carbon\Carbon::parse(Auth::user()->birth_date)->format('Y-m-d') ?? '')}}"
                                required>
                        </div>

                        <div>
                            <label for="address" class="block text-gray-700 font-medium text-lg mb-2">
                                Alamat <span class="text-red-600">*</span>
                            </label>

                            <textarea rows="3" name="address" id="address"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                placeholder="Masukkan alamat"
                                required>{{ old('address', Auth::user()->address ?? '') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium text-lg mb-3">
                                Tipe Diabetes <span class="text-red-600">*</span>
                            </label>
                            <div class="flex flex-col sm:flex-row sm:space-x-6 space-y-3 sm:space-y-0">
                                <label class="flex items-center space-x-3">
                                    <input type="radio" name="diabetes_type" value="1"
                                        class="h-5 w-5 text-blue-600 accent-secondary focus:ring-blue-500 border-gray-300"
                                        @if(Auth::user()->diabetes_type == "1") checked @endif required>
                                    <span class="text-gray-700 text-lg">Tipe 1</span>
                                </label>
                                <label class="flex items-center space-x-3">
                                    <input type="radio" name="diabetes_type" value="2"
                                        class="h-5 w-5 text-blue-600 accent-secondary focus:ring-blue-500 border-gray-300"
                                        @if(Auth::user()->diabetes_type == "2") checked @endif>
                                    <span class="text-gray-700 text-lg">Tipe 2</span>
                                </label>
                                <label class="flex items-center space-x-3">
                                    <input type="radio" name="diabetes_type" value="gestasional"
                                        class="h-5 w-5 text-blue-600 accent-secondary focus:ring-blue-500 border-gray-300"
                                        @if(Auth::user()->diabetes_type == "gestasional") checked @endif>
                                    <span class="text-gray-700 text-lg">Gestasional</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col space-y-3 pt-10">
                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-2 rounded-lg font-semibold text-lg hover:bg-blue-700 transition">
                        Ubah
                    </button>
                    <button type="button" onclick="window.location='{{route('profile')}}'"
                        class="w-full bg-slate-500 text-white py-2 rounded-lg font-semibold text-lg hover:bg-slate-600 transition">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection