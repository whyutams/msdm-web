@extends('layouts.home')

@section('title', 'Cerita')

@section('content')

    <!-- Cerita Section -->
    <section id="stories" class="pb-24 pt-12 bg-white">
        <div class="max-w-[100rem] mx-auto px-6 sm:px-8 lg:px-12">
            <div class="max-w-6xl flex justify-center mx-auto px-6 sm:px-8 lg:px-12">
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

            <div class="text-center mb-20">
                <h2 class="text-3xl md:text-4xl font-bold text-primary mb-8">
                    Cerita Pengalaman
                </h2>
                <p class="text-lg md:text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed">
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aut minima laboriosam quisquam porro nisi.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                <div
                    class="bg-gray-50 rounded-3xl p-10 shadow hover:shadow-lg transition-all duration-300 border border-gray-200 h-full">
                    <div class="flex items-center mb-8">
                        <div
                            class="w-16 h-16 bg-primary rounded-full flex items-center justify-center text-white font-bold text-lg shadow-lg">
                            M
                        </div>
                        <div class="ml-6">
                            <h3 class="font-semibold text-gray-800 text-xl">Lorem, ipsum.</h3>
                            <p class="text-base text-gray-600 mt-2">Diabetes Menengah</p>
                        </div>
                    </div>
                    <p class="text-gray-700 leading-relaxed mb-8 text-lg line-clamp-3 text-justify">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nisi tempore repudiandae aut totam qui
                        fuga aliquam eos ducimus in possimus, repellendus sint voluptatem doloribus adipisci, distinctio
                        sequi ipsa deserunt quasi quia, maxime voluptas dolorem obcaecati? Perspiciatis repellendus
                        architecto aperiam neque nulla! Mollitia sed aut veritatis tempore error unde odio enim.
                    </p>
                    <a href="{{url('/cerita/1')}}"
                        class="bg-secondary text-white px-8 py-3 rounded-xl text-base font-semibold hover:bg-blue-600 hover:shadow-lg transition-all duration-200 w-full">
                        Lihat Selengkapnya
                    </a>
                </div>
                <div
                    class="bg-gray-50 rounded-3xl p-10 shadow hover:shadow-lg transition-all duration-300 border border-gray-200 h-full">
                    <div class="flex items-center mb-8">
                        <div
                            class="w-16 h-16 bg-primary rounded-full flex items-center justify-center text-white font-bold text-lg shadow-lg">
                            M
                        </div>
                        <div class="ml-6">
                            <h3 class="font-semibold text-gray-800 text-xl">Lorem, ipsum.</h3>
                            <p class="text-base text-gray-600 mt-2">Diabetes Menengah</p>
                        </div>
                    </div>
                    <p class="text-gray-700 leading-relaxed mb-8 text-lg line-clamp-3 text-justify">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nisi tempore repudiandae aut totam qui
                        fuga aliquam eos ducimus in possimus, repellendus sint voluptatem doloribus adipisci, distinctio
                        sequi ipsa deserunt quasi quia, maxime voluptas dolorem obcaecati? Perspiciatis repellendus
                        architecto aperiam neque nulla! Mollitia sed aut veritatis tempore error unde odio enim.
                    </p>
                    <a href="{{url('/cerita/1')}}"
                        class="bg-secondary text-white px-8 py-3 rounded-xl text-base font-semibold hover:bg-blue-600 hover:shadow-lg transition-all duration-200 w-full">
                        Lihat Selengkapnya
                    </a>
                </div>
                <div
                    class="bg-gray-50 rounded-3xl p-10 shadow hover:shadow-lg transition-all duration-300 border border-gray-200 h-full">
                    <div class="flex items-center mb-8">
                        <div
                            class="w-16 h-16 bg-primary rounded-full flex items-center justify-center text-white font-bold text-lg shadow-lg">
                            M
                        </div>
                        <div class="ml-6">
                            <h3 class="font-semibold text-gray-800 text-xl">Lorem, ipsum.</h3>
                            <p class="text-base text-gray-600 mt-2">Diabetes Menengah</p>
                        </div>
                    </div>
                    <p class="text-gray-700 leading-relaxed mb-8 text-lg line-clamp-3 text-justify">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nisi tempore repudiandae aut totam qui
                        fuga aliquam eos ducimus in possimus, repellendus sint voluptatem doloribus adipisci, distinctio
                        sequi ipsa deserunt quasi quia, maxime voluptas dolorem obcaecati? Perspiciatis repellendus
                        architecto aperiam neque nulla! Mollitia sed aut veritatis tempore error unde odio enim.
                    </p>
                    <a href="{{url('/cerita/1')}}"
                        class="bg-secondary text-white px-8 py-3 rounded-xl text-base font-semibold hover:bg-blue-600 hover:shadow-lg transition-all duration-200 w-full">
                        Lihat Selengkapnya
                    </a>
                </div>
                <div
                    class="bg-gray-50 rounded-3xl p-10 shadow hover:shadow-lg transition-all duration-300 border border-gray-200 h-full">
                    <div class="flex items-center mb-8">
                        <div
                            class="w-16 h-16 bg-primary rounded-full flex items-center justify-center text-white font-bold text-lg shadow-lg">
                            M
                        </div>
                        <div class="ml-6">
                            <h3 class="font-semibold text-gray-800 text-xl">Lorem, ipsum.</h3>
                            <p class="text-base text-gray-600 mt-2">Diabetes Menengah</p>
                        </div>
                    </div>
                    <p class="text-gray-700 leading-relaxed mb-8 text-lg line-clamp-3 text-justify">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nisi tempore repudiandae aut totam qui
                        fuga aliquam eos ducimus in possimus, repellendus sint voluptatem doloribus adipisci, distinctio
                        sequi ipsa deserunt quasi quia, maxime voluptas dolorem obcaecati? Perspiciatis repellendus
                        architecto aperiam neque nulla! Mollitia sed aut veritatis tempore error unde odio enim.
                    </p>
                    <a href="{{url('/cerita/1')}}"
                        class="bg-secondary text-white px-8 py-3 rounded-xl text-base font-semibold hover:bg-blue-600 hover:shadow-lg transition-all duration-200 w-full">
                        Lihat Selengkapnya
                    </a>
                </div>
                <div
                    class="bg-gray-50 rounded-3xl p-10 shadow hover:shadow-lg transition-all duration-300 border border-gray-200 h-full">
                    <div class="flex items-center mb-8">
                        <div
                            class="w-16 h-16 bg-primary rounded-full flex items-center justify-center text-white font-bold text-lg shadow-lg">
                            M
                        </div>
                        <div class="ml-6">
                            <h3 class="font-semibold text-gray-800 text-xl">Lorem, ipsum.</h3>
                            <p class="text-base text-gray-600 mt-2">Diabetes Menengah</p>
                        </div>
                    </div>
                    <p class="text-gray-700 leading-relaxed mb-8 text-lg line-clamp-3 text-justify">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nisi tempore repudiandae aut totam qui
                        fuga aliquam eos ducimus in possimus, repellendus sint voluptatem doloribus adipisci, distinctio
                        sequi ipsa deserunt quasi quia, maxime voluptas dolorem obcaecati? Perspiciatis repellendus
                        architecto aperiam neque nulla! Mollitia sed aut veritatis tempore error unde odio enim.
                    </p>
                    <a href="{{url('/cerita/1')}}"
                        class="bg-secondary text-white px-8 py-3 rounded-xl text-base font-semibold hover:bg-blue-600 hover:shadow-lg transition-all duration-200 w-full">
                        Lihat Selengkapnya
                    </a>
                </div>
                <div
                    class="bg-gray-50 rounded-3xl p-10 shadow hover:shadow-lg transition-all duration-300 border border-gray-200 h-full">
                    <div class="flex items-center mb-8">
                        <div
                            class="w-16 h-16 bg-primary rounded-full flex items-center justify-center text-white font-bold text-lg shadow-lg">
                            M
                        </div>
                        <div class="ml-6">
                            <h3 class="font-semibold text-gray-800 text-xl">Lorem, ipsum.</h3>
                            <p class="text-base text-gray-600 mt-2">Diabetes Menengah</p>
                        </div>
                    </div>
                    <p class="text-gray-700 leading-relaxed mb-8 text-lg line-clamp-3 text-justify">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nisi tempore repudiandae aut totam qui
                        fuga aliquam eos ducimus in possimus, repellendus sint voluptatem doloribus adipisci, distinctio
                        sequi ipsa deserunt quasi quia, maxime voluptas dolorem obcaecati? Perspiciatis repellendus
                        architecto aperiam neque nulla! Mollitia sed aut veritatis tempore error unde odio enim.
                    </p>
                    <a href="{{url('/cerita/1')}}"
                        class="bg-secondary text-white px-8 py-3 rounded-xl text-base font-semibold hover:bg-blue-600 hover:shadow-lg transition-all duration-200 w-full">
                        Lihat Selengkapnya
                    </a>
                </div>
                <div
                    class="bg-gray-50 rounded-3xl p-10 shadow hover:shadow-lg transition-all duration-300 border border-gray-200 h-full">
                    <div class="flex items-center mb-8">
                        <div
                            class="w-16 h-16 bg-primary rounded-full flex items-center justify-center text-white font-bold text-lg shadow-lg">
                            M
                        </div>
                        <div class="ml-6">
                            <h3 class="font-semibold text-gray-800 text-xl">Lorem, ipsum.</h3>
                            <p class="text-base text-gray-600 mt-2">Diabetes Menengah</p>
                        </div>
                    </div>
                    <p class="text-gray-700 leading-relaxed mb-8 text-lg line-clamp-3 text-justify">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nisi tempore repudiandae aut totam qui
                        fuga aliquam eos ducimus in possimus, repellendus sint voluptatem doloribus adipisci, distinctio
                        sequi ipsa deserunt quasi quia, maxime voluptas dolorem obcaecati? Perspiciatis repellendus
                        architecto aperiam neque nulla! Mollitia sed aut veritatis tempore error unde odio enim.
                    </p>
                    <a href="{{url('/cerita/1')}}"
                        class="bg-secondary text-white px-8 py-3 rounded-xl text-base font-semibold hover:bg-blue-600 hover:shadow-lg transition-all duration-200 w-full">
                        Lihat Selengkapnya
                    </a>
                </div>
                <div
                    class="bg-gray-50 rounded-3xl p-10 shadow hover:shadow-lg transition-all duration-300 border border-gray-200 h-full">
                    <div class="flex items-center mb-8">
                        <div
                            class="w-16 h-16 bg-primary rounded-full flex items-center justify-center text-white font-bold text-lg shadow-lg">
                            M
                        </div>
                        <div class="ml-6">
                            <h3 class="font-semibold text-gray-800 text-xl">Lorem, ipsum.</h3>
                            <p class="text-base text-gray-600 mt-2">Diabetes Menengah</p>
                        </div>
                    </div>
                    <p class="text-gray-700 leading-relaxed mb-8 text-lg line-clamp-3 text-justify">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nisi tempore repudiandae aut totam qui
                        fuga aliquam eos ducimus in possimus, repellendus sint voluptatem doloribus adipisci, distinctio
                        sequi ipsa deserunt quasi quia, maxime voluptas dolorem obcaecati? Perspiciatis repellendus
                        architecto aperiam neque nulla! Mollitia sed aut veritatis tempore error unde odio enim.
                    </p>
                    <a href="{{url('/cerita/1')}}"
                        class="bg-secondary text-white px-8 py-3 rounded-xl text-base font-semibold hover:bg-blue-600 hover:shadow-lg transition-all duration-200 w-full">
                        Lihat Selengkapnya
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection