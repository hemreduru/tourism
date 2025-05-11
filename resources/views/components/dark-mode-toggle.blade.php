<a href="javascript:void(0)" id="dark-mode-toggle-btn" class="nav-link dark-mode-toggle-link" data-toggle="tooltip" title="{{ $darkMode ? 'Açık Moda Geç' : 'Karanlık Moda Geç' }}" onclick="console.log('Toggle button clicked');">
    @if($darkMode)
        <i class="fas fa-sun" style="color: #ffc107;"></i>
    @else
        <i class="fas fa-moon" style="color: #343a40;"></i>
    @endif
</a>
