@extends('layouts.dashboard')

@section('title', 'Add Materi')

@section('content')
    @if(session('success'))
        <div class="mt-6 mx-auto">
            <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
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

    <section class="">
        <div class="bg-white shadow rounded-lg">
            <div class="p-5">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
                    <div>
                        <h1 class="text-2xl font-semibold text-gray-800">
                            Materi untuk tugas minggu ke-{{ $tugas->minggu }}
                        </h1>
                    </div>
                    <div>
                        <nav class="flex" aria-label="Breadcrumb">
                            <ol class="inline-flex items-center space-x-1 sm:space-x-3 text-sm text-gray-600">
                                <li>
                                    <a href="{{ url('dashboard') }}" class="hover:text-blue-600">Dashboard</a>
                                </li>
                                <li class="before:content-['/'] before:mr-2 hover:text-blue-600">
                                    <a href="{{ url('dashboard/tugas') }}" class="hover:text-blue-600">Tugas</a>
                                </li>
                                <li class="before:content-['/'] before:mr-2 text-gray-400">Materi</li>
                                <li class="before:content-['/'] before:mr-2 text-gray-400">Add</li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <div>
                    <form action="{{ route('dashboard.tugas.materi.store', $tugas->id) }}" method="POST" onsubmit="confirm('Apakah materi sudah sesuai?')"
                        enctype="multipart/form-data" class="space-y-4">
                        @csrf

                        <div class="flex flex-col">
                            <label for="name" class="mb-2 font-medium">Name <span class="text-red-600">*</span></label>
                            <input type="text" name="name" id="name"
                                class="py-2 px-4 border rounded-lg @error('name') border-red-500 @enderror focus:ring-2 focus:ring-secondary focus:outline-none"
                                value="{{ old('name') }}" placeholder="Enter name" required>
                            @error('name')
                                <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex flex-col">
                            <label for="urutan" class="mb-2 font-medium">Materi ke</label>
                            <input type="text" id="urutan"
                                class="py-2 px-4 border rounded-lg focus:ring-2 focus:ring-secondary focus:outline-none cursor-not-allowed"
                                value="{{ $last_urutan + 1 }}" disabled readonly>
                        </div>

                        <div class="flex flex-col">
                            <label for="jenis" class="mb-2 font-medium">Jenis <span class="text-red-600">*</span></label>
                            <div class="relative">
                                <select name="jenis" id="jenis"
                                    class="appearance-none w-full py-2 px-4 pr-10 border rounded-lg focus:ring-2 focus:ring-secondary focus:outline-none cursor-pointer">
                                    <option value="text" {{ old('jenis') === 'text' ? 'selected' : '' }}>Text</option>
                                    <option value="file" {{ old('jenis') === 'file' ? 'selected' : '' }}>File (PDF/PPT)
                                    </option>
                                    <option value="link" {{ old('jenis') === 'link' ? 'selected' : '' }}>Youtube Video
                                    </option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div id="content-wrapper" class="flex flex-col hidden">
                            <label for="content" class="mb-2 font-medium">Content <span
                                    class="text-red-600">*</span></label>
                            <textarea name="content" id="summernote" rows="4"
                                class="py-2 px-4 border rounded-lg focus:ring-2 focus:ring-secondary focus:outline-none"
                                placeholder="Enter content">{{ old('content') }}</textarea>
                        </div>

                        <div id="file-wrapper" class="flex flex-col hidden">
                            <label for="file" class="mb-2 font-medium">Upload File (PDF/PPT) <span
                                    class="text-red-600">*</span></label>
                            <input type="file" name="file_path" id="file" accept=".pdf,.ppt,.pptx"
                                class="py-2 px-4 border rounded-lg focus:ring-2 focus:ring-secondary focus:outline-none">
                        </div>
                        
                        <div id="link-wrapper" class="flex flex-col hidden">
                            <label for="link" class="mb-2 font-medium">Youtube Link <span
                                    class="text-red-600">*</span></label>
                            <input type="url" name="link" id="link"
                                class="py-2 px-4 border rounded-lg focus:ring-2 focus:ring-secondary focus:outline-none"
                                value="{{ old('link') }}" placeholder="https://youtube.com/...">
                            <span class="text-slate-500 text-sm mt-1">Note: Pastikan link yang diberikan bersifat publik.</span>
                        </div>

                        <div class="flex justify-end space-x-2">
                            <a href="{{ url('dashboard/tugas', $tugas->id) }}"
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

    <script>
        $(document).ready(function () {
            function toggleJenis() {
                let jenis = $('#jenis').val();

                $('#content-wrapper, #file-wrapper, #link-wrapper').addClass('hidden')
                    .find('textarea, input').prop('disabled', true).prop('required', false);

                if (jenis === 'text') {
                    $('#content-wrapper').removeClass('hidden');
                    $('#summernote').prop('disabled', false).prop('required', true);
                } else if (jenis === 'file') {
                    $('#file-wrapper').removeClass('hidden');
                    $('#file').prop('disabled', false).prop('required', true);
                } else if (jenis === 'link') {
                    $('#link-wrapper').removeClass('hidden');
                    $('#link').prop('disabled', false).prop('required', true);
                }
            }

            toggleJenis();

            $('#jenis').on('change', function () {
                toggleJenis();
            });
        });
    </script>


@endsection