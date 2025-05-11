@extends('layouts.app')

@section('title', __('users.management'))

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>{{ __('users.management') }}</h1>
        @if(auth()->user()->hasPermission('users.create'))
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> {{ __('users.add_new') }}
        </a>
        @endif
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-3">
                    <div class="form-group mb-0">
                        <label for="role-filter">{{ __('users.filter_by_role') }}:</label>
                        <select id="role-filter" class="form-control select2">
                            <option value="">{{ __('users.all_roles') }}</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" data-color="{{ $role->color }}">{{ $role->display_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="users-table">
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
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'role', name: 'role', searchable: false, render: function(data) { return data; } },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
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
                                    toastr.success(response.message, "{{ __('toast.success_title') }}");
                                    table.ajax.reload();
                                } else {
                                    toastr.error(response.message, "{{ __('toast.error_title') }}");
                                }
                            },
                            error: function(xhr) {
                                toastr.error("{{ __('users.error_deleting') }}", "{{ __('toast.error_title') }}");
                            }
                        });
                    }
                });
            });
        });
    </script>
@stop

