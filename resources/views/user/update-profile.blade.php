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

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <div class="space-y-6">
                        <div>
                            <label for="fullname" class="block text-gray-700 font-medium text-lg mb-2">
                                Nama Lengkap <span class="text-red-600">*</span>
                            </label>
                            <input type="text" id="fullname" name="fullname"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg focus:ring-2 focus:ring-secondary focus:outline-none @error('fullname') border-red-600 @enderror"
                                placeholder="Masukkan nama lengkap" value="{{ old('fullname', Auth::user()->fullname) }}"
                                required>
                        </div>

                        <div>
                            <label for="callname" class="block text-gray-700 font-medium text-lg mb-2">
                                Nama Panggilan <span class="text-red-600">*</span>
                            </label>
                            <input type="text" id="callname" name="callname"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg focus:ring-2 focus:ring-secondary focus:outline-none @error('callname') border-red-600 @enderror"
                                placeholder="Masukkan nama panggilan" value="{{ old('callname', Auth::user()->callname) }}"
                                required>
                        </div>

                        <div>
                            <label for="no_hp" class="block text-gray-700 font-medium text-lg mb-2">
                                Nomor HP <span class="text-red-600">*</span>
                            </label>
                            <input type="text" id="no_hp" name="no_hp"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg focus:ring-2 focus:ring-secondary focus:outline-none @error('no_hp') border-red-600 @enderror"
                                placeholder="Masukkan nomor HP" value="{{ old('no_hp', Auth::user()->no_hp) }}" required>
                        </div>

                        <div>
                            <label for="email" class="block text-gray-700 font-medium text-lg mb-2">
                                Email <span class="text-red-600"></span>
                            </label>
                            <input type="text" id="email" name="email"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg focus:ring-2 focus:ring-secondary focus:outline-none @error('email') border-red-600 @enderror"
                                placeholder="Masukkan email" value="{{ old('email', Auth::user()->email ?? '') }}">
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label for="birth_date" class="block text-gray-700 font-medium text-lg mb-2">
                                Tanggal Lahir <span class="text-red-600">*</span>
                            </label>

                            <input type="date" id="birth_date" name="birth_date"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg focus:ring-2 focus:ring-secondary focus:outline-none @error('birth_date') border-red-600 @enderror"
                                value="{{ old('birth_date', \Carbon\Carbon::parse(Auth::user()->birth_date)->format('Y-m-d') ?? '')}}"
                                required>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium text-lg mb-3">
                                Jenis Kelamin <span class="text-red-600">*</span>
                            </label>
                            <div class="flex flex-row space-x-6">
                                <label class="flex items-center space-x-3">
                                    <input type="radio" name="gender" value="pria"
                                        class="h-5 w-5 text-blue-600 accent-secondary focus:ring-secondary border-gray-300"
                                        required @if(Auth::user()->gender == "pria") checked @endif>
                                    <span class="text-gray-700 text-lg">Pria</span>
                                </label>
                                <label class="flex items-center space-x-3">
                                    <input type="radio" name="gender" value="wanita"
                                        class="h-5 w-5 text-blue-600 accent-secondary focus:ring-secondary border-gray-300">
                                    <span class="text-gray-700 text-lg" @if(Auth::user()->gender == "wanita") checked
                                    @endif>Wanita</span>
                                </label>
                            </div>
                        </div>

                        <div>
                            <label for="address" class="block text-gray-700 font-medium text-lg mb-2">
                                Alamat <span class="text-red-600">*</span>
                            </label>

                            <textarea rows="3" name="address" id="address"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg focus:ring-2 focus:ring-secondary focus:outline-none @error('address') border-red-600 @enderror"
                                placeholder="Masukkan alamat"
                                required>{{ old('address', Auth::user()->address ?? '') }}</textarea>
                        </div> 
                    </div>
                </div>

                <h3 class="text-xl font-semibold pt-4">Biodata</h3>

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

                <h3 class="text-xl font-semibold pt-4">Password</h3>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 lg:gap-12">
                    <div class="space-y-6">
                        <div>
                            <label for="password" class="block text-gray-700 font-medium text-lg mb-2">
                                Password
                            </label>
                            <input type="password" id="password" name="password"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg focus:ring-2 focus:ring-secondary focus:outline-none @error('password') border-red-600 @enderror"
                                placeholder="Masukkan password" value="{{ old('password') }}">
                                <span class="text-slate-500 text-sm mt-1">Note: Kosongkan jika tidak ada perubahan</span>
                        </div> 
                        <div>
                            <label for="password_confirmation" class="block text-gray-700 font-medium text-lg mb-2">
                                Konfirmasi Password
                            </label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg focus:ring-2 focus:ring-secondary focus:outline-none @error('password') border-red-600 @enderror"
                                placeholder="Masukkan konfirmasi password" value="{{ old('password_confirmation') }}">
                        </div> 
                    </div>

                    <div class="space-y-6"> 
                        <div>
                            <label for="old_password" class="block text-gray-700 font-medium text-lg mb-2">
                                Password Lama
                            </label>
                            <input type="password" id="old_password" name="old_password"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg focus:ring-2 focus:ring-secondary focus:outline-none @error('password_old') border-red-600 @enderror"
                                placeholder="Masukkan konfirmasi password" value="{{ old('old_password') }}">
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