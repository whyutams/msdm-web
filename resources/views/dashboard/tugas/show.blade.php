@extends('layouts.dashboard')

@section('title', 'Detail Tugas')

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

    <section>
        <div class="bg-white shadow rounded-2xl py-8 px-6 sm:px-8 lg:px-12">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
                <h1 class="text-2xl font-semibold text-gray-800">Detail Tugas</h1>
                <nav aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 sm:space-x-3 text-sm text-gray-600">
                        <li>
                            <a href="{{ url('dashboard') }}" class="hover:text-blue-600">Dashboard</a>
                        </li>
                        <li class="before:content-['/'] before:mx-2 hover:text-blue-600">
                            <a href="{{ route('dashboard.tugas.index') }}" class="hover:text-blue-600">Tugas</a>
                        </li>
                        <li class="before:content-['/'] before:mx-2 text-gray-400">Detail</li>
                    </ol>
                </nav>
            </div>

            <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-6">
                <div class="flex-1">
                    <span
                        class="inline-block font-medium rounded-md bg-blue-50 text-blue-800 ring-1 ring-inset ring-blue-700/20 text-sm py-1 px-3 mb-4">
                        Minggu ke-{{ $tugas->minggu }}
                    </span>
                    <h2 class="font-semibold text-gray-800 text-xl mb-3">{{ $tugas->title }}</h2>
                    <p class="text-gray-700 leading-relaxed text-base text-justify">
                        {{ $tugas->description }}
                    </p>
                    <div class="mt-6">
                        <code
                            class="font-bold text-primary text-xs lg:text-sm">@if($tugas->creator?->fullname && $tugas->updater?->fullname) {{ $tugas->creator?->fullname ? 'Ditambahkan oleh ' . $tugas->creator->fullname : '' }} | {{ $tugas->updater?->fullname ? 'Diperbarui oleh ' . $tugas->updater->fullname : '' }} @endif</code>
                    </div>
                </div>

                <div class="flex-shrink-0 my-auto">
                    @if (Auth::user()->role == App\Models\User::ROLE_ADMIN)
                        <div class="flex lg:flex-col flex-row gap-3">
                            <a href="{{ route('dashboard.tugas.edit', $tugas->id) }}"
                                class="inline-flex items-center px-4 py-2 rounded bg-yellow-400 text-black hover:bg-yellow-500 hover:shadow transition text-sm">
                                <i class="fas fa-edit mr-2"></i> Edit
                            </a>
                            <form action="{{ route('dashboard.tugas.destroy', $tugas->id) }}" method="POST" class="inline"
                                onsubmit="return confirm('Yakin ingin menghapus data?')">
                                @csrf
                                @method('DELETE')
                                <button
                                    class="inline-flex items-center px-4 py-2 rounded bg-red-500 text-white hover:bg-red-600 hover:shadow transition text-sm">
                                    <i class="fas fa-trash mr-1"></i> Delete
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>

            <div class="mt-10 mb-8 border-t border-slate-200"></div>

            <div class="">
                <h1 class="text-2xl font-semibold text-gray-800 mb-4">Materi</h1>

                <div class="overflow-x-auto">
                    <table id="table" class="min-w-full border text-left text-gray-700">
                        <thead class="bg-gray-100 text-gray-700 uppercase text-sm">
                            <tr>
                                <th class="px-4 py-3 border w-[5%]">#</th>
                                <th class="px-4 py-3 border">Materi</th>
                                <th class="px-4 py-3 border">Judul</th>
                                <th class="px-4 py-3 border">Jenis Materi</th> 
                                <th class="px-4 py-3 border">Created At</th>
                                <th class="px-4 py-3 border">Created By</th>
                                <th class="px-4 py-3 border w-[20%]">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($subtugas as $index => $sub)
                            <tr>
                                <td class="px-4 py-3 border">{{ $index + 1 }}</td> 
                                    <td class="px-4 py-3 border">
                                        <small
                                            class="font-medium rounded-md bg-blue-50 text-blue-800 ring-1 ring-inset ring-blue-700/20 text-xs py-1 px-3 block whitespace-normal break-words text-center">
                                            Materi {{ $sub->urutan }}
                                        </small>
                                    </td>
                                    <td class="px-4 py-3 border">{{ $sub->name }}</td>
                                    <td class="px-4 py-3 border">{{ ucfirst($sub->jenis == 'file' ? $sub->jenis .' '.$sub->file_type : $sub->jenis) }}</td> 
                                    <td class="px-4 py-3 border">
                                        {{  Carbon\Carbon::parse($sub->created_at)->translatedFormat('d M Y') }}
                                    </td>
                                    <td class="px-4 py-3 border">{{ $sub->creator?->fullname ?? '-' }}</td>
                                    <td class="px-4 py-3 border lg:space-x-1">

                                        <div class="flex flex-col lg:flex-row flex-wrap gap-2">
                                            <a href="{{ route('dashboard.tugas.materi.show', ['tugas'=>$tugas->id,'subTugas'=> $sub->id]) }}"
                                                class="inline-flex items-center px-3 py-1 rounded bg-primary text-white hover:bg-blue-800 text-sm">
                                                <i class="fas fa-eye mr-1"></i> Detail
                                            </a>

                                            @if (Auth::user()->role == App\Models\User::ROLE_ADMIN) 
                                                <form action="{{ route('dashboard.tugas.materi.destroy', ['tugas'=>$tugas->id,'subTugas'=> $sub->id]) }}" method="POST"
                                                    onsubmit="return confirm('Yakin ingin hapus materi {{ $sub->urutan }} ?')" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="inline-flex items-center px-3 py-1 rounded bg-red-500 text-white hover:bg-red-600 text-sm"
                                                        title="Hapus materi {{ $sub->urutan }}">
                                                        <i class="fas fa-trash mr-1"></i> Delete
                                                    </button>
                                                </form> 

                                            @endif
                                        </div>
                                    </td>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="px-4 py-4 text-center text-gray-500">No data found.</td>
                                </tr>
                            @endif  
                        </tbody>
                    </table>
                </div>
                <div class="flex flex-col md:flex-row items-center justify-between gap-4 mt-4 text-sm"
                    id="datatable-footer-custom">
                    <div id="custom-paginate" class="flex items-center"></div>
                    <div class="flex items-center gap-2" id="custom-buttons">
                        <div id="btn_excel_wrapper"></div>
                        @if (Auth::user()->role == App\Models\User::ROLE_ADMIN)
                            <a href="{{ route('dashboard.tugas.materi.create', $tugas->id) }}"
                                class="inline-flex items-center px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700 text-sm">
                                <i class="fas fa-plus mr-1"></i> Add Materi
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="flex justify-start mt-4">
                <a href="{{ route('dashboard.tugas.index') }}"
                    class="bg-slate-500 text-white px-4 py-2 rounded hover:bg-slate-600 hover:shadow transition w-40 text-center">
                    Kembali
                </a>
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
                buttons: [
                    {
                        extend: 'excel',
                        text: '<i class="fas fa-download mr-1"></i> Export to Excel',
                        className: '',
                        init: function (api, node, config) {
                            $(node)
                                .removeClass('dt-button')
                                .addClass('inline-flex items-center px-4 py-2 rounded bg-green-600 text-white hover:bg-green-700 text-sm shadow-sm transition')
                                .attr('title', 'Export data ke Excel');
                        }, exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    }
                ],
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

            table.buttons().container().appendTo('#btn_excel_wrapper');

            const wrapper = $('#table').parents('.dataTables_wrapper');
            wrapper.find('.dataTables_length').appendTo('#custom-length');
            wrapper.find('.dataTables_info').appendTo('#custom-info');
            wrapper.find('.dataTables_paginate').appendTo('#custom-paginate');
        });
    </script>
@endsection