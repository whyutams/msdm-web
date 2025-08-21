<header class="bg-white shadow sticky top-0 z-50 border-b-2 border-gray-100">
    <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
        <div class="flex justify-between items-center h-20">
            <div class="flex items-center">
                <a href="/#">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                            </svg>
                        </div>
                        <h1 class="text-2xl md:text-3xl font-bold text-primary">MSDM</h1>
                    </div>
                </a>
            </div>

            <nav class="hidden md:flex space-x-4">
                <a href="/#home"
                    class="text-gray-700 hover:text-primary text-lg px-4 py-2 rounded-lg hover:bg-blue-50 transition-all duration-200">Beranda</a>
                <a href="/#stories"
                    class="text-gray-700 hover:text-primary text-lg px-4 py-2 rounded-lg hover:bg-blue-50 transition-all duration-200">Cerita</a> 
                <a href="/#contact"
                    class="text-gray-700 hover:text-primary text-lg px-4 py-2 rounded-lg hover:bg-blue-50 transition-all duration-200">Kontak</a>
                <a href="{{ url('/login') }}"
                    class="bg-primary px-6 text-lg hover:bg-blue-800 py-2 rounded-lg transition-all duration-200 text-white">Masuk</a>
            </nav>

            <button class="md:hidden p-2" onclick="toggleMobileMenu()">
                <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden md:hidden pb-6">
            <div class="flex flex-col space-y-4">
                <a href="/#home"
                    class="text-gray-700 hover:text-primary text-lg px-4 py-3 rounded-lg hover:bg-blue-50 transition-all duration-200">Beranda</a>
                <a href="/#stories"
                    class="text-gray-700 hover:text-primary text-lg px-4 py-3 rounded-lg hover:bg-blue-50 transition-all duration-200">Cerita</a> 
                <a href="/#contact"
                    class="text-gray-700 hover:text-primary text-lg px-4 py-3 rounded-lg hover:bg-blue-50 transition-all duration-200">Kontak</a>
                <a href="{{ url('/login') }}"
                    class="bg-primary px-6 text-lg hover:bg-blue-800 py-2 rounded-lg transition-all duration-200 text-white">Masuk</a>
            </div>
        </div>
    </div>
</header>