@extends('layouts.app')

@section('title', __('admin.dashboard.title'))

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>{{ __('admin.dashboard.statistics') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">{{ __('admin.dashboard.title') }}</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    {{-- İstatistik Kutuları --}}
    <div class="row">
        @if(auth()->user()->hasPermission('users.view'))
        <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-primary">
                <div class="inner py-3">
                    <h3 class="fs-2 fw-bold mb-2">{{ $stats['users_count'] ?? 0 }}</h3>
                    <p class="fs-6 fw-medium text-uppercase mb-0">{{ __('admin.dashboard.total_users') }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="{{ route('admin.users.index') }}" class="small-box-footer">
                    {{ __('admin.dashboard.more_info') }} <i class="fas fa-arrow-circle-right ml-1"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-info">
                <div class="inner py-3">
                    <h3 class="fs-2 fw-bold mb-2">{{ $stats['active_users'] ?? 0 }}</h3>
                    <p class="fs-6 fw-medium text-uppercase mb-0">{{ __('admin.dashboard.active_users') }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-check"></i>
                </div>
                <a href="{{ route('admin.users.index') }}" class="small-box-footer">
                    {{ __('admin.dashboard.more_info') }} <i class="fas fa-arrow-circle-right ml-1"></i>
                </a>
            </div>
        </div>
        @endif

        @if(auth()->user()->hasPermission('roles.view'))
        <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-success">
                <div class="inner py-3">
                    <h3 class="fs-2 fw-bold mb-2">{{ $stats['roles_count'] ?? 0 }}</h3>
                    <p class="fs-6 fw-medium text-uppercase mb-0">{{ __('admin.dashboard.total_roles') }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-tag"></i>
                </div>
                <a href="{{ route('admin.roles.index') }}" class="small-box-footer">
                    {{ __('admin.dashboard.more_info') }} <i class="fas fa-arrow-circle-right ml-1"></i>
                </a>
            </div>
        </div>
        @endif

        @if(auth()->user()->hasPermission('permissions.view'))
        <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-warning">
                <div class="inner py-3">
                    <h3 class="fs-2 fw-bold mb-2">{{ $stats['permissions_count'] ?? 0 }}</h3>
                    <p class="fs-6 fw-medium text-uppercase mb-0">{{ __('admin.dashboard.total_permissions') }}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-key"></i>
                </div>
                <a href="{{ route('admin.permissions.index') }}" class="small-box-footer">
                    {{ __('admin.dashboard.more_info') }} <i class="fas fa-arrow-circle-right ml-1"></i>
                </a>
            </div>
        </div>
        @endif
    </div>

    {{-- Zaman Bazlı İstatistikler ve Son Kullanıcılar --}}
    @if(auth()->user()->hasPermission('users.view'))
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('admin.dashboard.latest_users') }}</h3>
                </div>
                <div class="card-body p-0 table-responsive-sm">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>{{ __('admin.dashboard.name') }}</th>
                                <th>{{ __('admin.dashboard.email') }}</th>
                                <th>{{ __('admin.dashboard.roles') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($latestUsers as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @foreach($user->roles as $role)
                                        <span class="badge bg-{{ $role->color }}">{{ $role->display_name }}</span>
                                    @endforeach
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @if(auth()->user()->hasPermission('roles.view'))
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('admin.dashboard.user_roles') }}</h3>
                </div>
                <div class="card-body p-3">
                    <div class="position-relative" style="height:250px">
                        <canvas id="roleDistributionChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    @endif

    {{-- Kullanıcı İstatistikleri --}}
    @if(auth()->user()->hasPermission('users.view'))
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('admin.dashboard.latest_activities') }}</h3>
                </div>
                <div class="card-body p-0">
                    <div class="row p-3">
                        <div class="col-sm-3">
                            <div class="description-block border-right">
                                <h5 class="fs-3 fw-bold mb-2">{{ $stats['users_today'] }}</h5>
                                <span class="text-muted text-sm">{{ __('admin.dashboard.today') }}</span>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="description-block border-right">
                                <h5 class="fs-3 fw-bold mb-2">{{ $stats['users_this_week'] }}</h5>
                                <span class="text-muted text-sm">{{ __('admin.dashboard.this_week') }}</span>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="description-block border-right">
                                <h5 class="fs-3 fw-bold mb-2">{{ $stats['users_this_month'] }}</h5>
                                <span class="text-muted text-sm">{{ __('admin.dashboard.this_month') }}</span>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="description-block">
                                <h5 class="fs-3 fw-bold mb-2">{{ $stats['users_count'] }}</h5>
                                <span class="text-muted text-sm">{{ __('admin.dashboard.total') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@stop

@section('css')
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Rol dağılım grafiği
    const roleData = @json($roleDistribution);
    const ctx = document.getElementById('roleDistributionChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: roleData.map(item => item.name),
            datasets: [{
                data: roleData.map(item => item.count),
                backgroundColor: [
                    '#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc',
                    '#d2d6de', '#ff851b', '#39cccc', '#605ca8', '#ff851b'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
        }
    });
</script>
@stop
