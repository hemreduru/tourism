@extends('layouts.app')

@section('title', __('permissions.assign_permission'))

@section('content_header')
    <h1>{{ __('permissions.assign_permission') }}</h1>
@stop

@section('css')
<style>
    .card-header h5 {
        margin-top: 5px;
    }
    .custom-checkbox label {
        cursor: pointer;
    }
    .card-header .custom-control {
        margin-bottom: 0;
    }
    .custom-control-input:indeterminate~.custom-control-label::before {
        background-color: #17a2b8;
        border-color: #17a2b8;
    }
    .badge {
        font-size: 85%;
        font-weight: normal;
    }
    .custom-control-label .badge {
        padding: 2px 6px;
        margin-left: 4px;
    }
    select#role_id option {
        padding: 8px;
    }
</style>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{ __('permissions.assign_permission') }}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="role_id">{{ __('permissions.roles') }} <span class="text-danger">*</span></label>
                                <select class="form-control" id="role_id" name="role_id">
                                    <option value="">{{ __('permissions.select_roles') }}</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" data-color="{{ $role->color }}">{{ $role->display_name }} ({{ $role->name }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div id="permissions-container" class="mt-4" style="display: none;">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>{{ __('permissions.permissions') }}</h4>
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="select-all">
                                        <label class="custom-control-label" for="select-all">{{ __('Select/Deselect All') }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Group permissions by module -->
                        @foreach($groupedPermissions as $moduleKey => $module)
                            <div class="card mb-3">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input module-checkbox" id="module_{{ $moduleKey }}" data-module="{{ $moduleKey }}">
                                            <label class="custom-control-label" for="module_{{ $moduleKey }}">
                                                <strong>{{ $module['name'] }}</strong>
                                                <span class="badge bg-dark">{{ $moduleKey }}</span>
                                            </label>
                                        </div>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        @foreach($module['permissions'] as $permission)
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input permission-checkbox module-{{ $moduleKey }}"
                                                               id="permission_{{ $permission->id }}"
                                                               value="{{ $permission->id }}"
                                                               data-module="{{ $moduleKey }}">
                                                        <label class="custom-control-label" for="permission_{{ $permission->id }}">
                                                            {{ $permission->display_name }} <small><span class="badge bg-{{ $permission->color }}">{{ $permission->name }}</span></small>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <button id="save-permissions" class="btn btn-primary">{{ __('permissions.save') }}</button>
                                <a href="{{ route('admin.permissions.index') }}" class="btn btn-default">{{ __('permissions.cancel') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
</div>
@stop

@section('js')
<script>
    $(document).ready(function() {
        // Display selected role with appropriate color badge
        function updateRoleLabel() {
            const selectedOption = $('#role_id option:selected');
            if (selectedOption.val()) {
                const color = selectedOption.data('color');
                const name = selectedOption.text();
                $('#role-badge').remove();
                $('#role_id').after('<div id="role-badge" class="mt-2"><span class="badge bg-' + color + '">' + name + '</span></div>');
            } else {
                $('#role-badge').remove();
            }
        }

        // Handle role selection
        $('#role_id').change(function() {
            const roleId = $(this).val();
            updateRoleLabel();

            if (roleId) {
                // Get permissions for the selected role
                $.ajax({
                    url: "{{ route('admin.permissions.get-by-role') }}",
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        role_id: roleId
                    },                    success: function(response) {
                        if (response.success) {
                            // Reset all checkboxes
                            $('.permission-checkbox').prop('checked', false);
                            $('.module-checkbox').prop('checked', false).prop('indeterminate', false);

                            // Check the permissions assigned to this role
                            response.assignedPermissions.forEach(function(permissionId) {
                                $('#permission_' + permissionId).prop('checked', true);
                            });

                            // Update module checkboxes
                            $('.module-checkbox').each(function() {
                                const moduleKey = $(this).data('module');
                                updateModuleCheckbox(moduleKey);
                            });

                            // Update select all checkbox
                            updateSelectAllCheckbox();

                            // Show permissions container
                            $('#permissions-container').show();
                        }
                    },
                    error: function(xhr) {
                        toastr.error("{{ __('permissions.error_occurred') }}", "{{ __('toast.error_title') }}");
                    }
                });
            } else {
                // Hide permissions container
                $('#permissions-container').hide();
            }
        });

        // Handle select all checkbox
        $('#select-all').change(function() {
            const isChecked = $(this).prop('checked');
            $('.permission-checkbox').prop('checked', isChecked);
            $('.module-checkbox').prop('checked', isChecked);
        });

        // Handle module checkboxes
        $('.module-checkbox').change(function() {
            const moduleKey = $(this).data('module');
            const isChecked = $(this).prop('checked');
            $('.module-' + moduleKey).prop('checked', isChecked);
            updateSelectAllCheckbox();
        });

        // Handle individual permission checkboxes
        $(document).on('change', '.permission-checkbox', function() {
            const moduleKey = $(this).data('module');
            updateModuleCheckbox(moduleKey);
            updateSelectAllCheckbox();
        });

        // Function to update module checkbox state based on its permissions
        function updateModuleCheckbox(moduleKey) {
            const totalPermissions = $('.module-' + moduleKey).length;
            const checkedPermissions = $('.module-' + moduleKey + ':checked').length;

            if (checkedPermissions === 0) {
                $('#module_' + moduleKey).prop('checked', false);
                $('#module_' + moduleKey).prop('indeterminate', false);
            } else if (checkedPermissions === totalPermissions) {
                $('#module_' + moduleKey).prop('checked', true);
                $('#module_' + moduleKey).prop('indeterminate', false);
            } else {
                $('#module_' + moduleKey).prop('checked', false);
                $('#module_' + moduleKey).prop('indeterminate', true);
            }
        }

        // Function to update the select-all checkbox state
        function updateSelectAllCheckbox() {
            const totalPermissions = $('.permission-checkbox').length;
            const checkedPermissions = $('.permission-checkbox:checked').length;

            if (checkedPermissions === 0) {
                $('#select-all').prop('checked', false);
                $('#select-all').prop('indeterminate', false);
            } else if (checkedPermissions === totalPermissions) {
                $('#select-all').prop('checked', true);
                $('#select-all').prop('indeterminate', false);
            } else {
                $('#select-all').prop('checked', false);
                $('#select-all').prop('indeterminate', true);
            }
        }

        // Handle saving permissions
        $('#save-permissions').click(function() {
            const roleId = $('#role_id').val();

            if (!roleId) {
                toastr.error("{{ __('Please select a role') }}", "{{ __('toast.error_title') }}");
                return;
            }

            // Get all selected permissions
            const permissionIds = [];
            $('.permission-checkbox:checked').each(function() {
                permissionIds.push($(this).val());
            });

            // Save permissions
            $.ajax({
                url: "{{ route('admin.permissions.assign-to-role') }}",
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    role_id: roleId,
                    permission_ids: permissionIds
                }
            });
        });
    });
</script>
@stop

