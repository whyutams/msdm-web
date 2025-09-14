@extends('layouts.dashboard')

@section('title', 'Tugas')

@section('content')
    @if(session('success'))
        <div class="mt-6 mx-auto">
            <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="">
        <div class="bg-white shadow rounded-lg">
            <div class="p-5">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4">
                    <div>
                        <h1 class="text-2xl font-semibold text-gray-800">Tugas</h1>
                    </div>
                    <div>
                        <nav class="flex" aria-label="Breadcrumb">
                            <ol class="inline-flex items-center space-x-1 sm:space-x-3 text-sm text-gray-600">
                                <li>
                                    <a href="{{ url('dashboard') }}" class="hover:text-blue-600">Dashboard</a>
                                </li>
                                <li class="before:content-['/'] before:mr-2 text-gray-400">Tugas</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table id="table" class="min-w-full border text-left text-gray-700">
                        <thead class="bg-gray-100 text-gray-700 uppercase text-sm">
                            <tr>
                                <th class="px-4 py-3 border w-[5%]">#</th>
                                <th class="px-4 py-3 border w-[10%]">Minggu</th>
                                <th class="px-4 py-3 border">Title</th>
                                <th class="px-4 py-3 border">Description</th>
                                <th class="px-4 py-3 border">Updated At</th>
                                <th class="px-4 py-3 border">Updated By</th>
                                <th class="px-4 py-3 border">Created At</th>
                                <th class="px-4 py-3 border">Created By</th>
                                <th class="px-4 py-3 border w-[15%]">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tugass as $index => $tugas)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 border">{{ $index + 1 }}</td>
                                    <td class="px-4 py-3 border">
                                        <small
                                            class="font-medium rounded-md bg-blue-50 text-blue-800 ring-1 ring-inset ring-blue-700/20 text-xs py-1 px-3 block whitespace-normal break-words text-center">
                                            Minggu ke-{{ $tugas->minggu }}
                                        </small>
                                    </td>
                                    <td class="px-4 py-3 border">{{ $tugas->title }}</td>
                                    <td class="px-4 py-3 border">{{ $tugas->description }}</td>
                                    <td class="px-4 py-3 border">
                                        {{  Carbon\Carbon::parse($tugas->updated_at)->translatedFormat('d M Y') }}
                                    </td>
                                    <td class="px-4 py-3 border">{{ $tugas->updater?->fullname ?? '-' }}</td>
                                    <td class="px-4 py-3 border">
                                        {{  Carbon\Carbon::parse($tugas->created_at)->translatedFormat('d M Y') }}
                                    </td>
                                    <td class="px-4 py-3 border">{{ $tugas->creator?->fullname ?? '-' }}</td>
                                    <td class="px-4 py-3 border lg:space-x-1">
                                        <a href="{{ route('dashboard.tugas.show', $tugas->id) }}"
                                            class="inline-flex items-center px-3 py-1 rounded bg-primary text-white hover:bg-blue-800 text-sm">
                                            <i class="fas fa-eye mr-1"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="px-4 py-4 text-center text-gray-500">No data found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="flex flex-col md:flex-row items-center justify-between gap-4 mt-4 text-sm"
                    id="datatable-footer-custom">
                    <div id="custom-paginate" class="flex items-center"></div>
                    <div class="flex items-center gap-2" id="custom-buttons">
                        <div id="btn_excel_wrapper"></div>
                        @if (Auth::user()->role == App\Models\User::ROLE_ADMIN)
                            <a href="{{ route('dashboard.tugas.create') }}"
                                class="inline-flex items-center px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700 text-sm">
                                <i class="fas fa-plus mr-1"></i> Add Tugas
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(function () {
            const table = $("#table").DataTable({
                responsive: false,
                lengthChange: true,
                autoWidth: false,
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                buttons: [],
                language: {
                    lengthMenu: "Tampilkan _MENU_ data per halaman",
                    zeroRecords: "<div class='flex justify-center py-2'><span class='text-center mx-auto'>Data tidak ditemukan</span></div>",
                    info: "Menampilkan _START_-_END_ dari total _TOTAL_",
                    infoEmpty: "Tidak ada data tersedia",
                    infoFiltered: "(difilter dari total _MAX_ data)",
                    search: "Cari:",
                    paginate: {
                        first: "<<",
                        last: ">>",
                        next: "›",
                        previous: "‹"
                    }
                }
            });


            const wrapper = $('#table').parents('.dataTables_wrapper');
            wrapper.find('.dataTables_length').appendTo('#custom-length');
            wrapper.find('.dataTables_info').appendTo('#custom-info');
            wrapper.find('.dataTables_paginate').appendTo('#custom-paginate');
        });
    </script>
@endsection