@extends('layouts.home')

@section('title', 'Detail Cerita')

@section('content')

    <!-- Cerita Section -->
    <section class="pb-24 pt-12 bg-white">
        <div class="max-w-6xl mx-auto px-6 sm:px-8 lg:px-12">
            @auth
                {{-- Reminder --}}
                <div
                    class="w-full mx-auto mb-12 bg-gray-50 border border-slate-400 shadow-md rounded-xl p-4 flex items-center justify-between">
                    <div>
                        <div class="relative w-16 h-16">
                            <svg class="w-16 h-16 transform -rotate-90">
                                <circle cx="32" cy="32" r="28" stroke="#e5e7eb" stroke-width="6" fill="transparent" />
                                <circle id="progressCircle" cx="32" cy="32" r="28" stroke="#4a67f7" stroke-width="6"
                                    fill="transparent" stroke-dasharray="176" stroke-dashoffset="176" stroke-linecap="round" />
                            </svg>
                            <span id="progressText"
                                class="absolute inset-0 flex items-center justify-center text-sm font-semibold text-gray-700">
                                0%
                            </span>
                        </div>
                    </div>

                    <div class="flex-1 px-4">
                        <p class="text-gray-800 font-medium"><span class="font-bold">[1/2]</span> Anda belum menyelesaikan tugas
                            minggu ke-x.</p>
                    </div>

                    <div class="flex items-center">
                        <a href="{{ url('/mytask') }}" class="text-secondary font-semibold hover:underline whitespace-nowrap">
                            Selesaikan Tugas
                        </a>
                    </div>
                </div>

                <script>
                    function easeOutQuad(t) {
                        return t * (2 - t);
                    }

                    $(document).ready(function () {
                        const $circle = $("#progressCircle");
                        const $text = $("#progressText");
                        const target = 50;
                        const duration = 1000;
                        const circumference = 176;
                        const startTime = performance.now();

                        function animate() {
                            const now = performance.now();
                            let progress = (now - startTime) / duration;
                            if (progress > 1) progress = 1;

                            let eased = easeOutQuad(progress);
                            let value = Math.floor(target * eased);

                            $circle.attr("stroke-dashoffset", circumference - (circumference * value / 100));
                            $text.text(value + "%");

                            if (progress < 1) {
                                requestAnimationFrame(animate);
                            }
                        }

                        requestAnimationFrame(animate);
                    });
                </script>
                {{-- Reminder END --}}
            @endauth

            @if(session('success'))
                <div class="max-w-6xl mx-auto">
                    <div class="mb-10 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            <div class="flex items-center mb-8">
                <div class="w-24 h-24 rounded-full bg-gray-300 flex items-center justify-center overflow-hidden">
                    @if($cerita->user->photo_profile)
                        <img src="{{ asset(path: 'storage/' . $cerita->user->photo_profile) }}" alt="Profile"
                            class="w-full h-full object-cover">
                    @else
                        <span
                            class="text-white font-bold text-4xl bg-primary w-full h-full flex items-center justify-center rounded-full">
                            {{ strtoupper(substr($cerita->user->callname, 0, 1)) }}
                        </span>
                    @endif
                </div>
                <div class="ml-6">
                    <h3 class="font-semibold text-gray-800 text-2xl">{{ $cerita->user->callname }}</h3>
                    <h6 class="font-semibold text-gray-600 mb-2 text-lg">{{ $cerita->user->fullname }}</h6>
                    <p class="text-lg text-gray-600">Tipe {{ $cerita->user->diabetes_type }}</p>
                </div>
            </div>
            <p class="text-gray-700 leading-relaxed mb-8 text-lg text-justify">
                {{ strip_tags($cerita->cerita) }}
            </p>

            <div class="mt-12 flex justify-between space-x-4">
                <a href="{{ route('cerita') }}"
                    class="bg-slate-500 text-white px-8 py-3 rounded-xl text-base font-semibold hover:bg-slate-600 hover:shadow-lg transition-all duration-200 w-60 text-center">
                    Kembali
                </a>
                @if (Auth::id() == $cerita->user_id)
                    <a href="{{route('cerita.edit', ['cerita' => $cerita->id])}}"
                        class="bg-primary text-white px-8 py-3 rounded-xl text-base font-semibold hover:bg-blue-800 hover:shadow-lg transition-all duration-200 w-60 text-center">
                        Ubah Cerita
                    </a>
                @endif
            </div>
        </div>
    </section>

@endsection