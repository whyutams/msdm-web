@extends('layouts.dashboard')

@section('title', 'Update Profile')

@section('content')
    @if(session('success'))
        <div class="mt-6 mx-auto">
            <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        </div>
    @endif

    <section class="">
        <div class="bg-white shadow rounded-lg">
            <div class="p-5">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
                    <div>
                        <h1 class="text-2xl font-semibold text-gray-800">Update Profile</h1>
                    </div>
                    <div>
                        <nav class="flex" aria-label="Breadcrumb">
                            <ol class="inline-flex items-center space-x-1 sm:space-x-3 text-sm text-gray-600">
                                <li class=" text-gray-400">Profile</li>
                                <li class="before:content-['/'] before:mr-2 text-gray-400">Update</li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <div class="">
                    <form action="{{ route('profile.update') }}" enctype="multipart/form-data" method="POST"
                        class="space-y-4">
                        @csrf

                        <div>
                            <div>
                                <div class="flex justify-center pb-4">
                                    @if(Auth::user()->photo_profile)
                                        <img id="preview" src="{{ asset('storage/' . Auth::user()->photo_profile) }}"
                                            class="w-32 h-32 md:w-48 md:h-48 rounded-full object-cover shadow-lg bg-gray-300">
                                    @else
                                        <div id="initialPreview"
                                            class="md:w-48 md:h-48 w-32 h-32 bg-primary rounded-full flex items-center justify-center text-white font-bold md:text-7xl text-5xl shadow-lg">
                                            {{ strtoupper(substr(Auth::user()->callname, 0, 1)) }}
                                        </div>
                                        <img id="preview"
                                            class="hidden w-32 h-32 md:w-48 md:h-48 rounded-full object-cover shadow-lg bg-gray-300">
                                    @endif
                                </div>

                                <div class="flex justify-center">
                                    <label for="photo_profile"
                                        class="cursor-pointer px-6 py-2 bg-primary hover:bg-blue-800 text-white rounded-lg shadow-lg text-base font-medium transition">
                                        Ganti Foto
                                    </label>
                                    <input type="file" name="photo_profile" id="photo_profile" accept="image/*"
                                        class="hidden">
                                </div>

                                <!-- Modal Crop -->
                                <div id="cropModal"
                                    class="hidden fixed inset-0 bg-black/70 flex items-center justify-center z-50">
                                    <div class="bg-white rounded-lg w-[95%] max-w-2xl h-[90%] flex flex-col">
                                        <div class="flex-1 overflow-auto flex items-center justify-center p-2">
                                            <img id="cropImage" class="max-w-full max-h-full object-contain">
                                        </div>
                                        <div class="flex justify-end gap-2 p-3 border-t">
                                            <button type="button" id="cancelCrop"
                                                class="px-3 py-1 bg-gray-400 text-white rounded">Batal</button>
                                            <button type="button" id="saveCrop"
                                                class="px-3 py-1 bg-blue-600 text-white rounded">Simpan</button>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    $(document).ready(function () {
                                        let cropper;
                                        const photoInput = $('#photo_profile');
                                        const cropModal = $('#cropModal');
                                        const cropImage = $('#cropImage');
                                        const cancelCrop = $('#cancelCrop');
                                        const saveCrop = $('#saveCrop');
                                        const preview = $('#preview');
                                        const initialPreview = $('#initialPreview');

                                        // Saat pilih file
                                        photoInput.on('change', function (e) {
                                            const file = e.target.files[0];
                                            if (!file) return;

                                            const reader = new FileReader();
                                            reader.onload = function () {
                                                cropImage.attr('src', reader.result);
                                                cropModal.removeClass('hidden');

                                                cropImage.on('load', function () {
                                                    if (cropper) cropper.destroy();
                                                    cropper = new Cropper(cropImage[0], { aspectRatio: 1, viewMode: 1 });
                                                });
                                            };
                                            reader.readAsDataURL(file);
                                        });

                                        // Tombol batal
                                        cancelCrop.on('click', function () {
                                            cropModal.addClass('hidden');
                                            photoInput.val('');
                                            if (cropper) cropper.destroy();
                                        });

                                        // Tombol simpan
                                        saveCrop.on('click', function () {
                                            if (!cropper) return;

                                            const canvas = cropper.getCroppedCanvas({ width: 300, height: 300 });

                                            // Sembunyikan inisial & tampilkan foto
                                            if (initialPreview.length) initialPreview.addClass('hidden');
                                            preview.removeClass('hidden').attr('src', canvas.toDataURL('image/png'));

                                            // Masukkan hasil crop ke input file
                                            canvas.toBlob(function (blob) {
                                                const file = new File([blob], 'profile.png', { type: 'image/png' });
                                                const dt = new DataTransfer();
                                                dt.items.add(file);
                                                photoInput[0].files = dt.files;
                                            });

                                            cropModal.addClass('hidden');
                                            cropper.destroy();
                                        });
                                    });
                                </script>
                            </div>

                        </div>

                        <div class="flex flex-col">
                            <label for="username" class="mb-2 font-medium">Username </label>
                            <input type="text" name="username" id="username"
                                class="py-2 px-4 border rounded-lg cursor-not-allowed" value="{{Auth::user()->username}}"
                                disabled readonly>
                        </div>

                        <div class="flex flex-col">
                            <label for="fullname" class="mb-2 font-medium">Nama Lengkap <span
                                    class="text-red-500 text-lg">*</span></label>
                            <input type="text" name="fullname" id="fullname"
                                class="py-2 px-4 border rounded-lg @error('fullname') border-red-500 @enderror focus:ring-2 focus:ring-secondary focus:outline-none"
                                value="{{ old('fullname', Auth::user()->fullname) }}" placeholder="Enter nama lengkap"
                                required>
                            @error('fullname')
                                <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex flex-col">
                            <label for="callname" class="mb-2 font-medium">Nama Panggilan</label>
                            <input type="text" name="callname" id="callname"
                                class="py-2 px-4 border rounded-lg @error('callname') border-red-500 @enderror focus:ring-2 focus:ring-secondary focus:outline-none"
                                value="{{ old('callname', Auth::user()->callname) }}" placeholder="Enter nama panggilan">
                            @error('callname')
                                <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex flex-col">
                            <label for="password" class="mb-2 font-medium">Password Baru<span
                                    class="text-red-500 text-lg"></span></label>
                            <input type="password" name="password" id="password"
                                class="py-2 px-4 border rounded-lg @error('password') border-red-500 @enderror focus:ring-2 focus:ring-secondary focus:outline-none"
                                value="{{ old('password') }}" placeholder="Enter password">
                            <span class="text-slate-500 text-sm mt-1">Note: Kosongkan jika tidak ada perubahan</span>
                            @error('password')
                                <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex flex-col">
                            <label for="password_confirmation" class="mb-2 font-medium">Konfirmasi Password <span
                                    class="text-red-500 text-lg"></span></label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="py-2 px-4 border rounded-lg @error('password_confirmation') border-red-500 @enderror focus:ring-2 focus:ring-secondary focus:outline-none"
                                value="{{ old('password_confirmation') }}" placeholder="Enter konfirmasi password">
                            @error('password_confirmation')
                                <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex flex-col">
                            <label for="old_password" class="mb-2 font-medium">Password Lama<span
                                    class="text-red-500 text-lg"></span></label>
                            <input type="password" name="old_password" id="old_password"
                                class="py-2 px-4 border rounded-lg @error('old_password') border-red-500 @enderror focus:ring-2 focus:ring-secondary focus:outline-none"
                                placeholder="Enter password lama">
                            @error('old_password')
                                <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex justify-end space-x-2">
                            <a href="{{ url('dashboard') }}"
                                class="inline-flex items-center px-4 py-2 rounded bg-gray-500 text-white hover:bg-gray-600">
                                Back
                            </a>
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">
                                <i class="fas fa-save mr-2"></i> Save
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>
@endsection