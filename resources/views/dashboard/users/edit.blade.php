@extends('layouts.dashboard')

@section('title', 'Update Admin')

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
                        <h1 class="text-2xl font-semibold text-gray-800">Update Admin</h1>
                    </div>
                    <div>
                        <nav class="flex" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 sm:space-x-3 text-sm text-gray-600">
                                <li>
                                    <a href="{{ url('dashboard') }}" class="hover:text-blue-600">Dashboard</a>
                                </li>
                                <li class="before:content-['/'] before:mr-2 hover:text-blue-600">
                                    <a href="{{ url('dashboard/users') }}" class="hover:text-blue-600">
                                        Users
                                    </a>
                                </li>
                                <li class="before:content-['/'] before:mr-2 text-gray-400">Update</li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <div class="">
                    <form action="{{ route('dashboard.users.update', $user->id) }}" enctype="multipart/form-data"
                        method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div class="flex flex-col">
                            <label for="username" class="mb-2 font-medium">Username </label>
                            <input type="text" name="username" id="username"
                                class="py-2 px-4 border rounded-lg cursor-not-allowed" value="{{$user->username}}" disabled
                                readonly>
                        </div>

                        <div class="flex flex-col">
                            <label for="fullname" class="mb-2 font-medium">Nama Lengkap <span
                                    class="text-red-500 text-lg">*</span></label>
                            <input type="text" name="fullname" id="fullname"
                                class="py-2 px-4 border rounded-lg @error('fullname') border-red-500 @enderror focus:ring-2 focus:ring-secondary focus:outline-none"
                                value="{{ old('fullname', $user->fullname) }}" placeholder="Enter nama lengkap" required>
                            @error('fullname')
                                <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex flex-col">
                            <label for="callname" class="mb-2 font-medium">Nama Panggilan</label>
                            <input type="text" name="callname" id="callname"
                                class="py-2 px-4 border rounded-lg @error('callname') border-red-500 @enderror focus:ring-2 focus:ring-secondary focus:outline-none"
                                value="{{ old('callname', $user->callname) }}" placeholder="Enter nama panggilan">
                            @error('callname')
                                <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex justify-end space-x-2">
                            <a href="{{ url('dashboard/users') }}"
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