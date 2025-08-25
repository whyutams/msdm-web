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
                        <h1 class="text-2xl md:text-3xl font-bold text-primary">{{ config('app.name') }}</h1>
                    </div>
                </a>
            </div>

            <nav class="hidden md:flex space-x-4">
                <a href="/#"
                    class="text-gray-700 hover:text-primary text-lg px-4 py-2 rounded-lg hover:bg-blue-50 transition-all duration-200">Beranda</a>
                <a href="{{ route('cerita') }}"
                    class="text-gray-700 hover:text-primary text-lg px-4 py-2 rounded-lg hover:bg-blue-50 transition-all duration-200">Cerita</a>
                <a href="{{ route('kelas-sebaya') }}"
                    class="text-gray-700 hover:text-primary text-lg px-4 py-2 rounded-lg hover:bg-blue-50 transition-all duration-200">Kelas
                    Sebaya</a>
                @auth
                    <!-- Profile Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <!-- Trigger -->
                        <button @click="open = !open" class="flex items-center space-x-3 focus:outline-none">
                            <div
                                class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center overflow-hidden">
                                @if(Auth::user()->photo_profile)
                                    <img src="{{ asset(path: 'storage/' . Auth::user()->photo_profile) }}" alt="Profile"
                                        class="w-full h-full object-cover">
                                @else
                                    <span
                                        class="text-white font-bold text-lg bg-primary w-full h-full flex items-center justify-center rounded-full">
                                        {{ strtoupper(substr(Auth::user()->callname, 0, 1)) }}
                                    </span>
                                @endif
                            </div>
                            <span class="text-gray-700 font-semibold">{{ Auth::user()->callname }}</span>
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open" @click.away="open = false"
                            class="absolute right-0 mt-2 w-48 bg-white border rounded-lg shadow-lg py-2 z-50">
                            <a href="{{ url('/profile') }}"
                                class="block px-4 py-2 text-gray-700 hover:bg-blue-50 transition">Profil</a>
                            <a href="{{ url('/mytask') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 transition">Tugas</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left block px-4 py-2 text-gray-700 hover:bg-blue-50 transition rounded-b-md">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ url('/login') }}"
                        class="bg-primary px-6 text-lg hover:bg-blue-800 py-2 rounded-lg transition-all duration-200 text-white">
                        Masuk
                    </a>
                @endauth

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
                <a href="/#"
                    class="text-gray-700 hover:text-primary text-lg px-4 py-3 rounded-lg hover:bg-blue-50 transition-all duration-200">Beranda</a>
                <a href="{{ route('cerita') }}"
                    class="text-gray-700 hover:text-primary text-lg px-4 py-3 rounded-lg hover:bg-blue-50 transition-all duration-200">Cerita</a>
                <a href="{{ route('kelas-sebaya') }}"
                    class="text-gray-700 hover:text-primary text-lg px-4 py-3 rounded-lg hover:bg-blue-50 transition-all duration-200">Kelas
                    Sebaya</a>
                @auth
                    <!-- Profile Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <!-- Trigger -->
                        <button @click="open = !open" class="flex items-center space-x-3 focus:outline-none">
                            <div
                                class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center overflow-hidden">
                                @if(Auth::user()->photo_profile)
                                    <img src="{{ asset(path: 'storage/' . Auth::user()->photo_profile) }}" alt="Profile"
                                        class="w-full h-full object-cover">
                                @else
                                    <span
                                        class="text-white font-bold text-lg bg-primary w-full h-full flex items-center justify-center rounded-full">
                                        {{ strtoupper(substr(Auth::user()->callname, 0, 1)) }}
                                    </span>
                                @endif
                            </div>
                            <span class="text-gray-700 font-semibold">{{ Auth::user()->callname }}</span>
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open" @click.away="open = false"
                            class="absolute left-0 mt-2 w-48 bg-white border rounded-lg shadow-lg py-2 z-50">
                            <a href="{{ url('/profile') }}"
                                class="block px-4 py-2 text-gray-700 hover:bg-blue-50 transition">Profil</a>
                            <a href="{{ url('/mytask') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 transition">Tugas</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left block px-4 py-2 text-gray-700 hover:bg-blue-50 transition rounded-b-md">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ url('/login') }}"
                        class="bg-primary px-6 text-lg hover:bg-blue-800 py-2 rounded-lg transition-all duration-200 text-white">Masuk</a>
                @endauth
            </div>
        </div>
    </div>
</header>