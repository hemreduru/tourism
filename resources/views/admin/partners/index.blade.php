@extends('layouts.app')

@section('title', __('partners.partners'))

@section('content_header')
    <h1>{{ __('partners.partners') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">@lang('partners.partners')</h3>
                    <div class="card-tools">
                        @if(auth()->user()->hasPermission('partners.create'))
                            <a href="{{ route('admin.partners.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> @lang('partners.add_new_partner')
                            </a>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <table id="partners-table" class="table table-bordered table-striped responsive nowrap">
                        <thead>
                            <tr>
                                <th>@lang('partners.company_name_en')</th>
                                <th>@lang('partners.company_name_tr')</th>
                                <th>@lang('partners.company_name_nl')</th>
                                <th>@lang('partners.logo')</th>
                                <th>@lang('partners.website')</th>
                                <th>@lang('partners.order')</th>
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
            $('#partners-table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '{{ route('admin.partners.data') }}',
                columns: [
                    { data: 'company_name_en', name: 'company_name_en', responsivePriority: 2 },
                    { data: 'company_name_tr', name: 'company_name_tr', responsivePriority: 2 },
                    { data: 'company_name_nl', name: 'company_name_nl', responsivePriority: 2 },
                    { data: 'logo_path', name: 'logo_path', orderable: false, searchable: false, responsivePriority: 3, render: function(data, type, full, meta) {
                        return data ? '<a href="/' + data + '" data-lightbox="partner-logo" data-title="' + full.company_name_en + '"><img src="/' + data + '" width="50"/></a>' : '';
                    }},
                    { data: 'website', name: 'website', responsivePriority: 5, render: function(data, type, full, meta) {
                        return data ? '<a href="' + data + '" target="_blank">' + data + '</a>' : '';
                    }},
                    { data: 'order', name: 'order', responsivePriority: 4 },
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

            $(document).on('click', '.delete-partner', function () {
                var partnerId = $(this).data('id');
                if (confirm('{{ __('common.are_you_sure_to_delete') }}')) {
                    $.ajax({
                        url: '/admin/partners/' + partnerId,
                        type: 'POST',
                        data: {
                            _method: 'DELETE',
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            if (response.success) {
                                $('#partners-table').DataTable().ajax.reload();
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
