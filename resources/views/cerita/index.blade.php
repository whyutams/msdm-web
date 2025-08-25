@php
    use Carbon\Carbon;
    Carbon::setLocale('id'); 
@endphp

@extends('layouts.home')

@section('title', 'Cerita')

@section('content')

    <!-- Cerita Section -->
    <section id="stories" class="pb-24 pt-12 bg-white">
        <div class="max-w-[100rem] mx-auto px-6 sm:px-8 lg:px-12">
            <div class="max-w-6xl flex justify-center mx-auto lg:px-12">
                @auth
                    {{-- Reminder --}}
                    <div
                        class="w-full mx-auto mb-12 bg-gray-50 border border-slate-400 shadow-md rounded-xl p-4 flex items-center justify-between">
                        <div>
                            <div class="relative w-16 h-16">
                                <svg class="w-16 h-16 transform -rotate-90">
                                    <circle cx="32" cy="32" r="28" stroke="#e5e7eb" stroke-width="6" fill="transparent" />
                                    <circle id="progressCircle" cx="32" cy="32" r="28" stroke="#4a67f7" stroke-width="6"
                                        fill="transparent" stroke-dasharray="176" stroke-dashoffset="176"
                                        stroke-linecap="round" />
                                </svg>
                                <span id="progressText"
                                    class="absolute inset-0 flex items-center justify-center text-sm font-semibold text-gray-700">
                                    0%
                                </span>
                            </div>
                        </div>

                        <div class="flex-1 px-4">
                            <p class="text-gray-800 font-medium"><span class="font-bold">[1/2]</span> Anda belum menyelesaikan
                                tugas
                                minggu ke-x.</p>
                        </div>

                        <div class="flex items-center">
                            <a href="{{ url('/mytask') }}"
                                class="text-secondary font-semibold hover:underline whitespace-nowrap">
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
            </div>

            @if(session('success'))
                <div class="lg:px-12 max-w-6xl mx-auto">
                    <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-primary mb-8">
                    Cerita Pengalaman
                </h2>
                <p class="text-lg md:text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed">
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aut minima laboriosam quisquam porro nisi.
                </p>
            </div>

            <div class="flex justify-between items-center mb-12">
                <div>
                    @auth
                        <a href="{{url('/cerita/add')}}"
                            class="bg-primary text-white px-8 py-3 rounded-xl text-base font-semibold hover:bg-blue-800 hover:shadow-lg transition-all duration-200">
                            <i class="fas fa-pen mr-2"></i>Tulis Cerita
                        </a>
                    @endauth
                </div>
                <div class="w-1/2 lg:w-auto">
                    <input type="text" id="search"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg text-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="Cari ...">
                </div>
            </div>


            <div id="cards" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($ceritas as $index => $cerita)
                    <div
                        class="card bg-gray-50 rounded-3xl p-10 shadow hover:shadow-lg transition-all duration-300 border border-gray-200 h-full">
                        <div class="flex items-center mb-8">
                            <div class="w-20 h-20 rounded-full bg-gray-300 flex items-center justify-center overflow-hidden">
                                @if($cerita->user->photo_profile)
                                    <img src="{{ asset('storage/' . $cerita->user->photo_profile) }}" alt="Profile"
                                        class="w-full h-full object-cover">
                                @else
                                    <span
                                        class="text-white font-bold text-4xl bg-primary w-full h-full flex items-center justify-center rounded-full">
                                        {{ strtoupper(substr($cerita->user->callname, 0, 1)) }}
                                    </span>
                                @endif
                            </div>
                            <div class="ml-6">
                                <h3 class="font-semibold text-gray-800 text-lg">{{ $cerita->user->callname }}</h3>
                                <h6 class="font-semibold text-gray-600 mb-2 text-base">{{ $cerita->user->fullname }}</h6>
                                <p class="text-base text-gray-600">Tipe {{ $cerita->user->diabetes_type }}</p>
                            </div>
                        </div>

                        <p class="text-gray-700 leading-relaxed mb-8 text-lg line-clamp-2 text-justify">
                            {{ strip_tags($cerita->cerita) }}
                        </p>
                        <div class="flex justify-between">
                            <div>
                                <a href="{{url('/cerita/' . $cerita->id)}}"
                                    class="bg-secondary text-white px-8 py-3 rounded-xl text-base font-semibold hover:bg-blue-600 hover:shadow-lg transition-all duration-200 w-full">
                                    Lihat Selengkapnya
                                </a>
                            </div>
                            <small class="text-primary"><i class="fas fa-calendar mr-1"></i> {{ Carbon::parse($cerita->created_at)->translatedFormat('d M Y') }}</small>
                        </div>
                    </div>
                @empty
                    <div class="flex flex-col justify-center pt-16 col-span-3">
                        <p class="text-gray-600 text-lg text-center">Belum ada cerita yang dibagikan.</p>
                        <small class="text-center">
                            <a href="{{ url('/cerita/add') }}" class="text-secondary hover:underline text-base">
                                <i class="fas fa-pen mr-2 text-secondary"></i>Buat cerita Anda.
                            </a>
                        </small>
                    </div>
                @endforelse
            </div>

            <script>
                document.getElementById("search").addEventListener("keyup", function () {
                    let value = this.value.toLowerCase();
                    document.querySelectorAll("#cards .card").forEach(function (card) {
                        let text = card.innerText.toLowerCase();
                        card.style.display = text.includes(value) ? "block" : "none";
                    });
                });
            </script>
    </section>

@endsection