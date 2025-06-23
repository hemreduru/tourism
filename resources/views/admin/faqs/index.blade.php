@extends('layouts.app')
@section('title', __('faqs.faqs'))
@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">{{ __('faqs.faqs') }}</h1>
        </div>

    </div>
@stop
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header border-0">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">{{ __('faqs.faqs_list') }}</h3>
                @if(auth()->user()->hasPermission('faqs.create'))
                <a href="{{ route('admin.faqs.create') }}" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-plus mr-1"></i> {{ __('faqs.add_new') }}
                </a>
                @endif
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered table-hover" id="faqs-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>{{ __('faqs.question_en') }}</th>
                        <th>{{ __('faqs.order') }}</th>
                        <th>{{ __('faqs.is_active') }}</th>
                        <th>{{ __('faqs.created_at') }}</th>
                        <th>{{ __('faqs.actions') }}</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@stop
@section('js')
<script>
$(function() {
    $('#faqs-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('admin.faqs.index') }}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'question_en', name: 'question_en' },
            { data: 'order', name: 'order', responsivePriority: 2 },
            { data: 'is_active', name: 'is_active', orderable: false, searchable: false, responsivePriority: 3 },
            { data: 'created_at', name: 'created_at', responsivePriority: 4 },
            { data: 'action', name: 'action', orderable: false, searchable: false, responsivePriority: 1 },
        ],
        @if (app()->getLocale() == 'tr')
        language: { url: '{{ asset('js/dt/dt_tr.json') }}' },
        @elseif (app()->getLocale() == 'nl')
        language: { url: '{{ asset('js/dt/dt_nl.json') }}' },
        @endif
    });

    // Delete with SweetAlert2
    $(document).on('click', '.delete-faq', function() {
        const faqId = $(this).data('id');
        Swal.fire({
            title: "{{ __('faqs.delete_confirm_title') }}",
            text: "{{ __('faqs.delete_confirm_text') }}",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "{{ __('faqs.delete_confirm_yes') }}",
            cancelButtonText: "{{ __('faqs.delete_confirm_no') }}"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "{{ url('admin/faqs') }}/" + faqId,
                    method: 'DELETE',
                    data: { _token: "{{ csrf_token() }}" },
                    success: function(response) {
                        if (response.success) {
                            $('#faqs-table').DataTable().ajax.reload();
                            Toast.fire({ icon: 'success', title: response.message });
                        } else {
                            Toast.fire({ icon: 'error', title: response.message });
                        }
                    },
                    error: function() {
                        Toast.fire({ icon: 'error', title: '{{ __('common.error_deleting') }}' });
                    }
                });
            }
        });
    });
});
</script>
@stop
