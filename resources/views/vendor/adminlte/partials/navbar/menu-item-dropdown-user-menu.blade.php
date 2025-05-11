 {{-- User menu --}}

@php( $user = Auth::user() )

@if(isset($user))
    <li class="nav-item dropdown user-menu">
        {{-- User menu toggler --}}
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="userDropdown">
            @if(config('adminlte.usermenu_image'))
                <img src="{{ Auth::user()->adminlte_image() }}" class="user-image img-circle elevation-1"
                    alt="{{ Auth::user()->name }}">
            @endif
            <span @if(config('adminlte.usermenu_image')) class="d-none d-md-inline" @endif>
                {{ Auth::user()->name }}
            </span>
        </a>

        {{-- User menu dropdown --}}
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right" aria-labelledby="userDropdown">

            {{-- User menu header --}}
            @if(config('adminlte.usermenu_image'))
            <li class="user-header bg-primary">
                <img src="{{ Auth::user()->adminlte_image() }}"
                     class="img-circle elevation-2"
                     alt="{{ Auth::user()->name }}">
                <p>{{ Auth::user()->name }}</p>
            </li>
            @endif

            {{-- Profile edit link --}}
            <a href="{{ route('admin.profile.edit') }}" class="dropdown-item">
                <i class="fa fa-fw fa-user text-primary"></i>
                {{ __('users.edit_profile') }}
            </a>

            <li class="dropdown-divider"></li>

            {{-- Logout link --}}
            <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa fa-fw fa-sign-out-alt text-danger"></i>
                {{ __('adminlte::adminlte.log_out') }}
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </a>

            {{-- User menu items --}}
        </ul>
    </li>
@endif
