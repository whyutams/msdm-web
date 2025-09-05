@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
    @if(session('success'))
        <div class="mt-6 mx-auto">
            <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 @if (Auth::user()->role == App\Models\User::ROLE_SUPERADMIN) md:grid-cols-2 lg:grid-cols-4 @else  md:grid-cols-3 @endif gap-6 mb-8">
        @if (Auth::user()->role == App\Models\User::ROLE_SUPERADMIN)
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Total Admins</p>
                        <p class="text-2xl font-bold text-gray-700 mt-1 counter"
                            data-target="{{ $users->where('role', App\Models\User::ROLE_ADMIN)->count() }}">0</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-users text-secondary text-lg"></i>
                    </div>
                </div>
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Users</p>
                    <p class="text-2xl font-bold text-gray-700 mt-1 counter"
                        data-target="{{ $users->where('role', App\Models\User::ROLE_USER)->count() }}">0</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-users text-purple-600 text-lg"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Kontak Sebaya</p>
                    <p class="text-2xl font-bold text-gray-700 mt-1 counter" data-target="{{ $kontak_sebayas->count() }}">0
                    </p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-user-friends text-green-600 text-lg"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Cerita</p>
                    <p class="text-2xl font-bold text-gray-700 mt-1 counter" data-target="{{ $ceritas->count() }}">0</p>
                </div>
                <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-book-open text-orange-600 text-lg"></i>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('.counter').each(function () {
                var $this = $(this),
                    target = $this.data('target');

                $({ countNum: 0 }).animate(
                    { countNum: target },
                    {
                        duration: 1000,
                        easing: 'swing',
                        step: function () {
                            $this.text(Math.floor(this.countNum));
                        },
                        complete: function () {
                            $this.text(this.countNum);
                        }
                    }
                );
            });
        });
    </script>
@endsection