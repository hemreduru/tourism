<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class ThemeController extends Controller
{
    /**
     * Toggle between dark and light mode.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggleDarkMode(Request $request)
    {
        $darkMode = $request->cookie('dark_mode', 'off');
        $newMode = ($darkMode === 'on') ? 'off' : 'on';

        // Log the dark mode change
        Log::info('Dark mode toggled', [
            'previous' => $darkMode,
            'new' => $newMode,
            'user_id' => $request->user() ? $request->user()->id : 'guest',
            'user_agent' => $request->userAgent()
        ]);

        // If AJAX request, return JSON
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'darkMode' => $newMode
            ])->cookie('dark_mode', $newMode, 525600); // 1 year expiration
        }

        return redirect()->back()->cookie('dark_mode', $newMode, 525600); // 1 year expiration
    }
}
