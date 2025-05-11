@extends('adminlte::page')

@section('css')
    <!-- Use only sidebar indentation styling, rely on AdminLTE for dark mode -->
    <link rel="stylesheet" href="{{ asset('css/sidebar-indentation.css') }}">
@stop

@section('js')
    <script>
        console.log('Dark mode script loading');
        // Handle dark mode UI updates
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM fully loaded');

            // Check if we have dark mode enabled
            const isDarkMode = '{{ Cookie::get('dark_mode', 'off') }}' === 'on';
            console.log('Initial dark mode state:', isDarkMode);

            // Initial dark mode setup
            applyDarkMode(isDarkMode);

            // Get dark mode toggle button
            const toggleBtn = document.getElementById('dark-mode-toggle-btn');
            console.log('Toggle button found:', toggleBtn !== null);

            if (toggleBtn) {
                // Dark mode toggle click handler with AJAX
                toggleBtn.addEventListener('click', function(e) {
                    console.log('Toggle button clicked');
                    e.preventDefault();

                    // Get the current URL for toggling dark mode
                    const toggleUrl = '{{ route('dark-mode.toggle') }}';
                    console.log('Toggle URL:', toggleUrl);

                    // Send AJAX request to toggle dark mode
                    fetch(toggleUrl, {
                        method: 'GET',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        credentials: 'same-origin'
                    })
                    .then(response => {
                        console.log('Response received:', response.status);
                        return response.json();
                    })
                    .then(data => {
                        console.log('Toggle response data:', data);
                        // Apply dark mode based on response
                        const newDarkMode = data.darkMode === 'on';
                        applyDarkMode(newDarkMode);

                        // Update toggle button
                        updateDarkModeToggle(newDarkMode);

                        console.log('Dark mode toggled:', newDarkMode ? 'enabled' : 'disabled');
                    })
                    .catch(error => {
                        console.error('Error toggling dark mode:', error);
                    });
                });

            // Function to apply dark mode changes
            function applyDarkMode(enabled) {
                // Apply to body class
                if (enabled) {
                    document.body.classList.add('dark-mode');
                    document.querySelector('.main-sidebar').classList.remove('sidebar-light-primary');
                    document.querySelector('.main-sidebar').classList.add('sidebar-dark-primary');
                    document.querySelector('.navbar').classList.remove('navbar-light', 'navbar-white');
                    document.querySelector('.navbar').classList.add('navbar-dark');
                } else {
                    document.body.classList.remove('dark-mode');
                    document.querySelector('.main-sidebar').classList.remove('sidebar-dark-primary');
                    document.querySelector('.main-sidebar').classList.add('sidebar-light-primary');
                    document.querySelector('.navbar').classList.remove('navbar-dark');
                    document.querySelector('.navbar').classList.add('navbar-light', 'navbar-white');
                }
            }

            // Function to update toggle button appearance
            function updateDarkModeToggle(enabled) {
                const button = document.getElementById('dark-mode-toggle-btn');
                if (!button) {
                    console.error('Dark mode toggle button not found!');
                    return;
                }

                const icon = button.querySelector('i');
                if (!icon) {
                    console.error('Icon element not found in toggle button!');
                    return;
                }

                if (enabled) {
                    button.setAttribute('title', 'Açık Moda Geç');
                    if (icon.classList.contains('fa-moon')) {
                        icon.classList.remove('fa-moon');
                        icon.classList.add('fa-sun');
                        icon.style.color = '#ffc107'; // sarı güneş ikonu
                    }
                } else {
                    button.setAttribute('title', 'Karanlık Moda Geç');
                    if (icon.classList.contains('fa-sun')) {
                        icon.classList.remove('fa-sun');
                        icon.classList.add('fa-moon');
                        icon.style.color = '#343a40'; // koyu gri ay ikonu
                    }
                }

                console.log('Button updated:', enabled ? 'dark mode' : 'light mode');
            }
        });
    </script>
@stop
