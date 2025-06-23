@extends('layouts.app')

@section('title', __('policies.policies'))

@section('content_header')
    <h1>{{ __('policies.policies') }}</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">@lang('policies.policies')</h3>
                <div class="card-tools">
                    @if(auth()->user()->hasPermission('policies.create'))
                        <a href="{{ route('admin.policies.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> @lang('policies.add_new_policy')
                        </a>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <table id="policies-table" class="table table-bordered table-striped responsive nowrap">
                    <thead>
                        <tr>
                            <th>@lang('policies.type')</th>
                            <th>@lang('policies.title_en')</th>
                            <th>@lang('policies.title_tr')</th>
                            <th>@lang('policies.title_nl')</th>
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
    $('#policies-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: '{{ route('admin.policies.data') }}',
        columns:[
            {data:'type', name:'type', responsivePriority:2},
            {data:'title_en', name:'title_en', responsivePriority:2},
            {data:'title_tr', name:'title_tr', responsivePriority:3},
            {data:'title_nl', name:'title_nl', responsivePriority:3},
            {data:'is_active', name:'is_active', responsivePriority:1, orderable:false, searchable:false},
            {data:'created_at', name:'created_at', responsivePriority:4},
            {data:'action', name:'action', orderable:false, searchable:false, responsivePriority:1},
        ],
        @if(app()->getLocale() == 'tr')
            language:{ url:'{{ asset('js/dt/dt_tr.json') }}' },
        @elseif(app()->getLocale() == 'nl')
            language:{ url:'{{ asset('js/dt/dt_nl.json') }}' },
        @endif
    });

    // Delete handler
    $(document).on('click', '.delete-policy', function(){
        var id = $(this).data('id');
        if(confirm('{{ __('common.are_you_sure_to_delete') }}')){
            $.ajax({
                url:'/admin/policies/'+id,
                type:'POST',
                data:{ _method:'DELETE', _token:'{{ csrf_token() }}' },
                success:function(r){
                    if(r.success){
                        $('#policies-table').DataTable().ajax.reload();
                        toastr.success(r.message);
                    }else{
                        toastr.error(r.message);
                    }
                },
                error:function(){ toastr.error('{{ __('common.error_deleting') }}'); }
            });
        }
    });
});
</script>
@endpush
