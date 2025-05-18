@extends('layouts.app')

@section('title', __('roles.edit_role'))

@section('content_header')
    <h1>{{ __('roles.edit_role') }}</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{ __('roles.role_details') }}</h3>
                </div>
                <!-- /.card-header -->

                <!-- form start -->
                <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">{{ __('roles.name') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="{{ __('roles.name') }}" value="{{ old('name', $role->name) }}" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="display_name">{{ __('roles.display_name') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('display_name') is-invalid @enderror" id="display_name" name="display_name" placeholder="{{ __('roles.display_name') }}" value="{{ old('display_name', $role->display_name) }}" required>
                            @error('display_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">{{ __('roles.description') }}</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="{{ __('roles.description') }}">{{ old('description', $role->description) }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="color">{{ __('roles.color') }}</label>
                            <select class="form-control @error('color') is-invalid @enderror" id="color" name="color">
                                @foreach(App\Models\Role::getAvailableColors() as $value => $label)
                                    <option value="{{ $value }}" class="bg-{{ $value }}" {{ old('color', $role->color) == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('color')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">{{ __('roles.save') }}</button>
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-default">{{ __('roles.cancel') }}</a>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
</div>
@stop

