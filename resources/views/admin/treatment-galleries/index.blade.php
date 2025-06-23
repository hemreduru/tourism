@extends('layouts.app')

@section('title', __('gallery.galleries'))

@section('content_header')
    <h1>{{ __('gallery.galleries') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">@lang('gallery.galleries')</h3>
                    <div class="card-tools">
                        @if(auth()->user()->hasPermission('galleries.create'))
                            <a href="{{ route('admin.galleries.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> @lang('gallery.add_new_gallery')
                            </a>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <table id="galleries-table" class="table table-bordered table-striped responsive nowrap">
                        <thead>
                            <tr>
                                <th>@lang('gallery.treatment_type_en')</th>
                                <th>@lang('gallery.treatment_type_tr')</th>
                                <th>@lang('gallery.treatment_type_nl')</th>
                                <th>@lang('gallery.before_image')</th>
                                <th>@lang('gallery.after_image')</th>
                                <th>@lang('gallery.order')</th>
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
    $('#galleries-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: '{{ route('admin.galleries.data') }}',
        columns: [
            { data: 'treatment_type_en', name: 'treatment_type_en', responsivePriority: 2 },
            { data: 'treatment_type_tr', name: 'treatment_type_tr', responsivePriority: 3 },
            { data: 'treatment_type_nl', name: 'treatment_type_nl', responsivePriority: 4 },
            { data: 'before_image_path', name: 'before_image_path', orderable:false, searchable:false, responsivePriority: 1 },
            { data: 'after_image_path', name: 'after_image_path', orderable:false, searchable:false, responsivePriority: 1 },
            { data: 'order', name: 'order', responsivePriority: 5 },
            { data: 'is_active', name: 'is_active', responsivePriority: 1 },
            { data: 'created_at', name: 'created_at', responsivePriority: 6 },
            { data: 'action', name: 'action', orderable:false, searchable:false, responsivePriority: 1 },
        ],
        @if (app()->getLocale() == 'tr')
            language: { url: '{{ asset('js/dt/dt_tr.json') }}' },
        @elseif (app()->getLocale() == 'nl')
            language: { url: '{{ asset('js/dt/dt_nl.json') }}' },
        @endif
    });

    $(document).on('click', '.delete-gallery', function () {
        var id = $(this).data('id');
        if (confirm('{{ __('common.are_you_sure_to_delete') }}')) {
            $.ajax({
                url: '/admin/galleries/' + id,
                type: 'POST',
                data: {_method:'DELETE', _token:'{{ csrf_token() }}'},
                success: function(resp){
                    if(resp.success){
                        $('#galleries-table').DataTable().ajax.reload();
                        toastr.success(resp.message);
                    }else{
                        toastr.error(resp.message);
                    }
                },
                error:function(){ toastr.error('{{ __('common.error_deleting') }}'); }
            });
        }
    });
});
</script>
@endpush
