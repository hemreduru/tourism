<div class="btn-group">
    @if(auth()->user()->hasPermission('roles.view'))
    <a href="{{ route('admin.roles.show', $role->id) }}" class="btn btn-info btn-sm" title="{{ __('roles.role_details') }}">
        <i class="fas fa-eye"></i>
    </a>
    @endif

    @if(auth()->user()->hasPermission('roles.edit'))
    <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-primary btn-sm" title="{{ __('roles.edit_role') }}">
        <i class="fas fa-edit"></i>
    </a>
    @endif

    @if(auth()->user()->hasPermission('roles.delete'))
    <a href="{{ route('admin.roles.destroy', $role->id) }}" class="btn btn-danger btn-sm delete-role"
       data-id="{{ $role->id }}" title="{{ __('roles.delete_role') }}">
        <i class="fas fa-trash"></i>
    </a>
    @endif
</div>
