@extends('layouts.home')

@section('title', 'Cerita')

@section('content')

    <!-- Kelas Sebaya Section -->
    <section id="stories" class="pb-24 pt-12 bg-white">
        <div class="max-w-[100rem] mx-auto px-6 sm:px-8 lg:px-12">
            <div class="max-w-6xl flex justify-center mx-auto lg:px-12">
                @auth
                    {{-- Reminder --}}
                    <div
                        class="w-full max-w-6xl mx-auto mb-12 bg-gray-50 border border-slate-400 shadow-md rounded-xl p-4 flex items-center justify-between">
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

            <div class="text-center mb-20">
                <h2 class="text-3xl md:text-4xl font-bold text-primary mb-8">
                    Kelas Sebaya
                </h2>
                <p class="text-lg md:text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed">
                    Dapatkan dukungan, atau hubungi teman sebaya yang siap membantu Anda!
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($kontak_sebayas as $index => $kontak_sebaya)
                    <div
                        class="bg-gray-50 border border-slate-300 rounded-2xl shadow hover:shadow-lg transition-all duration-300 p-6 flex flex-col justify-between">
                        <div>
                            <h3 class="text-xl font-bold text-gray-800 mb-4">{{ $kontak_sebaya->name }}</h3>
                            <p class="text-gray-600 mb-4">{{ $kontak_sebaya->description }}</p>
                            <p class="text-sm text-gray-500 mb-6">Nomor: <span
                                    class="font-medium">{{ $kontak_sebaya->number }}</span></p>
                        </div>
                        <a href="https://wa.me/{{ $kontak_sebaya->number }}" target="_blank"
                            class="bg-green-500 hover:bg-green-600 text-white text-center font-semibold py-2 px-4 rounded-lg transition">
                            <i class="fas fa-brands font-normal text-xl fa-whatsapp mr-1"></i> Hubungi via WhatsApp
                        </a>
                    </div>
                @empty
                    </div>
                    <div class="flex justify-center">
                        <p class="text-gray-600 text-lg text-center">Belum ada data.</p>
                    </div>
                @endforelse

        </div>
    </section>

@endsection