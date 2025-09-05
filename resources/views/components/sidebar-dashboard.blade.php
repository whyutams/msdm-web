<div id="sidebar"
    class="fixed left-0 top-0 h-full w-64 bg-primary transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out z-30">
    <div class="p-5">
        <h1 class="text-white text-xl font-bold">AdminPanel</h1>
    </div>

    <nav class="mt-8">
        <a href="{{ url('/dashboard') }}"
            class="nav-link active flex items-center px-6 py-3 text-white hover:bg-blue-600 transition-colors duration-200">
            <i class="fas fa-tachometer-alt mr-3"></i>
            Dashboard
        </a>
        <a href="{{ url('/dashboard/users') }}"
            class="nav-link flex items-center px-6 py-3 text-white hover:bg-blue-600 transition-colors duration-200">
            <i class="fas fa-users mr-3"></i>
            Users
        </a>
        <a href="{{ url('/dashboard/kontak_sebaya') }}"
            class="nav-link flex items-center px-6 py-3 text-white hover:bg-blue-600 transition-colors duration-200">
            <i class="fas fa-user-friends mr-3"></i>
            Kontak Sebaya
        </a>
        <a href="{{ url('/dashboard/cerita') }}"
            class="nav-link flex items-center px-6 py-3 text-white hover:bg-blue-600 transition-colors duration-200">
            <i class="fas fa-book-open mr-3"></i>
            Cerita
        </a>
    </nav>
</div>