<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FaqPublicController extends Controller
{
    /**
     * Display FAQ page.
     */
    public function index(): View
    {
        $faqs = Faq::where('is_active', true)
            ->orderBy('order', 'asc')
            ->get();

        return view('theme.faq', compact('faqs'));
    }
}
