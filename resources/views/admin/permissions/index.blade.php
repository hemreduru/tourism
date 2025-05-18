@extends('layouts.app')

@section('title', __('permissions.permissions_list'))

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">{{ __('permissions.manage_permissions') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('admin.dashboard.title') }}</a>
                </li>
                <li class="breadcrumb-item active">{{ __('permissions.permissions') }}</li>
            </ol>
        </div>
    </div>
@stop

@section('content')

    <div class="card card-outline card-primary">
        <div class="card-header border-0">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title">{{ __('permissions.permissions_list') }}</h3>
                <div class="card-tools">
                    @if (auth()->user()->hasPermission('permissions.create'))
                        <a href="{{ route('admin.permissions.assign-role-form') }}"
                            class="btn btn-outline-warning btn-sm mr-2">
                            <i class="fas fa-tasks mr-1"></i> {{ __('permissions.assign_permission') }}
                        </a>
                    @endif

                    @if (auth()->user()->hasPermission('permissions.create'))
                        <a href="{{ route('admin.permissions.create') }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-plus mr-1"></i> {{ __('permissions.create_permission') }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table id="permissions-table" class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th style="display:none">{{ __('permissions.id') }}</th>
                        <th>{{ __('permissions.name') }}</th>
                        <th>{{ __('permissions.display_name') }}</th>
                        <th>{{ __('permissions.color') }}</th>
                        <th>{{ __('permissions.description') }}</th>
                        <th>{{ __('permissions.created_at') }}</th>
                        <th>{{ __('permissions.updated_at') }}</th>
                        <th>{{ __('permissions.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data will be loaded via DataTables -->
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
@stop
@section('js')
    <script>
        $(function() {
            var table = $('#permissions-table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('admin.permissions.data') }}",
                order: [[6, 'desc']],
                columns: [{
                        data: 'id',
                        name: 'id',
                        responsivePriority: 1,
                        visible: false
                    },
                    {
                        data: 'name',
                        name: 'name',
                        responsivePriority: 1
                    },
                    {
                        data: 'permission_badge',
                        name: 'permission_badge',
                        responsivePriority: 2
                    },
                    {
                        data: 'color',
                        name: 'color',
                        responsivePriority: 3
                    },
                    {
                        data: 'description',
                        name: 'description',
                        responsivePriority: 2
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        responsivePriority: 3
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at',
                        responsivePriority: 3
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false,
                        responsivePriority: 1
                    }
                ],
                @if (app()->getLocale() == 'tr')
                    language: {
                        url: '{{ asset('js/dt/dt_tr.json') }}',
                    },
                @endif
            });

            $('#permissions-table').on('click', '.delete-permission', function(e) {
                e.preventDefault();
                const permissionId = $(this).data('id');
                const deleteUrl = $(this).attr('href');

                Swal.fire({
                    title: '{{ __('permissions.delete_confirm') }}',
                    text: '{{ __('permissions.delete_confirm_message') }}',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: '{{ __('permissions.confirm') }}',
                    cancelButtonText: '{{ __('permissions.cancel') }}'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: deleteUrl,
                            type: 'DELETE',
                            data: {
                                '_token': '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.success) {
                                    table.ajax.reload();
                                } else {
                                    toastr.error(response.message);
                                }
                            },
                            error: function(xhr) {
                                toastr.error('{{ __('toast.unexpected_error') }}');
                            }
                        });
                    }
                });
            });
        });
    </script>
@stop
