<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\Partner;
use App\Models\Contact;
use App\Models\Status;
use App\Models\Service;
use App\Models\Testimonial; // Added Testimonial model
use App\Models\TreatmentGallery; // Added TreatmentGallery model
use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ThemeController extends Controller
{
    public function index()
    {
        $locale = App::getLocale() ?: 'nl';
        $about = AboutUs::where('is_active', 1)->first();
        $partners = Partner::where('is_active', true)->orderBy('order')->get();
        $services = Service::where('is_active', 1)->orderBy('order')->get();
        $testimonials = Testimonial::where('is_active', true)->latest()->get();
        $galleries = TreatmentGallery::where('is_active', true)->orderBy('order')->get();

        return view('theme.index', [
            'about'    => $about,
            'partners' => $partners,
            'services' => $services,
            'testimonials' => $testimonials,
            'galleries' => $galleries,
            'locale'   => $locale,
        ]);
    }

    public function about()
    {
        $locale = App::getLocale() ?: 'nl';
        $about  = AboutUs::where('is_active', 1)->firstOrFail();

        return view('theme.about', compact('about', 'locale'));
    }

    public function partner(Partner $partner)
    {
        $locale = App::getLocale() ?: 'nl';
        return view('theme.partner', compact('partner', 'locale'));
    }

    /**
     * Display single service detail page on theme side.
     */
    public function service(\App\Models\Service $service)
    {
        $locale = App::getLocale() ?: 'nl';
        return view('theme.service', compact('service', 'locale'));
    }

    public function contact()
    {
        $locale = App::getLocale() ?: 'nl';
        return view('theme.contact', compact('locale'));
    }

    public function contactSubmit(ContactRequest $request)
    {
        $validated = $request->validated();

        try {
            DB::transaction(function() use ($validated) {
                $locale = App::getLocale() ?: 'nl';
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
        $locale = App::getLocale() ?: 'nl';
        $services = Service::where('is_active', 1)->orderBy('order')->get();
        return view('theme.services', compact('services', 'locale'));
    }

    /**
     * List all active partners.
     */
    public function partners()
    {
        $locale = App::getLocale() ?: 'nl';
        $partners = Partner::where('is_active', 1)->orderBy('order')->get();
        return view('theme.partners', compact('partners', 'locale'));
    }

    public function gallery(Request $request)
    {
        $locale = App::getLocale() ?: 'nl';

        $categoryParam = $request->query('category', 'all');

        $query = TreatmentGallery::with('service')->where('is_active', true);

        switch ($categoryParam) {
            case 'other':
                $query->whereNull('service_id');
                break;
            case 'all':
                // no extra filter
                break;
            default:
                if (is_numeric($categoryParam)) {
                    $query->where('service_id', $categoryParam);
                }
                break;
        }

        $galleries = $query->orderBy('order')->get();

        $categories = Service::where('is_active', true)->orderBy('order')->get(['id', 'service_name_en', 'service_name_tr', 'service_name_nl']);

        return view('theme.gallery', compact('galleries', 'locale', 'categories', 'categoryParam'));
    }

    /**
     * AJAX endpoint to return rendered gallery grid HTML for filtering.
     */
    public function galleryAjax(Request $request)
    {
        $locale = App::getLocale() ?: 'nl';
        $categoryParam = $request->query('category', 'all');

        $query = TreatmentGallery::with('service')->where('is_active', true);
        switch ($categoryParam) {
            case 'other':
                $query->whereNull('service_id');
                break;
            case 'all':
                break;
            default:
                if (is_numeric($categoryParam)) {
                    $query->where('service_id', $categoryParam);
                }
                break;
        }
        $galleries = $query->orderBy('order')->get();

        $html = view('theme.partials._gallery-grid', ['galleries'=>$galleries])->render();
        return response()->json(['html' => $html]);
    }
}
