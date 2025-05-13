<script>
    $(document).ready(function() {
        // Toastr options
        toastr.options = {
            closeButton: true,
            debug: false,
            newestOnTop: true,
            progressBar: true,
            positionClass: 'toast-top-right',
            preventDuplicates: false,
            onclick: null,
            showDuration: '300',
            hideDuration: '1000',
            timeOut: '5000',
            extendedTimeOut: '1000',
            showEasing: 'swing',
            hideEasing: 'linear',
            showMethod: 'fadeIn',
            hideMethod: 'fadeOut'
        };

        // Session messages
        @if(session('success'))
            toastr.success('{{ session('success') }}');
        @endif

        @if(session('error'))
            toastr.error('{{ session('error') }}');
        @endif

        @if(session('info'))
            toastr.info('{{ session('info') }}');
        @endif

        @if(session('warning'))
            toastr.warning('{{ session('warning') }}');
        @endif

        // Global AJAX success handler
        $(document).ajaxSuccess(function(event, xhr, settings) {
            if (xhr.responseJSON) {
                const response = xhr.responseJSON;
                
                if (response.success && response.message) {
                    toastr.success(response.message);
                    
                    if (response.redirect) {
                        setTimeout(function() {
                            window.location.href = response.redirect;
                        }, 1500);
                    }
                }
            }
        });

        // Global AJAX error handler
        $(document).ajaxError(function(event, xhr, settings) {
            if (xhr.responseJSON) {
                const response = xhr.responseJSON;
                
                if (!response.success && response.message) {
                    toastr.error(response.message);
                } else if (xhr.status === 422 && response.errors) {
                    Object.values(response.errors).forEach(function(errors) {
                        errors.forEach(function(error) {
                            toastr.error(error);
                        });
                    });
                }
            } else {
                toastr.error('{{ __('toast.unexpected_error') }}');
            }
        });
    });
</script>
