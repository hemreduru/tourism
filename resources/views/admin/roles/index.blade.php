@extends('layouts.app')

@section('title', __('roles.roles_list'))

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">{{ __('roles.manage_roles') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('admin.dashboard.title') }}</a></li>
                <li class="breadcrumb-item active">{{ __('roles.roles') }}</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-outline card-primary">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title">{{ __('roles.roles_list') }}</h3>
                        <div class="card-tools">
                            @if(auth()->user()->hasPermission('roles.create'))
                            <a href="{{ route('admin.roles.create') }}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-plus mr-1"></i> {{ __('roles.create_role') }}
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table id="roles-table" class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>{{ __('roles.id') }}</th>
                                <th>{{ __('roles.name') }}</th>
                                <th>{{ __('roles.display_name') }}</th>
                                <th>{{ __('roles.color') }}</th>
                                <th>{{ __('roles.description') }}</th>
                                <th>{{ __('roles.created_at') }}</th>
                                <th>{{ __('roles.updated_at') }}</th>
                                <th>{{ __('roles.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be loaded via DataTables -->
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
@stop
@section('js')
    <script>
        $(function() {
            var table = $('#roles-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.roles.data') }}",
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'role_badge', name: 'role_badge' },
                    { data: 'color', name: 'color' },
                    { data: 'description', name: 'description' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'updated_at', name: 'updated_at' },
                    { data: 'actions', name: 'actions', orderable: false, searchable: false }
                ],
                @if (app()->getLocale() == 'tr')
                language: {
                    url: '{{ asset('js/dt/dt_tr.json') }}',
                },
                @endif
            });

            $('#roles-table').on('click', '.delete-role', function(e) {
                e.preventDefault();
                const roleId = $(this).data('id');
                const deleteUrl = $(this).attr('href');

                Swal.fire({
                    title: '{{ __("roles.delete_confirm") }}',
                    text: '{{ __("roles.delete_confirm_message") }}',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: '{{ __("roles.confirm") }}',
                    cancelButtonText: '{{ __("roles.cancel") }}'
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
                                }
                            },
                            error: function(xhr) {
                            }
                        });
                    }
                });
            });
        });
    </script>
@stop

