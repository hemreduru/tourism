@extends('layouts.app')

@section('title', __('users.management'))

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">{{ __('users.management') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('admin.dashboard.title') }}</a></li>
                <li class="breadcrumb-item active">{{ __('users.users') }}</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header border-0">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">
                    <h3 class="card-title mb-0">{{ __('users.users_list') }}</h3>
                    <div class="form-group mb-0 ml-3">
                        <select id="role-filter" class="form-control form-control-sm select2">
                            <option value="">{{ __('users.all_roles') }}</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" data-color="{{ $role->color }}">{{ $role->display_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @if(auth()->user()->hasPermission('users.create'))
                <a href="{{ route('admin.users.create') }}" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-plus mr-1"></i> {{ __('users.add_new') }}
                </a>
                @endif
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover text-nowrap" id="users-table">
                <thead>
                    <tr>
                        <th>{{ __('users.id') }}</th>
                        <th>{{ __('users.name') }}</th>
                        <th>{{ __('users.email') }}</th>
                        <th>{{ __('users.roles') }}</th>
                        <th>{{ __('users.created_at') }}</th>
                        <th>{{ __('users.actions') }}</th>
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
            $('.select2').select2({
                width: '100%',
                templateResult: formatRoleOption,
                templateSelection: formatRoleOption
            });

            // Format role options with colored badges
            function formatRoleOption(role) {
                if (!role.id) {
                    return role.text;
                }

                var color = $(role.element).data('color') || 'primary';
                var $role = $(
                    '<span>' + role.text + ' <span class="badge bg-' + color + '">' + role.text + '</span></span>'
                );
                return $role;
            }

            // DataTable configuration object
            let dataTableConfig = {
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{ route('admin.users.data') }}",
                    data: function(d) {
                        d.role = $('#role-filter').val();
                    },
                },
                @if (app()->getLocale() == 'tr')
                    language: {
                        url: '{{ asset('js/dt/dt_tr.json') }}',
                    },
                @endif
                columns: [
                    { data: 'id', name: 'id', responsivePriority: 1 },
                    { data: 'name', name: 'name', responsivePriority: 1 },
                    { data: 'email', name: 'email', responsivePriority: 2 },
                    { data: 'role', name: 'role', searchable: false, render: function(data) { return data; }, responsivePriority: 2 },
                    { data: 'created_at', name: 'created_at', responsivePriority: 3 },
                    { data: 'action', name: 'action', orderable: false, searchable: false, responsivePriority: 1 }
                ]
            };


            // Initialize DataTable
            let table = $('#users-table').DataTable(dataTableConfig);

            // Role filter change event
            $('#role-filter').on('change', function() {
                table.ajax.reload();
            });

            // Handle delete user with SweetAlert2 confirmation
            $(document).on('click', '.delete-user', function() {
                const userId = $(this).data('id');

                Swal.fire({
                    title: "{{ __('users.delete_confirm_title') }}",
                    text: "{{ __('users.delete_confirm_text') }}",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "{{ __('users.delete_confirm_yes') }}",
                    cancelButtonText: "{{ __('users.delete_confirm_no') }}"
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "{{ url('admin/users') }}/" + userId,
                            method: 'DELETE',
                            data: {
                                _token: "{{ csrf_token() }}"
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

