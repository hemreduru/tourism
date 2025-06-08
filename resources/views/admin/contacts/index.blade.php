@extends('layouts.app')

@section('title', __('contacts.contacts'))

@section('content_header')
    <h1>{{ __('contacts.contacts') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">@lang('contacts.all_contacts')</h3>
                    <div class="card-tools">
                        @if(auth()->user()->hasPermission('contacts.create'))
                            <a href="{{ route('admin.contacts.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> @lang('contacts.add_new_contact')
                            </a>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <table id="contacts-table" class="table table-bordered table-striped responsive nowrap">
                        <thead>
                            <tr>
                                <th>@lang('contacts.name')</th>
                                <th>@lang('contacts.email')</th>
                                <th>@lang('contacts.phone')</th>
                                <th>@lang('contacts.date_time')</th>
                                <th>@lang('contacts.status')</th>
                                <th>@lang('contacts.is_read')</th>
                                <th>@lang('contacts.is_responded')</th>
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
            $('#contacts-table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '{{ route('admin.contacts.data') }}',
                columns: [
                    { data: 'name', name: 'name', responsivePriority: 2 },
                    { data: 'email', name: 'email', responsivePriority: 3 },
                    { data: 'phone', name: 'phone', responsivePriority: 4 },
                    { data: 'date_time', name: 'date_time', responsivePriority: 3 },
                    { data: 'status', name: 'status', responsivePriority: 3 },
                    { data: 'is_read', name: 'is_read', responsivePriority: 3 },
                    { data: 'is_responded', name: 'is_responded', responsivePriority: 3 },
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

            $(document).on('click', '.delete-contact', function () {
                var contactId = $(this).data('id');
                if (confirm('{{ __('common.are_you_sure_to_delete') }}')) {
                    $.ajax({
                        url: '/admin/contacts/' + contactId,
                        type: 'POST',
                        data: {
                            _method: 'DELETE',
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            if (response.success) {
                                $('#contacts-table').DataTable().ajax.reload();
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
