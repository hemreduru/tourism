/**
 * Bootstrap Helper Functions
 * This file contains helper functions for Bootstrap functionality
 */

document.addEventListener('DOMContentLoaded', function() {
    // Initialize all tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });

    // Initialize all popovers
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl)
    });

    // Add automatic data-dismiss functionality for alerts
    document.querySelectorAll('.alert .close').forEach(function(element) {
        element.addEventListener('click', function() {
            this.parentElement.style.display = 'none';
        });
    });

    // Toggle Sidebar (for mobile devices)
    document.querySelectorAll('.sidebar-toggle').forEach(function(element) {
        element.addEventListener('click', function() {
            document.body.classList.toggle('sidebar-collapse');
        });
    });
});

// Function to show a Bootstrap modal programmatically
function showModal(modalId) {
    var modalElement = document.getElementById(modalId);
    if (modalElement) {
        var modal = new bootstrap.Modal(modalElement);
        modal.show();
    }
}

// Function to hide a Bootstrap modal programmatically
function hideModal(modalId) {
    var modalElement = document.getElementById(modalId);
    if (modalElement) {
        var modal = bootstrap.Modal.getInstance(modalElement);
        if (modal) {
            modal.hide();
        }
    }
}

// Function to show a Bootstrap toast programmatically
function showToast(toastId) {
    var toastElement = document.getElementById(toastId);
    if (toastElement) {
        var toast = new bootstrap.Toast(toastElement);
        toast.show();
    }
}
