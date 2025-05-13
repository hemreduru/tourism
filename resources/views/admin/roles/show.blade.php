@extends('layouts.app')

@section('title', __('roles.role_details'))

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">{{ __('roles.role_details') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('admin.dashboard.title') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">{{ __('roles.roles') }}</a></li>
                <li class="breadcrumb-item active">{{ $role->display_name }}</li>
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
                        <i class="fas fa-user-shield fa-3x text-primary"></i>
                    </div>
                    <h3 class="profile-username text-center">{{ $role->display_name }}</h3>
                    <p class="text-muted text-center">{{ $role->name }}</p>
                    <p class="text-center mb-3">{{ $role->description ?? '-' }}</p>
                    <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-primary">
                            <i class="fas fa-edit mr-1"></i> {{ __('roles.edit_role') }}
                        </a>
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left mr-1"></i> {{ __('roles.back_to_list') }}
                        </a>
                    </div>
                </div>
            </div>
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{ __('roles.role_info') }}</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover">
                        <tr>
                            <td class="text-muted">{{ __('roles.id') }}</td>
                            <td><span class="badge bg-primary">{{ $role->id }}</span></td>
                        </tr>
                        <tr>
                            <td class="text-muted">{{ __('roles.created_at') }}</td>
                            <td>{{ $role->created_at->format('d M Y, H:i') }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">{{ __('roles.updated_at') }}</td>
                            <td>{{ $role->updated_at->format('d M Y, H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-8">
            <div class="card card-primary card-outline">
                <div class="card-header border-0">
                    <h3 class="card-title">{{ __('roles.permissions') }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($role->permissions->groupBy(function($permission) {
                            return explode('.', $permission->name)[0];
                        }) as $group => $permissions)
                            <div class="col-md-4 mb-4">
                                <h5 class="text-primary mb-3 text-capitalize">{{ $group }}</h5>
                                <ul class="list-unstyled">
                                    @foreach($permissions as $permission)
                                        <li class="mb-2">
                                            <i class="fas fa-check-circle text-success mr-2"></i>
                                            {{ $permission->display_name }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
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

