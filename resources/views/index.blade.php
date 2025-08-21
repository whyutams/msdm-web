@extends('layouts.home')

@section('title', 'Beranda')

@section('content')

    <!-- Hero Section -->
    <section id="home" class="min-h-screen flex items-center justify-center relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 via-white to-blue-100"></div>
        <div class="absolute top-40 left-20 w-48 h-48 bg-secondary/8 rounded-full blur-3xl"></div>
        <div class="absolute bottom-40 right-20 w-64 h-64 bg-primary/8 rounded-full blur-3xl"></div>

        <div class="relative z-10 max-w-6xl mx-auto text-center px-6 sm:px-8 lg:px-12">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-primary mb-12 leading-tight">
                Lorem, ipsum dolor.
                <span class="text-secondary block mt-6">Lorem, ipsum.</span>
            </h1>
            <p class="text-xl md:text-2xl text-gray-700 mb-16 max-w-5xl mx-auto leading-relaxed font-medium">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto sint optio, porro assumenda nulla
                dignissimos!
            </p>
            <a href="{{url('/register')}}"
                class="bg-primary text-white px-16 py-5 rounded-2xl text-xl font-semibold hover:bg-blue-800 hover:shadow-2xl transform hover:scale-105 transition-all duration-300 shadow-xl">
                Daftar
            </a>
        </div>
    </section>

    <!-- Cerita Section -->
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
                <div
                    class="bg-gray-50 rounded-3xl p-10 shadow hover:shadow-lg transition-all duration-300 border-2 border-gray-100 h-full">
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
                    class="bg-gray-50 rounded-3xl p-10 shadow hover:shadow-lg transition-all duration-300 border-2 border-gray-100 h-full">
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

            <div class="flex justify-center mt-20">
                <a href="{{url("/cerita")}}"
                    class="bg-primary text-white px-16 py-5 rounded-2xl text-lg font-semibold hover:bg-blue-800 hover:shadow-xl transform transition-all duration-300 shadow">
                    Lihat Semua Cerita
                </a>
            </div>
        </div>
    </section>

@endsection