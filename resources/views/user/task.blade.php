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

            <h1 class="text-2xl lg:text-3xl font-semibold text-gray-800">Tugas Anda</h1>
            @if ($tasks->count() > 0)
                <div class="grid grid-cols-1 gap-6 mt-8">
                    @php
                        $first_unfinished_task = $tasks->filter(function ($t) use ($user_completed) {
                            $sub_ids = $t->sub_tugas->pluck('id')->toArray();
                            $unfinished = array_diff($sub_ids, $user_completed);
                            return count($unfinished) > 0;
                        })->sortBy('minggu')->first();

                        $first_unfinished_minggu = $first_unfinished_task->minggu ?? null;
                    @endphp

                    @foreach ($tasks->reverse() as $task)
                        @php
                            $total_sub = $task->sub_tugas->count();
                            $completed = $task->sub_tugas->whereIn('id', $user_completed)->count();
                            $progress = $total_sub ? intval(($completed / $total_sub) * 100) : 0;

                            $has_unfinished = $total_sub - $completed > 0;
                            $can_do = ($first_unfinished_minggu === null || $task->minggu <= $first_unfinished_minggu);
                        @endphp

                        <div
                            class="bg-white rounded-2xl shadow border border-gray-200 p-6 hover:shadow-lg transition-all duration-300">
                            {{-- Header --}}
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-primary font-bold text-2xl mb-1">Minggu ke-{{ $task->minggu }}</h3>
                                    <h4 class="text-gray-800 font-semibold text-lg">{{ $task->title }}</h4>
                                </div>

                                @if($total_sub > 0)
                                    <div class="relative w-16 h-16 flex-shrink-0">
                                        <svg class="w-16 h-16 transform -rotate-90">
                                            <circle cx="32" cy="32" r="28" stroke="#e5e7eb" stroke-width="6" fill="transparent" />
                                            <circle cx="32" cy="32" r="28" stroke="#4a67f7" stroke-width="6" fill="transparent"
                                                stroke-dasharray="176" stroke-dashoffset="{{ 176 - (176 * $progress / 100) }}"
                                                stroke-linecap="round" />
                                        </svg>
                                        <span
                                            class="absolute inset-0 flex items-center justify-center text-sm font-semibold text-gray-700">
                                            {{ $progress }}%
                                        </span>
                                    </div>
                                @endif
                            </div>

                            <p class="text-gray-700 mb-6 text-justify leading-relaxed">
                                {{ $task->description }}
                            </p>

                            @if($total_sub > 0)
                                @if($can_do)
                                    <div class="mt-4">
                                        <button
                                            class="toggleBtn w-full flex justify-between items-center px-4 py-2 border border-gray-300 rounded-lg font-medium text-primary hover:border-primary hover:text-blue-700 transition">
                                            <span>Lihat Materi</span>
                                            <svg class="arrowIcon w-5 h-5 transform transition-transform duration-300" fill="none"
                                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </button>

                                        <div class="materiList mt-3 hidden border border-gray-200 rounded-lg overflow-hidden">
                                            <table class="w-full table-auto text-left border-collapse">
                                                <tbody>
                                                    @foreach ($task->sub_tugas as $index => $sub)
                                                        <tr
                                                            class="border-b @if(in_array($sub->id, $user_completed)) bg-green-300 border-green-400 hover:bg-green-200 @else border-gray-200 hover:bg-gray-50 @endif">
                                                            <td class="px-4 py-2 text-slate-500" width="5%">{{ $index + 1 }}</td>
                                                            <td class="px-4 py-2 text-gray-800">{{ $sub->name }}</td>
                                                            <td class="px-4 py-2 w-12 text-center">
                                                                @if(in_array($sub->id, $user_completed))
                                                                    ✔️
                                                                @else
                                                                    ❌
                                                                @endif
                                                            </td>
                                                            <td class="px-4 py-2 w-32 text-center">
                                                                <a href="{{ route('task.show', $sub->id) }}"
                                                                    class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 text-sm">
                                                                    @if(!in_array($sub->id, $user_completed))
                                                                        Selesaikan
                                                                    @else
                                                                        Lihat
                                                                    @endif
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @elseif($first_unfinished_minggu !== null)
                                    <div class="mt-4 p-4 bg-yellow-100 border border-yellow-400 text-yellow-700 rounded-lg text-center">
                                        Selesaikan tugas minggu ke-{{ $first_unfinished_minggu }} terlebih dahulu
                                    </div>
                                @endif
                            @endif
                        </div>
                    @endforeach


                    <script>
                        $(document).ready(function () {
                            $(document).on("click", ".toggleBtn", function () {
                                const $card = $(this).closest(".bg-white");
                                const $thisList = $card.find(".materiList");

                                $(".materiList").not($thisList).slideUp(300);
                                $(".toggleBtn .arrowIcon").not($(this).find(".arrowIcon")).removeClass("rotate-180");

                                $thisList.slideToggle(300);
                                $(this).find(".arrowIcon").toggleClass("rotate-180");
                            });
                        });
                    </script>
                </div>
            @else
                <div class="flex justify-center mt-12">
                    <p class="text-gray-600 text-lg text-center">Tugas belum ditambahkan.</p>
                </div>
            @endif

            <div class="mt-16 flex justify-between space-x-4">
                <a href="{{ url()->previous() }}"
                    class="bg-slate-500 text-white px-8 py-3 rounded-xl text-base font-semibold hover:bg-slate-600 hover:shadow-lg transition-all duration-200 w-60 text-center">
                    Kembali
                </a>
            </div>
        </div>
    </section>
@endsection