<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use Illuminate\Support\Facades\App as AppFacade;

class PolicyPublicController extends Controller
{
    private function render(string $type)
    {
        $policy = Policy::where('type', $type)->where('is_active', 1)->firstOrFail();
        $locale = AppFacade::getLocale() ?: 'en';
        return view('theme.policy', compact('policy', 'locale'));
    }

    public function privacy()
    {
        return $this->render('privacy');
    }

    public function terms()
    {
        return $this->render('terms');
    }

    public function gdpr()
    {
        return $this->render('gdpr');
    }
}
