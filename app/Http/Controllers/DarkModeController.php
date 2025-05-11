<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Config;

class DarkModeController extends Controller
{
    /**
     * Toggle dark mode and save preference in cookie
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggle(Request $request)
    {
        // Get current preference from cookie or default to false
        $darkMode = Cookie::get('dark_mode') === 'true';

        // Toggle the preference
        $darkMode = !$darkMode;

        // Save the preference in a cookie that lasts for 1 year
        Cookie::queue('dark_mode', $darkMode ? 'true' : 'false', 60 * 24 * 365);

        // Redirect back to the previous page
        return redirect()->back();
    }
}
