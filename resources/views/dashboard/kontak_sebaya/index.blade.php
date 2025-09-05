@extends('layouts.dashboard')

@section('title', 'Kontak Sebaya')

@section('content')
    @if(session('success'))
        <div class="mt-6 mx-auto" >
            <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        </div>
    @endif

    <section class="">
        <div class="bg-white shadow rounded-lg">
            <div class="p-5">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4">
                    <div>
                        <h1 class="text-2xl font-semibold text-gray-800">Kontak Sebaya</h1>
                    </div>
                    <div>
                        <nav class="flex" aria-label="Breadcrumb">
                            <ol class="inline-flex items-center space-x-1 sm:space-x-3 text-sm text-gray-600">
                                <li>
                                    <a href="{{ url('dashboard') }}" class="hover:text-blue-600">Dashboard</a>
                                </li>
                                <li class="before:content-['/'] before:mr-2 text-gray-400">Kontak Sebaya</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table id="table" class="min-w-full border text-left text-gray-700">
                        <thead class="bg-gray-100 text-gray-700 uppercase text-sm">
                            <tr>
                                <th class="px-4 py-3 border w-[5%]">#</th>
                                <th class="px-4 py-3 border">Name</th>
                                <th class="px-4 py-3 border">Description</th>
                                <th class="px-4 py-3 border">Number</th>
                                <th class="px-4 py-3 border">Updated At</th>
                                <th class="px-4 py-3 border">Updated By</th>
                                <th class="px-4 py-3 border">Created At</th>
                                <th class="px-4 py-3 border">Created By</th>
                                <th class="px-4 py-3 border @if(Auth::user()->role == \App\Models\User::ROLE_ADMIN) w-[20%] @endif">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kontak_sebayas as $index => $kontak_sebaya)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 border">{{ $index + 1 }}</td>
                                    <td class="px-4 py-3 border">{{ $kontak_sebaya->name }}</td>
                                    <td class="px-4 py-3 border">{{ $kontak_sebaya->description }}</td>
                                    <td class="px-4 py-3 border">{{ $kontak_sebaya->number }}</td>
                                    <td class="px-4 py-3 border">
                                        {{  Carbon\Carbon::parse($kontak_sebaya->updated_at)->translatedFormat('d M Y') }}
                                    </td>
                                    <td class="px-4 py-3 border">{{ $kontak_sebaya->updater->fullname }}</td>
                                    <td class="px-4 py-3 border">
                                        {{  Carbon\Carbon::parse($kontak_sebaya->created_at)->translatedFormat('d M Y') }}
                                    </td>
                                    <td class="px-4 py-3 border">{{ $kontak_sebaya->creator->fullname }}</td>
                                    <td class="px-4 py-3 border lg:space-x-1">
                                        @if (Auth::user()->role == App\Models\User::ROLE_ADMIN)
                                            <a href="{{ route('dashboard.kontak_sebaya.edit', $kontak_sebaya->id) }}"
                                                class="inline-flex items-center px-3 py-1 rounded bg-yellow-400 text-black hover:bg-yellow-500 text-sm">
                                                <i class="fas fa-edit mr-1"></i> Edit
                                            </a>
                                            <div class="lg:hidden my-1"></div>
                                            <form action="{{ route('dashboard.kontak_sebaya.destroy', $kontak_sebaya->id) }}"
                                                method="POST" class="inline"
                                                onsubmit="return confirm('Yakin ingin menghapus data?')">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    class="inline-flex items-center px-3 py-1 rounded bg-red-500 text-white hover:bg-red-600 text-sm">
                                                    <i class="fas fa-trash mr-1"></i> Delete
                                                </button>
                                            </form>
                                        @endif
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
                    <div id="custom-info" class="text-gray-600"></div>
                    <div id="custom-paginate"></div>
                    <div class="flex items-center gap-2" id="custom-buttons">
                        <div id="btn_excel_wrapper"></div>
                        @if (Auth::user()->role == App\Models\User::ROLE_ADMIN)
                            <a href="{{ route('dashboard.kontak_sebaya.create') }}"
                                class="inline-flex items-center px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700 text-sm">
                                <i class="fas fa-plus mr-1"></i> Add Kontak Sebaya
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
                lengthChange: false,
                autoWidth: false,
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                buttons: [
                    {
                        extend: 'excel',
                        text: '<i class="fas fa-download"></i>&nbsp; Export to Excel',
                        className: 'bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 5]
                        }
                    }
                ]
            });

            table.buttons().container().appendTo('#btn_excel_wrapper');
            const wrapper = $('#table').parents('.dataTables_wrapper');
            wrapper.find('.dataTables_info').appendTo('#custom-info');
            wrapper.find('.dataTables_paginate').appendTo('#custom-paginate');
        });
    </script>
@endsection