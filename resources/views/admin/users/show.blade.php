@extends('layouts.app')

@section('title', __('users.user_details'))

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">{{ __('users.user_details') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('admin.dashboard.title') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">{{ __('users.users') }}</a></li>
                <li class="breadcrumb-item active">{{ $user->name }}</li>
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
                        <img class="profile-user-img img-fluid img-circle" 
                            src="{{ $user->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&color=7F9CF5&background=EBF4FF' }}" 
                            alt="{{ $user->name }}">
                    </div>
                    <h3 class="profile-username text-center">{{ $user->name }}</h3>
                    <p class="text-muted text-center">{{ $user->email }}</p>
                    <div class="d-flex justify-content-center gap-2">
                        @if(auth()->user()->hasPermission('users.update'))
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary">
                            <i class="fas fa-edit mr-1"></i> {{ __('users.edit_user') }}
                        </a>
                        @endif
                        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left mr-1"></i> {{ __('users.back_to_list') }}
                        </a>
                    </div>
                </div>
            </div>
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{ __('users.user_info') }}</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover">
                        <tr>
                            <td class="text-muted">{{ __('users.id') }}</td>
                            <td><span class="badge bg-primary">{{ $user->id }}</span></td>
                        </tr>
                        <tr>
                            <td class="text-muted">{{ __('users.status') }}</td>
                            <td>
                                @if($user->email_verified_at)
                                    <span class="badge bg-success">{{ __('users.verified') }}</span>
                                @else
                                    <span class="badge bg-warning">{{ __('users.not_verified') }}</span>
                                @endif
                                @if($user->is_active)
                                    <span class="badge bg-success">{{ __('users.active') }}</span>
                                @else
                                    <span class="badge bg-danger">{{ __('users.inactive') }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">{{ __('users.created_at') }}</td>
                            <td>{{ $user->created_at->format('d M Y, H:i') }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">{{ __('users.last_login') }}</td>
                            <td>{{ $user->last_login_at ? $user->last_login_at->format('d M Y, H:i') : '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-8">
            <div class="card card-primary card-outline">
                <div class="card-header border-0">
                    <h3 class="card-title">{{ __('users.assigned_roles') }}</h3>
                </div>
                <div class="card-body">
                    @if($user->roles->count() > 0)
                        <div class="row">
                            @foreach($user->roles as $role)
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
                            <p class="text-muted mb-0">{{ __('users.no_roles_assigned') }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="card card-primary card-outline">
                <div class="card-header border-0">
                    <h3 class="card-title">{{ __('users.permissions_through_roles') }}</h3>
                </div>
                <div class="card-body">
                    @if($user->allPermissions()->count() > 0)
                        <div class="row">
                            @foreach($user->allPermissions()->groupBy(function($permission) {
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
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-lock fa-3x text-muted mb-3"></i>
                            <p class="text-muted mb-0">{{ __('users.no_permissions') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@stop
