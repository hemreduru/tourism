@extends('layouts.app')

@section('title', __('testimonials.testimonials'))

@section('content_header')
    <h1>{{ __('testimonials.testimonials') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">@lang('testimonials.testimonials')</h3>
                    <div class="card-tools">
                        @if(auth()->user()->hasPermission('testimonials.create'))
                            <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> @lang('testimonials.add_new_testimonial')
                            </a>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <table id="testimonials-table" class="table table-bordered table-striped responsive nowrap">
                        <thead>
                        <tr>
                            <th>@lang('testimonials.name')</th>
                            <th>@lang('testimonials.title')</th>
                            <th>@lang('testimonials.image')</th>
                            <th>@lang('common.status')</th>
                            <th>@lang('common.created_at')</th>
                            <th>@lang('common.actions')</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    <script>
        $(function () {
            $('#testimonials-table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '{{ route('admin.testimonials.data') }}',
                columns: [
                    { data: 'name', name: 'name', responsivePriority: 2 },
                    { data: 'title', name: 'title', responsivePriority: 3 },
                    { data: 'image_path', name: 'image_path', orderable: false, searchable: false, responsivePriority: 3 },
                    { data: 'is_active', name: 'is_active', responsivePriority: 1 },
                    { data: 'created_at', name: 'created_at', responsivePriority: 4 },
                    { data: 'action', name: 'action', orderable: false, searchable: false, responsivePriority: 1 },
                ],
                @if (app()->getLocale() == 'tr')
                    language: { url: '{{ asset('js/dt/dt_tr.json') }}' },
                @elseif (app()->getLocale() == 'nl')
                    language: { url: '{{ asset('js/dt/dt_nl.json') }}' },
                @endif
            });

            $(document).on('click', '.delete-testimonial', function () {
                var id = $(this).data('id');
                if (confirm('{{ __('common.are_you_sure_to_delete') }}')) {
                    $.ajax({
                        url: '/admin/testimonials/' + id,
                        type: 'POST',
                        data: { _method: 'DELETE', _token: '{{ csrf_token() }}' },
                        success: function (response) {
                            if (response.success) {
                                $('#testimonials-table').DataTable().ajax.reload();
                                toastr.success(response.message);
                            } else {
                                toastr.error(response.message);
                            }
                        },
                        error: function () { toastr.error('{{ __('common.error_deleting') }}'); }
                    });
                }
            });
        });
    </script>
@endpush
