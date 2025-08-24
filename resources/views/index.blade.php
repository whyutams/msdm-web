@extends('layouts.home')

@section('title', 'Beranda')

@section('content')

    <!-- Hero Section -->
    <section id="home" class="min-h-screen flex items-center justify-center relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 via-white to-blue-100"></div>
        <div class="absolute top-40 left-20 w-48 h-48 bg-secondary/8 rounded-full blur-3xl"></div>
        <div class="absolute bottom-40 right-20 w-64 h-64 bg-primary/8 rounded-full blur-3xl"></div>

        @auth
            {{-- Reminder --}}
            <div class="absolute max-w-6xl mx-auto top-12 left-0 right-0 px-6 sm:px-8 lg:px-12">
                <div
                    class="max-w-6xl mx-auto bg-gray-50 border border-slate-400 shadow-md rounded-xl p-4 flex items-center justify-between">
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
        <div class="relative z-10 max-w-6xl mx-auto text-center px-6 sm:px-8 lg:px-12">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-primary mb-12 leading-tight">
                Lorem, ipsum dolor.
                <span class="text-secondary block mt-6">Lorem, ipsum.</span>
            </h1>
            <p class="text-xl md:text-2xl text-gray-700 mb-16 max-w-5xl mx-auto leading-relaxed font-medium">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto sint optio, porro assumenda nulla
                dignissimos!
            </p>
            @guest
                <a href="{{url('/register')}}"
                    class="bg-primary text-white px-16 py-5 rounded-2xl text-xl font-semibold hover:bg-blue-800 hover:shadow-2xl transform hover:scale-105 transition-all duration-300 shadow-xl">
                    Daftar
                </a>
            @endguest
        </div>
    </section>

    <!-- Cerita Section -->
    @if ($ceritas->count() > 0)
        <section id="stories" class="py-24 bg-white">
            <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
                <div class="text-center mb-20">
                    <h2 class="text-3xl md:text-4xl font-bold text-primary mb-8">
                        Cerita Pengalaman
                    </h2>
                    <p class="text-lg md:text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aut minima laboriosam quisquam porro nisi.
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    @foreach($ceritas as $index => $cerita)
                        <div
                            class="bg-gray-50 rounded-3xl p-10 shadow hover:shadow-lg transition-all duration-300 border border-gray-200 h-full">
                            <div class="flex items-center mb-8">
                                <div class="w-20 h-20 rounded-full bg-gray-300 flex items-center justify-center overflow-hidden">
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
                                    <h3 class="font-semibold text-gray-800 text-xl">{{ $cerita->user->callname }}</h3>
                                    <h6 class="font-semibold text-gray-600 mb-2 text-base">{{ $cerita->user->fullname }}</h6>
                                    <p class="text-base text-gray-600">Tipe {{ $cerita->user->diabetes_type }}</p>
                                </div>
                            </div>
                            <p class="text-gray-700 leading-relaxed mb-8 text-lg line-clamp-2 text-justify">
                                {{ strip_tags($cerita->cerita) }}
                            </p>
                            <a href="{{url('/cerita/' . $cerita->id)}}"
                                class="bg-secondary text-white px-8 py-3 rounded-xl text-base font-semibold hover:bg-blue-600 hover:shadow-lg transition-all duration-200 w-full">
                                Lihat Selengkapnya
                            </a>
                        </div>

                    @endforeach
                </div>

                <div class="flex justify-center mt-20">
                    <a href="{{url("/cerita")}}"
                        class="bg-primary text-white px-16 py-5 rounded-2xl text-lg font-semibold hover:bg-blue-800 hover:shadow-xl transform transition-all duration-300 shadow">
                        Lihat Semua Cerita
                    </a>
                </div>
            </div>
            </div>
        </section>
    @endif

@endsection