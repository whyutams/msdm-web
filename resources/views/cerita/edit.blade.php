@extends('layouts.home')

@section('title', 'Ubah Cerita')

@section('content')

    <div class="bg-gray-200 flex items-center justify-center min-h-screen py-12">
        <div class="w-full max-w-5xl bg-white rounded-2xl shadow-lg py-10 px-4 lg:p-14 mx-6">

            <h2 class="text-3xl font-bold text-center text-primary mb-10">Tulis Cerita</h2>

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('cerita.edit.submit', ['cerita'=>$cerita->id]) }}" method="POST" class="space-y-8">
                @csrf
                <div>
                    <textarea rows="3" name="cerita" id="summernote"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('address') border-red-600 @enderror"
                        placeholder="Tulis cerita ..." required>{{ old('cerita', $cerita->cerita) }}</textarea>
                </div>

                <div class="mt-10"></div>
                <div class="flex flex-col space-y-3 pt-10">
                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-2 rounded-lg font-semibold text-lg hover:bg-blue-700 transition">
                        Kirim
                    </button>
                    <button type="button" onclick="window.location='{{route('cerita.show', ['cerita'=>$cerita->id])}}'"
                        class="w-full bg-slate-500 text-white py-2 rounded-lg font-semibold text-lg hover:bg-slate-600 transition">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection