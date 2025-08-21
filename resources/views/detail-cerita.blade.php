@extends('layouts.home')

@section('title', 'Detail Cerita')

@section('content')

    <!-- Cerita Section -->
    <section id="stories" class="py-24 bg-white">
        <div class="max-w-6xl mx-auto px-6 sm:px-8 lg:px-12">
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
            <p class="text-lg">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Porro, officiis, qui tempora
                nostrum facere, laudantium voluptate magni eligendi officia quo odit. Expedita, aliquid maiores. Rem odit
                quibusdam labore commodi similique fugiat temporibus, vitae maiores ipsam laboriosam voluptatibus quas,
                natus nihil reprehenderit et placeat! In ratione eveniet nesciunt vero amet? Eaque?</p>

            <div class="mt-12">
                <a href="/#cerita"
                    class="bg-slate-500 text-white px-8 py-3 rounded-xl text-base font-semibold hover:bg-slate-600 hover:shadow-lg transition-all duration-200 w-full">
                    Kembali
                </a>
            </div>
        </div>
    </section>

@endsection