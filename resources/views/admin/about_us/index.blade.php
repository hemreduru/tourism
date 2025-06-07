@extends('layouts.app')

@section('title', __('about_us.management'))

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">{{ __('about_us.management') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('admin.dashboard.title') }}</a></li>
                <li class="breadcrumb-item active">{{ __('about_us.about_us') }}</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header border-0">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">{{ __('about_us.about_us_list') }}</h3>
                @if(auth()->user()->hasPermission('about_us.create'))
                <a href="{{ route('admin.about_us.create') }}" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-plus mr-1"></i> {{ __('about_us.add_new') }}
                </a>
                @endif
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover text-nowrap" id="about-us-table">
                <thead>
                    <tr>
                        <th style="display:none">{{ __('about_us.id') }}</th>
                        <th>{{ __('about_us.title_en') }}</th>
                        <th>{{ __('about_us.title_tr') }}</th>
                        <th>{{ __('about_us.title_nl') }}</th>
                        <th>{{ __('about_us.is_active') }}</th>
                        <th>{{ __('about_us.created_at') }}</th>
                        <th>{{ __('about_us.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- DataTables will fill this -->
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
    <script>
        $(function() {
            // DataTable configuration object
            let dataTableConfig = {
                processing: true,
                serverSide: true,
                responsive: true,
                order: [[5, 'desc']],
                ajax: {
                    url: "{{ route('admin.about_us.data') }}",
                },
                @if (app()->getLocale() == 'tr')
                    language: {
                        url: '{{ asset('js/dt/dt_tr.json') }}',
                    },
                @endif
                columns: [
                    { data: 'id', name: 'id', responsivePriority: 1, visible: false },
                    { data: 'title_en', name: 'title_en', responsivePriority: 1 },
                    { data: 'title_tr', name: 'title_tr', responsivePriority: 2 },
                    { data: 'title_nl', name: 'title_nl', responsivePriority: 3 },
                    { data: 'is_active', name: 'is_active', responsivePriority: 4 },
                    { data: 'created_at', name: 'created_at', responsivePriority: 5 },
                    { data: 'action', name: 'action', orderable: false, searchable: false, responsivePriority: 1 }
                ]
            };

            // Initialize DataTable
            let table = $('#about-us-table').DataTable(dataTableConfig);

            // Handle delete about us with SweetAlert2 confirmation
            $(document).on('click', '.delete-about-us', function() {
                const aboutUsId = $(this).data('id');

                Swal.fire({
                    title: "{{ __('about_us.delete_confirm_title') }}",
                    text: "{{ __('about_us.delete_confirm_text') }}",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "{{ __('about_us.delete_confirm_yes') }}",
                    cancelButtonText: "{{ __('about_us.delete_confirm_no') }}"
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "{{ url('admin/about-us') }}/" + aboutUsId,
                            method: 'DELETE',
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                if (response.success) {
                                    table.ajax.reload();
                                    Toast.fire({
                                        icon: 'success',
                                        title: response.message
                                    });
                                } else {
                                    Toast.fire({
                                        icon: 'error',
                                        title: response.message
                                    });
                                }
                            },
                            error: function(xhr) {
                                Toast.fire({
                                    icon: 'error',
                                    title: '{{ __('common.error_deleting') }}'
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
@stop
