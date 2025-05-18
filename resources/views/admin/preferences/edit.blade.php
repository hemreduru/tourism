@extends('adminlte::page')

@section('title', __('preferences.title'))

@section('content_header')
    <h1>{{ __('preferences.title') }}</h1>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card card-primary card-outline shadow-sm">
            <div class="card-header bg-light">
                <h3 class="card-title"><i class="fas fa-sliders-h mr-2"></i>{{ __('preferences.subtitle') }}</h3>
            </div>

            <form action="{{ url('admin/preferences') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card-body">
                    <div class="row">
                        <!-- Dark Mode Toggle -->
                        <div class="col-lg-6 mb-4">
                            <div class="card card-outline h-100 shadow-sm">
                                <div class="card-header bg-light">
                                    <h3 class="card-title"><i class="fas fa-moon mr-2"></i>{{ __('Theme Settings') }}</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group mb-4">
                                        <div class="d-flex align-items-center justify-content-between p-3 bg-light rounded">
                                            <label for="dark_mode" class="mb-0 font-weight-bold">{{ __('preferences.dark_mode') }}</label>
                                            <div class="custom-control custom-switch custom-switch-lg">
                                                <input type="checkbox" class="custom-control-input" id="dark_mode" name="dark_mode" value="1" @if($preferences->dark_mode) checked @endif>
                                                <label class="custom-control-label" for="dark_mode"></label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Accent Color Selection -->
                                    <div class="form-group">
                                        <label for="accent_color" class="font-weight-bold">{{ __('preferences.accent_color') }}</label>
                                        <select class="form-control select2" id="accent_color" name="accent_color">
                                            @foreach(['primary', 'secondary', 'info', 'success', 'warning', 'danger', 'dark'] as $color)
                                                <option value="{{ $color }}" @if($preferences->accent_color === $color) selected @endif>
                                                    {{ __('preferences.colors.' . $color) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Color Settings Card -->
                        <div class="col-lg-6 mb-4">
                            <div class="card card-outline h-100 shadow-sm">
                                <div class="card-header bg-light">
                                    <h3 class="card-title"><i class="fas fa-paint-brush mr-2"></i>{{ __('Color Settings') }}</h3>
                                </div>
                                <div class="card-body">
                                    <!-- Sidebar Color Selection -->
                                    <div class="form-group mb-4">
                                        <label for="sidebar_color" class="font-weight-bold">{{ __('preferences.sidebar_color') }}</label>
                                        <select class="form-control select2" id="sidebar_color" name="sidebar_color">
                                            <optgroup label="{{ __('Dark Themes') }}">
                                                @foreach([
                                                    'sidebar-dark-primary', 'sidebar-dark-warning', 'sidebar-dark-info',
                                                    'sidebar-dark-danger', 'sidebar-dark-success', 'sidebar-dark-indigo',
                                                    'sidebar-dark-navy', 'sidebar-dark-purple', 'sidebar-dark-fuchsia',
                                                    'sidebar-dark-pink', 'sidebar-dark-maroon', 'sidebar-dark-orange',
                                                    'sidebar-dark-lime', 'sidebar-dark-teal', 'sidebar-dark-olive'
                                                ] as $color)
                                                    <option value="{{ $color }}" @if($preferences->sidebar_color === $color) selected @endif>
                                                        {{ __('preferences.sidebar_colors.' . $color) }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                            <optgroup label="{{ __('Light Themes') }}">
                                                @foreach([
                                                    'sidebar-light-primary', 'sidebar-light-warning', 'sidebar-light-info',
                                                    'sidebar-light-danger', 'sidebar-light-success', 'sidebar-light-indigo',
                                                    'sidebar-light-navy', 'sidebar-light-purple', 'sidebar-light-fuchsia',
                                                    'sidebar-light-pink', 'sidebar-light-maroon', 'sidebar-light-orange',
                                                    'sidebar-light-lime', 'sidebar-light-teal', 'sidebar-light-olive'
                                                ] as $color)
                                                    <option value="{{ $color }}" @if($preferences->sidebar_color === $color) selected @endif>
                                                        {{ __('preferences.sidebar_colors.' . $color) }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                        <small class="form-text text-muted"><i class="fas fa-info-circle"></i> {{ __('This controls the color of your sidebar menu.') }}</small>
                                    </div>

                                    <!-- Navbar Color Selection -->
                                    <div class="form-group">
                                        <label for="navbar_color" class="font-weight-bold">{{ __('preferences.navbar_color') }}</label>
                                        <select class="form-control select2" id="navbar_color" name="navbar_color">
                                            @foreach([
                                                'navbar-primary navbar-dark', 'navbar-secondary navbar-dark',
                                                'navbar-info navbar-dark', 'navbar-success navbar-dark',
                                                'navbar-danger navbar-dark', 'navbar-warning navbar-light',
                                                'navbar-white navbar-light', 'navbar-dark'
                                            ] as $color)
                                                <option value="{{ $color }}" @if($preferences->navbar_color === $color) selected @endif>
                                                    {{ __('preferences.navbar_colors.' . $color) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <small class="form-text text-muted"><i class="fas fa-info-circle"></i> {{ __('This controls the color of the top navigation bar.') }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Layout Options Card -->
                        <div class="col-lg-12 mb-4">
                            <div class="card card-outline shadow-sm">
                                <div class="card-header bg-light">
                                    <h3 class="card-title"><i class="fas fa-th-large mr-2"></i>{{ __('Layout Options') }}</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <!-- Boxed Layout -->
                                        <div class="col-lg-6 mb-3">
                                            <div class="d-flex align-items-center p-3 bg-light rounded">
                                                <div class="mr-3 text-center" style="width: 40px;">
                                                    <i class="fas fa-compress-alt fa-lg text-muted"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <label for="layout_boxed" class="mb-0 font-weight-bold">{{ __('preferences.layout_boxed') }}</label>
                                                        <div class="custom-control custom-switch custom-switch-on-success">
                                                            <input type="checkbox" class="custom-control-input" id="layout_boxed" name="layout_boxed" value="1" @if($preferences->layout_boxed) checked @endif>
                                                            <label class="custom-control-label" for="layout_boxed"></label>
                                                        </div>
                                                    </div>
                                                    <small class="text-muted">{{ __('Constrains the width of the application layout') }}</small>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Fixed Sidebar -->
                                        <div class="col-lg-6 mb-3">
                                            <div class="d-flex align-items-center p-3 bg-light rounded">
                                                <div class="mr-3 text-center" style="width: 40px;">
                                                    <i class="fas fa-thumbtack fa-lg text-muted"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <label for="layout_fixed_sidebar" class="mb-0 font-weight-bold">{{ __('preferences.layout_fixed_sidebar') }}</label>
                                                        <div class="custom-control custom-switch custom-switch-on-success">
                                                            <input type="checkbox" class="custom-control-input" id="layout_fixed_sidebar" name="layout_fixed_sidebar" value="1" @if($preferences->layout_fixed_sidebar) checked @endif>
                                                            <label class="custom-control-label" for="layout_fixed_sidebar"></label>
                                                        </div>
                                                    </div>
                                                    <small class="text-muted">{{ __('Keeps the sidebar fixed while scrolling') }}</small>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Fixed Navbar -->
                                        <div class="col-lg-6 mb-3">
                                            <div class="d-flex align-items-center p-3 bg-light rounded">
                                                <div class="mr-3 text-center" style="width: 40px;">
                                                    <i class="fas fa-arrows-alt-v fa-lg text-muted"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <label for="layout_fixed_navbar" class="mb-0 font-weight-bold">{{ __('preferences.layout_fixed_navbar') }}</label>
                                                        <div class="custom-control custom-switch custom-switch-on-success">
                                                            <input type="checkbox" class="custom-control-input" id="layout_fixed_navbar" name="layout_fixed_navbar" value="1" @if($preferences->layout_fixed_navbar) checked @endif>
                                                            <label class="custom-control-label" for="layout_fixed_navbar"></label>
                                                        </div>
                                                    </div>
                                                    <small class="text-muted">{{ __('Keeps the navbar fixed at the top') }}</small>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Fixed Footer -->
                                        <div class="col-lg-6 mb-3">
                                            <div class="d-flex align-items-center p-3 bg-light rounded">
                                                <div class="mr-3 text-center" style="width: 40px;">
                                                    <i class="fas fa-minus fa-lg text-muted"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <label for="layout_fixed_footer" class="mb-0 font-weight-bold">{{ __('preferences.layout_fixed_footer') }}</label>
                                                        <div class="custom-control custom-switch custom-switch-on-success">
                                                            <input type="checkbox" class="custom-control-input" id="layout_fixed_footer" name="layout_fixed_footer" value="1" @if($preferences->layout_fixed_footer) checked @endif>
                                                            <label class="custom-control-label" for="layout_fixed_footer"></label>
                                                        </div>
                                                    </div>
                                                    <small class="text-muted">{{ __('Keeps the footer fixed at the bottom') }}</small>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Collapsed Sidebar -->
                                        <div class="col-lg-6 mb-3">
                                            <div class="d-flex align-items-center p-3 bg-light rounded">
                                                <div class="mr-3 text-center" style="width: 40px;">
                                                    <i class="fas fa-bars fa-lg text-muted"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <label for="sidebar_collapsed" class="mb-0 font-weight-bold">{{ __('preferences.sidebar_collapsed') }}</label>
                                                        <div class="custom-control custom-switch custom-switch-on-success">
                                                            <input type="checkbox" class="custom-control-input" id="sidebar_collapsed" name="sidebar_collapsed" value="1" @if($preferences->sidebar_collapsed) checked @endif>
                                                            <label class="custom-control-label" for="sidebar_collapsed"></label>
                                                        </div>
                                                    </div>
                                                    <small class="text-muted">{{ __('Collapses the sidebar by default') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-light">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <button type="submit" class="btn btn-primary btn-lg px-4">
                                <i class="fas fa-save mr-2"></i> {{ __('preferences.save_changes') }}
                            </button>
                        </div>
                        <div>
                            <small class="text-muted"><i class="fas fa-info-circle mr-1"></i> {{ __('Changes will be applied immediately after saving') }}</small>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js')
<script>
    $(function () {
        // Select2 initialization
        $('.select2').select2();
    });
</script>
@endpush
@stop

@section('css')
<style>
    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #3490dc;
    }

    /* Preview styles */
    #preview-container {
        transition: all 0.3s ease;
    }

    #preview-navbar {
        border-radius: 3px;
        transition: all 0.3s ease;
    }

    #preview-sidebar {
        border-radius: 3px;
        transition: all 0.3s ease;
    }

    #preview-button {
        transition: all 0.3s ease;
    }
</style>
@stop

@section('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Select2
    $('.select2').select2();

    // Update preview on change
    updatePreview();

    $('select, input[type="checkbox"]').on('change', function() {
        updatePreview();
    });

    function updatePreview() {
        // Get selected values
        const accentColor = $('#accent_color').val();
        const darkMode = $('#dark_mode').is(':checked');
        const sidebarColor = $('#sidebar_color').val();
        const navbarColor = $('#navbar_color').val();

        // Update button
        $('#preview-button').removeClass();
        $('#preview-button').addClass('btn btn-' + accentColor);

        // Update sidebar preview
        $('#preview-sidebar').removeClass();
        $('#preview-sidebar').addClass(sidebarColor);
        $('#preview-sidebar').addClass('mr-3');

        // Update navbar preview
        $('#preview-navbar').removeClass();
        $('#preview-navbar').addClass(navbarColor);
        $('#preview-navbar').addClass('mb-3');

        // Update container background for dark mode
        if (darkMode) {
            $('#preview-container').css('background-color', '#343a40');
            $('#preview-container').css('color', '#fff');
            $('#preview-content').css('border-color', '#6c757d');
        } else {
            $('#preview-container').css('background-color', '#fff');
            $('#preview-container').css('color', '#212529');
            $('#preview-content').css('border-color', '#ddd');
        }
    }
});
</script>
@stop
