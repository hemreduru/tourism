@extends('layouts.app')

@section('title', __('roles.role_details'))

@section('content_header')
    <h1>{{ __('roles.role_details') }}</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $role->display_name }}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <dl>
                                <dt>{{ __('roles.id') }}</dt>
                                <dd>{{ $role->id }}</dd>

                                <dt>{{ __('roles.name') }}</dt>
                                <dd>{{ $role->name }}</dd>

                                <dt>{{ __('roles.display_name') }}</dt>
                                <dd>{{ $role->display_name }}</dd>
                            </dl>
                        </div>
                        <div class="col-md-6">
                            <dl>
                                <dt>{{ __('roles.description') }}</dt>
                                <dd>{{ $role->description ?? '-' }}</dd>

                                <dt>{{ __('roles.created_at') }}</dt>
                                <dd>{{ $role->created_at }}</dd>

                                <dt>{{ __('roles.updated_at') }}</dt>
                                <dd>{{ $role->updated_at }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i> {{ __('roles.edit_role') }}
                    </a>
                    <a href="{{ route('admin.roles.index') }}" class="btn btn-default">
                        {{ __('roles.back_to_list') }}
                    </a>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
</div>
@stop

