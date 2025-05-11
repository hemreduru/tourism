@extends('layouts.app')

@section('title', __('users.edit_profile'))

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('users.edit_profile') }}</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">{{ __('users.name') }}</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">{{ __('users.email') }}</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="profile_image">{{ __('users.upload_image') }}</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('profile_image') is-invalid @enderror" id="profile_image" name="profile_image">
                                        <label class="custom-file-label" for="profile_image">{{ __('users.choose_file') }}</label>
                                    </div>
                                </div>
                                @error('profile_image')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mt-3">
                                <div class="text-center">
                                    <img src="{{ $user->adminlte_image() }}" alt="{{ $user->name }}" class="profile-user-img img-fluid img-circle" style="width: 120px; height: 120px; object-fit: cover;">
                                </div>
                                <p class="text-muted text-center mt-2">{{ __('users.current_image') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">{{ __('users.save_changes') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    <style>
        .profile-user-img {
            border: 3px solid #adb5bd;
            margin: 0 auto;
            padding: 3px;
            width: 100px;
        }
    </style>
@stop

@section('js')
    <script>
        $(document).ready(function () {
            // Show file name when selecting a file
            $('.custom-file-input').on('change', function() {
                let fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').addClass("selected").html(fileName);

                // Preview image before upload
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('.profile-user-img').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });
    </script>
@stop

