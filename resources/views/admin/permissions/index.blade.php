@extends('layouts.app')

@section('title', __('permissions.permissions_list'))

@section('content_header')
    <h1>{{ __('permissions.manage_permissions') }}</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('permissions.permissions_list') }}</h3>
                    <div class="card-tools">
                        @if(auth()->user()->hasPermission('permissions.create'))
                        <a href="{{ route('admin.permissions.assign-role-form') }}" class="btn btn-warning btn-sm mr-2">
                            <i class="fas fa-tasks"></i> {{ __('permissions.assign_permission') }}
                        </a>
                        @endif

                        @if(auth()->user()->hasPermission('permissions.create'))
                        <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> {{ __('permissions.create_permission') }}
                        </a>
                        @endif
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="permissions-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('permissions.id') }}</th>
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
            var table = $('#permissions-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.permissions.data') }}",
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'permission_badge', name: 'permission_badge' },
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

            $('#permissions-table').on('click', '.delete-permission', function(e) {
                e.preventDefault();
                const permissionId = $(this).data('id');
                const deleteUrl = $(this).attr('href');

                Swal.fire({
                    title: '{{ __("permissions.delete_confirm") }}',
                    text: '{{ __("permissions.delete_confirm_message") }}',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: '{{ __("permissions.confirm") }}',
                    cancelButtonText: '{{ __("permissions.cancel") }}'
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
                                    toastr.success(response.message, "{{ __('toast.success_title') }}");
                                    table.ajax.reload();
                                } else {
                                    toastr.error(response.message, "{{ __('toast.error_title') }}");
                                }
                            },
                            error: function(xhr) {
                                toastr.error(response.message, "{{ __('permissions.error_occurred') }}");
                            }
                        });
                    }
                });
            });
        });
    </script>
@stop

