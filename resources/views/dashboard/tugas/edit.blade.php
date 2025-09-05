@extends('layouts.dashboard')

@section('title', 'Add Tugas')

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
                        <h1 class="text-2xl font-semibold text-gray-800">Add Tugas</h1>
                    </div>
                    <div>
                        <nav class="flex" aria-label="Breadcrumb">
                            <ol class="inline-flex items-center space-x-1 sm:space-x-3 text-sm text-gray-600">
                                <li>
                                    <a href="{{ url('dashboard') }}" class="hover:text-blue-600">Dashboard</a>
                                </li>
                                <li class="before:content-['/'] before:mr-2 hover:text-blue-600">
                                    <a href="{{ url('dashboard/tugas') }}" class="hover:text-blue-600">
                                        Tugas
                                    </a>
                                </li>
                                <li class="before:content-['/'] before:mr-2 text-gray-400">Add</li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <div class="">
                    <form action="{{ route('dashboard.tugas.update', $tugas->id) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div class="flex flex-col">
                            <label for="title" class="mb-2 font-medium">Title</label>
                            <input type="text" name="title" id="title"
                                class="py-2 px-4 border rounded-lg @error('title') border-red-500 @enderror focus:ring-2 focus:ring-secondary focus:outline-none"
                                value="{{ old('title', $tugas->title) }}" placeholder="Enter title" required>
                            @error('title')
                                <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex flex-col">
                            <label for="description" class="mb-2 font-medium">Description</label>
                            <textarea name="description" id="description" rows="4"
                                class="py-2 px-4 border rounded-lg @error('description') border-red-500 @enderror focus:ring-2 focus:ring-secondary focus:outline-none"
                                placeholder="Enter description" required>{{ old('description', $tugas->description) }}</textarea>
                            @error('description')
                                <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex flex-col">
                            <label for="minggu" class="mb-2 font-medium">Minggu ke</label>
                            <input type="text" name="minggu" id="minggu"
                                class="py-2 px-4 border rounded-lg focus:ring-2 focus:ring-secondary focus:outline-none cursor-not-allowed"
                                placeholder="Enter minggu" value="{{$tugas->minggu}}" disabled readonly>
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
@endsection