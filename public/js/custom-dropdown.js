/**
 * Custom JavaScript to fix dropdown menu issues in AdminLTE
 */
document.addEventListener('DOMContentLoaded', function() {
    // Fix for user dropdown menu
    const userMenuToggle = document.querySelector('.user-menu .dropdown-toggle');
    if (userMenuToggle) {
        userMenuToggle.addEventListener('click', function(e) {
            e.preventDefault();
            const dropdownMenu = this.nextElementSibling;
            if (dropdownMenu) {
                dropdownMenu.classList.toggle('show');
                this.setAttribute('aria-expanded', dropdownMenu.classList.contains('show'));
            }
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.user-menu')) {
                const openDropdowns = document.querySelectorAll('.user-menu .dropdown-menu.show');
                openDropdowns.forEach(dropdown => {
                    dropdown.classList.remove('show');
                    const toggle = dropdown.previousElementSibling;
                    if (toggle) {
                        toggle.setAttribute('aria-expanded', 'false');
                    }
                });
            }
        });
    }
});
