<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\Partner;
use App\Models\Contact;
use App\Models\Status;
use App\Models\Service;
use App\Models\Testimonial; // Added Testimonial model
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
        $partners = Partner::where('is_active', true)->orderBy('order')->get();
        $services = Service::where('is_active', 1)->orderBy('order')->get();
        $testimonials = Testimonial::where('is_active', true)->latest()->get();

        return view('theme.index', [
            'about'    => $about,
            'partners' => $partners,
            'services' => $services,
            'testimonials' => $testimonials,
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

    /**
     * Display single service detail page on theme side.
     */
    public function service(\App\Models\Service $service)
    {
        $locale = App::getLocale() ?: 'en';
        return view('theme.service', compact('service', 'locale'));
    }

    public function contact()
    {
        $locale = App::getLocale() ?: 'en';
        return view('theme.contact', compact('locale'));
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

    /**
     * List all active services.
     */
    public function services()
    {
        $locale = App::getLocale() ?: 'en';
        $services = Service::where('is_active', 1)->orderBy('order')->get();
        return view('theme.services', compact('services', 'locale'));
    }

    /**
     * List all active partners.
     */
    public function partners()
    {
        $locale = App::getLocale() ?: 'en';
        $partners = Partner::where('is_active', 1)->orderBy('order')->get();
        return view('theme.partners', compact('partners', 'locale'));
    }
}
