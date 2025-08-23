@php
    use Carbon\Carbon;
    Carbon::setLocale('id'); 
@endphp

@extends('layouts.home')

@section('title', 'Tugas')

@section('content')
    <section class="pb-24 pt-12 bg-white">
        <div class="max-w-6xl mx-auto px-6 sm:px-8 lg:px-12">
            @if(session('success'))
                <div class="mb-10 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Reminder --}}
            <div
                class="w-full bg-gray-50 border border-slate-400 shadow-md rounded-xl p-4 flex items-center justify-between">
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

                <div class="flex items-center hidden">
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

            {{-- Tasks --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mt-12">

                <div
                    class="bg-gray-50 rounded-3xl p-10 shadow hover:shadow-lg transition-all duration-300 border border-gray-200 h-full">

                    <h3 class="font-bold text-primary text-2xl mb-4">Minggu x</h3>
                    <h3 class="font-semibold text-gray-800 text-xl mb-4">Lorem, ipsum.</h3>
                    <p class="text-gray-700 leading-relaxed mb-8 text-lg line-clamp-3 text-justify">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nisi tempore repudiandae aut totam qui
                        fuga aliquam eos ducimus in possimus, repellendus sint voluptatem doloribus adipisci, distinctio
                        sequi ipsa deserunt quasi quia, maxime voluptas dolorem obcaecati? Perspiciatis repellendus
                        architecto aperiam neque nulla! Mollitia sed aut veritatis tempore error unde odio enim.
                    </p>

                    <div class="max-w-md mx-auto mt-4">
                        <button
                            class="toggleBtn w-full flex items-center justify-between px-4 py-2 text-primary font-medium rounded-lg border border-slate-400 hover:border-primary hover:text-blue-800 transition">
                            <span>Lihat Tugas (Belum Selesai)</span>
                            <svg class="arrowIcon w-5 h-5 transform transition-transform duration-300" fill="none"
                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <ul class="materiList mt-3 hidden">
                            <table class="w-full text-left">
                                <tr class="border-b border-gray-200 text-green-600 space-x-2">
                                    <td class="p-2">Materi 1</td>
                                    <td class="p-2">✔️</td>
                                    <td
                                        class="p-2 text-secondary font-medium hover:underline whitespace-nowrap cursor-pointer hidden">
                                        Selesaikan
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-2">Materi 2</td>
                                    <td class="p-2">❌</td>
                                    <td
                                        class="p-2 text-secondary font-medium hover:underline whitespace-nowrap cursor-pointer">
                                        Selesaikan
                                    </td>
                                </tr>
                            </table>
                        </ul>
                    </div>
                </div>
                <div
                    class="bg-gray-50 rounded-3xl p-10 shadow hover:shadow-lg transition-all duration-300 border border-gray-200 h-full">

                    <h3 class="font-bold text-primary text-2xl mb-4">Minggu x</h3>
                    <h3 class="font-semibold text-gray-800 text-xl mb-4">Lorem, ipsum.</h3>
                    <p class="text-gray-700 leading-relaxed mb-8 text-lg line-clamp-3 text-justify">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nisi tempore repudiandae aut totam qui
                        fuga aliquam eos ducimus in possimus, repellendus sint voluptatem doloribus adipisci, distinctio
                        sequi ipsa deserunt quasi quia, maxime voluptas dolorem obcaecati? Perspiciatis repellendus
                        architecto aperiam neque nulla! Mollitia sed aut veritatis tempore error unde odio enim.
                    </p>

                    <div class="max-w-md mx-auto mt-4">
                        <button
                            class="toggleBtn w-full flex items-center justify-between px-4 py-2 text-primary font-medium rounded-lg border border-slate-400 hover:border-primary hover:text-blue-800 transition">
                            <span>Lihat Tugas (Belum Selesai)</span>
                            <svg class="arrowIcon w-5 h-5 transform transition-transform duration-300" fill="none"
                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <ul class="materiList mt-3 hidden">
                            <table class="w-full text-left">
                                <tr class="border-b border-gray-200 text-green-600 space-x-2">
                                    <td class="p-2">Materi 1</td>
                                    <td class="p-2">✔️</td>
                                    <td
                                        class="p-2 text-secondary font-medium hover:underline whitespace-nowrap cursor-pointer hidden">
                                        Selesaikan
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-2">Materi 2</td>
                                    <td class="p-2">❌</td>
                                    <td
                                        class="p-2 text-secondary font-medium hover:underline whitespace-nowrap cursor-pointer">
                                        Selesaikan
                                    </td>
                                </tr>
                            </table>
                        </ul>
                    </div>
                </div>
                <div
                    class="bg-gray-50 rounded-3xl p-10 shadow hover:shadow-lg transition-all duration-300 border border-gray-200 h-full">

                    <h3 class="font-bold text-primary text-2xl mb-4">Minggu x</h3>
                    <h3 class="font-semibold text-gray-800 text-xl mb-4">Lorem, ipsum.</h3>
                    <p class="text-gray-700 leading-relaxed mb-8 text-lg line-clamp-3 text-justify">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nisi tempore repudiandae aut totam qui
                        fuga aliquam eos ducimus in possimus, repellendus sint voluptatem doloribus adipisci, distinctio
                        sequi ipsa deserunt quasi quia, maxime voluptas dolorem obcaecati? Perspiciatis repellendus
                        architecto aperiam neque nulla! Mollitia sed aut veritatis tempore error unde odio enim.
                    </p>

                    <div class="max-w-md mx-auto mt-4">
                        <button
                            class="toggleBtn w-full flex items-center justify-between px-4 py-2 text-primary font-medium rounded-lg border border-slate-400 hover:border-primary hover:text-blue-800 transition">
                            <span>Lihat Tugas (Belum Selesai)</span>
                            <svg class="arrowIcon w-5 h-5 transform transition-transform duration-300" fill="none"
                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <ul class="materiList mt-3 hidden">
                            <table class="w-full text-left">
                                <tr class="border-b border-gray-200 text-green-600 space-x-2">
                                    <td class="p-2">Materi 1</td>
                                    <td class="p-2">✔️</td>
                                    <td
                                        class="p-2 text-secondary font-medium hover:underline whitespace-nowrap cursor-pointer hidden">
                                        Selesaikan
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-2">Materi 2</td>
                                    <td class="p-2">❌</td>
                                    <td
                                        class="p-2 text-secondary font-medium hover:underline whitespace-nowrap cursor-pointer">
                                        Selesaikan
                                    </td>
                                </tr>
                            </table>
                        </ul>
                    </div>
                </div>

            </div>
            <script>
                $(document).on("click", ".toggleBtn", function () {
                    const card = $(this).closest(".max-w-md");
                    card.find(".materiList").slideToggle(300);
                    card.find(".arrowIcon").toggleClass("rotate-180");
                });
            </script>
            {{-- Tasks END --}}

            <div class="mt-16 flex justify-between space-x-4">
                <a href="{{ url()->previous() }}"
                    class="bg-slate-500 text-white px-8 py-3 rounded-xl text-base font-semibold hover:bg-slate-600 hover:shadow-lg transition-all duration-200 w-60 text-center">
                    Kembali
                </a>
            </div>
        </div>
    </section>
@endsection