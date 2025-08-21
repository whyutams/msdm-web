@extends('layouts.home')

@section('title', 'Cerita')

@section('content') 

    <!-- Cerita Section -->
    <section id="stories" class="py-24 bg-white">
        <div class="max-w-[100rem] mx-auto px-6 sm:px-8 lg:px-12">
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
        </div>
    </section>

@endsection