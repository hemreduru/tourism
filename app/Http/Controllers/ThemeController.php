<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\Partner;
use App\Models\Contact;
use App\Models\Status;
use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ThemeController extends Controller
{
    public function index()
    {
        $locale = App::getLocale() ?: 'en';
        $about = AboutUs::where('is_active', 1)->first();
        $partners = Partner::where('is_active', 1)->orderBy('order')->get();

        return view('theme.index', [
            'about'    => $about,
            'partners' => $partners,
            'locale'   => $locale,
        ]);
    }

    public function about()
    {
        $locale = App::getLocale() ?: 'en';
        $about  = AboutUs::where('is_active', 1)->firstOrFail();

        return view('theme.about', compact('about', 'locale'));
    }

    public function partner(Partner $partner)
    {
        $locale = App::getLocale() ?: 'en';
        return view('theme.partner', compact('partner', 'locale'));
    }

    public function contactSubmit(ContactRequest $request)
    {
        $validated = $request->validated();

        try {
            DB::transaction(function() use ($validated) {
                $locale = App::getLocale() ?: 'en';
                $statusId = Status::first()->id ?? 1;

                Contact::create([
                    'name'          => $validated['name'],
                    'email'         => $validated['email'],
                    'phone'         => $validated['phone'] ?? null,
                    'date'          => $validated['date'],
                    'time_slot'     => $validated['time_slot'],
                    "message_{$locale}" => $validated['message'] ?? null,
                    'language'      => $locale,
                    'status_id'     => $statusId,
                ]);
            });
        } catch(\Throwable $e) {
            report($e);
            return back()->with('error', __('Unexpected error, please try again.'));
        }

        return back()->with('success', __('Your application has been sent successfully.'));
    }
}
