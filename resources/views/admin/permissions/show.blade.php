@extends('layouts.app')

@section('title', __('permissions.permission_details'))

@section('content_header')
    <h1>{{ __('permissions.permission_details') }}</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $permission->display_name }}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <dl>
                                <dt>{{ __('permissions.id') }}</dt>
                                <dd>{{ $permission->id }}</dd>

                                <dt>{{ __('permissions.name') }}</dt>
                                <dd>{{ $permission->name }}</dd>

                                <dt>{{ __('permissions.display_name') }}</dt>
                                <dd>{{ $permission->display_name }}</dd>

                                <dt>{{ __('permissions.description') }}</dt>
                                <dd>{{ $permission->description ?? '-' }}</dd>
                            </dl>
                        </div>
                        <div class="col-md-6">
                            <dl>
                                <dt>{{ __('permissions.created_at') }}</dt>
                                <dd>{{ $permission->created_at }}</dd>

                                <dt>{{ __('permissions.updated_at') }}</dt>
                                <dd>{{ $permission->updated_at }}</dd>

                                <dt>{{ __('permissions.assigned_roles') }}</dt>
                                <dd>
                                    @if($permission->roles->count() > 0)
                                        <ul>
                                            @foreach($permission->roles as $role)
                                                <li>{{ $role->display_name }} ({{ $role->name }})</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="{{ route('admin.permissions.edit', $permission->id) }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i> {{ __('permissions.edit_permission') }}
                    </a>
                    <a href="{{ route('admin.permissions.index') }}" class="btn btn-default">
                        <i class="fas fa-arrow-left"></i> {{ __('permissions.back_to_list') }}
                    </a>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
</div>
@stop

