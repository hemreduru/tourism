<div class="btn-group">
    @if(auth()->user()->hasPermission('permissions.view'))
    <a href="{{ route('admin.permissions.show', $permission->id) }}" class="btn btn-info btn-sm" title="{{ __('permissions.permission_details') }}">
        <i class="fas fa-eye"></i>
    </a>
    @endif

    @if(auth()->user()->hasPermission('permissions.edit'))
    <a href="{{ route('admin.permissions.edit', $permission->id) }}" class="btn btn-primary btn-sm" title="{{ __('permissions.edit_permission') }}">
        <i class="fas fa-edit"></i>
    </a>
    @endif

    @if(auth()->user()->hasPermission('permissions.delete'))
    <a href="{{ route('admin.permissions.destroy', $permission->id) }}" class="btn btn-danger btn-sm delete-permission"
       data-id="{{ $permission->id }}" title="{{ __('permissions.delete_permission') }}">
        <i class="fas fa-trash"></i>
    </a>
    @endif
</div>
