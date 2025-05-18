@extends('layouts.app')

@section('title', __('users.create'))

@section('content_header')
    <h1>{{ __('users.create') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{ __('users.user_information') }}</h3>
                </div>
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">{{ __('users.name') }}</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" name="name" value="{{ old('name') }}" placeholder="{{ __('users.name') }}">
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">{{ __('users.email') }}</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" name="email" value="{{ old('email') }}" placeholder="{{ __('users.email') }}">
                            @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">{{ __('users.password') }}</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="{{ __('users.password') }}">
                            @error('password')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">{{ __('users.password_confirmation') }}</label>
                            <input type="password" class="form-control"
                                id="password_confirmation" name="password_confirmation" placeholder="{{ __('users.password_confirmation') }}">
                        </div>

                        <div class="form-group">
                            <label for="roles">{{ __('users.roles') }}</label>
                            <select class="form-control select2 @error('roles') is-invalid @enderror"
                                id="roles" name="roles[]" multiple>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" data-color="{{ $role->color }}">{{ $role->display_name }}</option>
                                @endforeach
                            </select>
                            @error('roles')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">{{ __('users.save') }}</button>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-default">{{ __('users.cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(function() {
            $('.select2').select2({
                placeholder: "{{ __('users.select_roles') }}",
                width: '100%',
                templateResult: formatRoleOption,
                templateSelection: formatRoleSelection
            });

            function formatRoleOption(role) {
                if (!role.id) {
                    return role.text;
                }
                var color = $(role.element).data('color') || 'primary';
                var $badge = $('<span class="badge bg-' + color + '">' + role.text + '</span>');
                return $badge;
            }

            function formatRoleSelection(role) {
                if (!role.id) {
                    return role.text;
                }
                var color = $(role.element).data('color') || 'primary';
                return $('<span>' + role.text + ' <span class="badge bg-' + color + ' ml-1" style="font-size: 0.75em;">' + role.text + '</span></span>');
            }
        });
    </script>
@stop

