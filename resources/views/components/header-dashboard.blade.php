<header class="bg-white shadow-sm border-b border-gray-200 px-6 py-4">
    <div class="flex items-center justify-between">
        <div class="flex items-center">
            <button id="menuToggle" class="lg:hidden text-primary hover:text-blue-800 mr-4">
                <i class="fas fa-bars text-xl"></i>
            </button>
            <h2 class="text-xl font-semibold text-primary">@yield('title')</h2>
        </div>

        <div class="relative" x-data="{ open: false }">
            <!-- Trigger -->
            <button @click="open = !open" class="flex items-center space-x-3 focus:outline-none">
                <div class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center overflow-hidden">
                    @if(Auth::user()->photo_profile)
                        <img src="{{ asset('storage/' . Auth::user()->photo_profile) }}" alt="Profile"
                            class="w-full h-full object-cover">
                    @else
                        <span
                            class="text-white font-bold text-lg bg-primary w-full h-full flex items-center justify-center rounded-full">
                            {{ strtoupper(substr(Auth::user()->callname ?? Auth::user()->username, 0, 1)) }}
                        </span>
                    @endif
                </div>
                <div class="text-left">
                    <span class="block text-gray-700 font-semibold">{{ Auth::user()->username }}</span>
                    <span class="block text-xs text-gray-500 first-letter:uppercase">{{ Auth::user()->role }}</span>
                </div>
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <!-- Dropdown Menu -->
            <div x-show="open" @click.away="open = false"
                class="absolute right-0 mt-2 w-48 bg-white border rounded-lg shadow-lg py-2 z-50">
                @auth
                    @if (Auth::user()->role == App\Models\User::ROLE_ADMIN)
                        <a href="{{ url('/profile/update') }}"
                            class="block px-4 py-2 text-gray-700 hover:bg-blue-50 transition">Profil</a>
                    @endif
                @endauth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full text-left block px-4 py-2 text-gray-700 hover:bg-blue-50 transition rounded-b-md">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>