@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        toastr.success("{{ session('success') }}", "{{ __('toast.success_title') }}");
    });
</script>
@endif

@if(session('error'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        toastr.error("{{ session('error') }}", "{{ __('toast.error_title') }}");
    });
</script>
@endif

@if(session('warning'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        toastr.warning("{{ session('warning') }}", "{{ __('toast.warning_title') }}");
    });
</script>
@endif

@if(session('info'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        toastr.info("{{ session('info') }}", "{{ __('toast.info_title') }}");
    });
</script>
@endif

@if ($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}", "{{ __('toast.validation_title') }}");
        @endforeach
    });
</script>
@endif

<script>
    // Toastr configuration
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
</script>
