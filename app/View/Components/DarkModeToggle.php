<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Cookie;

class DarkModeToggle extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        // Always get the most current cookie value
        $darkMode = Cookie::get('dark_mode', 'off') === 'on';

        return view('components.dark-mode-toggle', [
            'darkMode' => $darkMode
        ]);
    }
}
