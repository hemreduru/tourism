@extends('layouts.app')

@section('title', __('services.services'))

@section('content_header')
    <h1>{{ __('services.services') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">@lang('services.services')</h3>
                    <div class="card-tools">
                        @if(auth()->user()->hasPermission('services.create'))
                            <a href="{{ route('admin.services.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> @lang('services.add_new_service')
                            </a>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <table id="services-table" class="table table-bordered table-striped responsive nowrap">
                        <thead>
                            <tr>
                                <th>@lang('services.service_name_en')</th>
                                <th>@lang('services.service_name_tr')</th>
                                <th>@lang('services.service_name_nl')</th>
                                <th>@lang('services.image')</th>
                                <th>@lang('common.order')</th>
                                <th>@lang('services.link')</th>
                                <th>@lang('common.status')</th>
                                <th>@lang('common.created_at')</th>
                                <th>@lang('common.actions')</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    <script>
        $(function () {
            $('#services-table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '{{ route('admin.services.data') }}',
                columns: [
                    { data: 'service_name_en', name: 'service_name_en', responsivePriority: 2 },
                    { data: 'service_name_tr', name: 'service_name_tr', responsivePriority: 2 },
                    { data: 'service_name_nl', name: 'service_name_nl', responsivePriority: 2 },
                    { data: 'image_path', name: 'image_path', orderable: false, searchable: false, responsivePriority: 3, render: function(data, type, full, meta) {
                        return data ? '<a href="/' + data + '" data-lightbox="service-image" data-title="' + full.service_name_en + '"><img src="/' + data + '" width="50"/></a>' : '';
                    }},
                    { data: 'order', name: 'order', responsivePriority: 5 },
                    { data: 'link', name: 'link', responsivePriority: 6 },
                    { data: 'is_active', name: 'is_active', responsivePriority: 1 },
                    { data: 'created_at', name: 'created_at', responsivePriority: 5 },
                    { data: 'action', name: 'action', orderable: false, searchable: false, responsivePriority: 1 },
                ],
                @if (app()->getLocale() == 'tr')
                    language: {
                        url: '{{ asset('js/dt/dt_tr.json') }}',
                    },
                @elseif (app()->getLocale() == 'nl')
                    language: {
                        url: '{{ asset('js/dt/dt_nl.json') }}',
                    },
                @endif
            });

            $(document).on('click', '.delete-service', function () {
                var serviceId = $(this).data('id');
                if (confirm('{{ __('common.are_you_sure_to_delete') }}')) {
                    $.ajax({
                        url: '/admin/services/' + serviceId,
                        type: 'POST',
                        data: {
                            _method: 'DELETE',
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            if (response.success) {
                                $('#services-table').DataTable().ajax.reload();
                                toastr.success(response.message);
                            } else {
                                toastr.error(response.message);
                            }
                        },
                        error: function (xhr) {
                            toastr.error('{{ __('common.error_deleting') }}');
                        }
                    });
                }
            });
        });
    </script>
@endpush
