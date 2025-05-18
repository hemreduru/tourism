@extends('layouts.app')

@section('title', __('permissions.create_permission'))

@section('content_header')
    <h1>{{ __('permissions.create_permission') }}</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{ __('permissions.permission_details') }}</h3>
                </div>
                <!-- /.card-header -->

                <!-- form start -->
                <form action="{{ route('admin.permissions.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">{{ __('permissions.name') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="{{ __('permissions.name') }}" value="{{ old('name') }}" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="display_name">{{ __('permissions.display_name') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('display_name') is-invalid @enderror" id="display_name" name="display_name" placeholder="{{ __('permissions.display_name') }}" value="{{ old('display_name') }}" required>
                            @error('display_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">{{ __('permissions.description') }}</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="{{ __('permissions.description') }}">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="roles">{{ __('permissions.roles') }}</label>
                            <select class="form-control select2 @error('roles') is-invalid @enderror" id="roles" name="roles[]" multiple>
                                @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ in_array($role->id, old('roles', [])) ? 'selected' : '' }}>
                                    {{ $role->display_name }} ({{ $role->name }})
                                </option>
                                @endforeach
                            </select>
                            @error('roles')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">{{ __('permissions.save') }}</button>
                        <a href="{{ route('admin.permissions.index') }}" class="btn btn-default">{{ __('permissions.cancel') }}</a>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
</div>
@stop

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            theme: 'bootstrap4',
            placeholder: "{{ __('permissions.select_roles') }}",
            allowClear: true
        });
    });
</script>
@stop

