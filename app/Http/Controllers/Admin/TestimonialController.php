<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TestimonialRequest;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $lang = app()->getLocale();
        if ($request->ajax()) {
            $data = Testimonial::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($testimonial) {
                    $actions = '<div class="btn-group" role="group" aria-label="Basic example">';

                    if (auth()->user()->hasPermission('testimonials.view')) {
                        $showUrl = route('admin.testimonials.show', $testimonial->id);
                        $actions .= '<a href="' . $showUrl . '" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>';
                    }
                    if (auth()->user()->hasPermission('testimonials.edit')) {
                        $editUrl = route('admin.testimonials.edit', $testimonial->id);
                        $actions .= '<a href="' . $editUrl . '" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>';
                    }
                    if (auth()->user()->hasPermission('testimonials.delete')) {
                        $actions .= '<button type="button" data-id="' . $testimonial->id . '" class="btn btn-danger btn-sm delete-testimonial"><i class="fas fa-trash"></i></button>';
                    }
                    $actions .= '</div>';
                    return $actions;
                })
                ->editColumn('image_path', function ($testimonial) {
                    return $testimonial->image_path ? '<a href="/' . $testimonial->image_path . '" data-lightbox="testimonial-image" data-title="' . e($testimonial->name_en) . '"><img src="/' . $testimonial->image_path . '" width="50"/></a>' : '';
                })
                ->editColumn('is_active', function ($testimonial) {
                    return $testimonial->is_active ? '<span class="badge badge-success">' . __('common.active') . '</span>' : '<span class="badge badge-danger">' . __('common.inactive') . '</span>';
                })
                ->editColumn('created_at', function ($testimonial) {
                    return $testimonial->created_at->format('d.m.Y H:i:s');
                })
                ->addColumn('name', function ($testimonial) use ($lang) {
                    return $testimonial->{'name_' . $lang} ?? $testimonial->name_en;
                })
                ->addColumn('title', function ($testimonial) use ($lang) {
                    return $testimonial->{'title_' . $lang} ?? $testimonial->title_en;
                })
                ->rawColumns(['action', 'is_active', 'image_path'])
                ->make(true);
        }

        return view('admin.testimonials.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.testimonials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TestimonialRequest $request)
    {
        DB::beginTransaction();
        try {
            $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');

                $targetDir = $_SERVER['DOCUMENT_ROOT'] . '/images/testimonials';
                if (!File::exists($targetDir)) {
                    File::makeDirectory($targetDir, 0755, true);
                }

                $imageName = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
                $image->move($targetDir, $imageName);
                $imagePath = 'images/testimonials/' . $imageName;
            }

            Testimonial::create([
                'name_en'     => $request->name_en,
                'name_tr'     => $request->name_tr,
                'name_nl'     => $request->name_nl,
                'title_en'    => $request->title_en,
                'title_tr'    => $request->title_tr,
                'title_nl'    => $request->title_nl,
                'comment_en'  => $request->comment_en,
                'comment_tr'  => $request->comment_tr,
                'comment_nl'  => $request->comment_nl,
                'image_path'  => $imagePath,
                'is_active'   => $request->has('is_active'),
            ]);

            DB::commit();
            Log::info('Testimonial record created. Created by: ' . auth()->id());

            return redirect()->route('admin.testimonials.index')->with('success', __('common.created_successfully'));
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating testimonial: ' . $e->getMessage());
            return back()->withInput()->with('error', __('common.error_creating') . ' ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Testimonial $testimonial)
    {
        return view('admin.testimonials.show', compact('testimonial'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TestimonialRequest $request, Testimonial $testimonial)
    {
        DB::beginTransaction();
        try {
            $imagePath = $testimonial->image_path;
            if ($request->hasFile('image')) {
                if ($imagePath && File::exists(public_path($imagePath))) {
                    File::delete(public_path($imagePath));
                }
                $image = $request->file('image');
                $targetDir = $_SERVER['DOCUMENT_ROOT'] . '/images/testimonials';
                if (!File::exists($targetDir)) {
                    File::makeDirectory($targetDir, 0755, true);
                }
                $imageName = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
                $image->move($targetDir, $imageName);
                $imagePath = 'images/testimonials/' . $imageName;
            }

            $testimonial->update([
                'name_en'     => $request->name_en,
                'name_tr'     => $request->name_tr,
                'name_nl'     => $request->name_nl,
                'title_en'    => $request->title_en,
                'title_tr'    => $request->title_tr,
                'title_nl'    => $request->title_nl,
                'comment_en'  => $request->comment_en,
                'comment_tr'  => $request->comment_tr,
                'comment_nl'  => $request->comment_nl,
                'image_path'  => $imagePath,
                'is_active'   => $request->has('is_active'),
            ]);

            DB::commit();
            Log::info('Testimonial record updated. Testimonial-id: ' . $testimonial->id . '. Updated by: ' . auth()->id());

            return redirect()->route('admin.testimonials.index')->with('success', __('common.updated_successfully'));
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating testimonial: ' . $e->getMessage());
            return back()->withInput()->with('error', __('common.error_updating'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimonial $testimonial)
    {
        DB::beginTransaction();
        try {
            if ($testimonial->image_path && File::exists(public_path($testimonial->image_path))) {
                File::delete(public_path($testimonial->image_path));
            }
            $testimonial->delete();
            DB::commit();
            Log::info('Testimonial deleted. id: ' . $testimonial->id . '. Deleted by: ' . auth()->id());
            return response()->json(['success' => true, 'message' => __('common.deleted_successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting testimonial: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => __('common.error_deleting') . ' ' . $e->getMessage()]);
        }
    }
}
