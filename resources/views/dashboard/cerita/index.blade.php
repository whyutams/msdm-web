@extends('layouts.dashboard')

@section('title', 'Cerita')

@section('content')
    @if(session('success'))
        <div class="mt-6 mx-auto">
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
                        <h1 class="text-2xl font-semibold text-gray-800">Cerita</h1>
                    </div>
                    <div>
                        <nav class="flex" aria-label="Breadcrumb">
                            <ol class="inline-flex items-center space-x-1 sm:space-x-3 text-sm text-gray-600">
                                <li>
                                    <a href="{{ url('dashboard') }}" class="hover:text-blue-600">Dashboard</a>
                                </li>
                                <li class="before:content-['/'] before:mr-2 text-gray-400">Cerita</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table id="table" class="min-w-full border text-left text-gray-700">
                        <thead class="bg-gray-100 text-gray-700 uppercase text-sm">
                            <tr>
                                <th class="px-4 py-3 border w-[5%]">#</th>
                                <th class="px-4 py-3 border">Username</th>
                                <th class="px-4 py-3 border">Nama Lengkap</th>
                                <th class="px-4 py-3 border">Cerita</th>
                                <th class="px-4 py-3 border">Created By</th>
                                <th class="px-4 py-3 border">Updated By</th>
                                <th class="px-4 py-3 border w-[20%]">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($ceritas as $index => $cerita)
                                <tr @if($cerita->user->suspended) title="User dinonaktifkan" @endif
                                    class="@if($cerita->user->suspended) bg-red-200 hover:bg-red-100 @else hover:bg-gray-50 @endif">
                                    <td class="px-4 py-3 border">{{ $index + 1 }}</td>
                                    <td class="px-4 py-3 border"><code
                                            class="font-bold text-primary">{{ $cerita->user->username }}</code></td>
                                    <td class="px-4 py-3 border">{{ $cerita->user->fullname }} ({{ $cerita->user->callname }})</td>
                                    <td class="px-4 py-3 border truncate">{{ strlen(strip_tags($cerita->cerita)) > 50 ? substr(strip_tags($cerita->cerita), 0, 50).'...' : strip_tags($cerita->cerita)  }}</td>
                                    <td class="px-4 py-3 border">
                                        {{  Carbon\Carbon::parse($cerita->user->created_at)->translatedFormat('d M Y') }}
                                    </td>
                                    <td class="px-4 py-3 border">
                                        {{  Carbon\Carbon::parse($cerita->user->updated_at)->translatedFormat('d M Y') }}
                                    </td>
                                    <td class="px-4 py-3 border">
                                        <div class="flex flex-col lg:flex-row flex-wrap gap-2"> 
                                                <a href="{{ route('dashboard.cerita.show', $cerita->id) }}"
                                                    class="inline-flex items-center px-3 py-1 rounded bg-primary text-white hover:bg-blue-800 text-sm">
                                                    <i class="fas fa-eye mr-1"></i> Detail
                                                </a> 
                                        </div>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="@if(Auth::user()->role == App\Models\User::ROLE_SUPERADMIN) 12 @else 11 @endif"
                                        class="px-4 py-4 text-center text-gray-500">No data found.</td>
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
                        @if (Auth::user()->role == App\Models\User::ROLE_SUPERADMIN)
                            <a href="{{ route('dashboard.users.create') }}"
                                class="inline-flex items-center px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700 text-sm">
                                <i class="fas fa-plus mr-1"></i> Add Admin
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