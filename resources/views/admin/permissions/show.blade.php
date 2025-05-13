@extends('layouts.app')

@section('title', __('permissions.permission_details'))

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">{{ __('permissions.permission_details') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('admin.dashboard.title') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.permissions.index') }}">{{ __('permissions.permissions') }}</a></li>
                <li class="breadcrumb-item active">{{ $permission->display_name }}</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center mb-3">
                        <i class="fas fa-key fa-3x text-primary"></i>
                    </div>
                    <h3 class="profile-username text-center">{{ $permission->display_name }}</h3>
                    <p class="text-muted text-center">{{ $permission->name }}</p>
                    <p class="text-center mb-3">{{ $permission->description ?? '-' }}</p>
                    <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('admin.permissions.edit', $permission->id) }}" class="btn btn-primary">
                            <i class="fas fa-edit mr-1"></i> {{ __('permissions.edit_permission') }}
                        </a>
                        <a href="{{ route('admin.permissions.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left mr-1"></i> {{ __('permissions.back_to_list') }}
                        </a>
                    </div>
                </div>
            </div>
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{ __('permissions.permission_info') }}</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover">
                        <tr>
                            <td class="text-muted">{{ __('permissions.id') }}</td>
                            <td><span class="badge bg-primary">{{ $permission->id }}</span></td>
                        </tr>
                        <tr>
                            <td class="text-muted">{{ __('permissions.created_at') }}</td>
                            <td>{{ $permission->created_at->format('d M Y, H:i') }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">{{ __('permissions.updated_at') }}</td>
                            <td>{{ $permission->updated_at->format('d M Y, H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-8">
            <div class="card card-primary card-outline">
                <div class="card-header border-0">
                    <h3 class="card-title">{{ __('permissions.assigned_roles') }}</h3>
                </div>
                <div class="card-body">
                    @if($permission->roles->count() > 0)
                        <div class="row">
                            @foreach($permission->roles as $role)
                                <div class="col-md-4 mb-3">
                                    <div class="info-box bg-light">
                                        <span class="info-box-icon bg-{{ $role->color ?? 'primary' }}">
                                            <i class="fas fa-user-shield"></i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">{{ $role->display_name }}</span>
                                            <span class="info-box-number text-muted">{{ $role->name }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-user-shield fa-3x text-muted mb-3"></i>
                            <p class="text-muted mb-0">{{ __('permissions.no_roles_assigned') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
</div>
@stop

