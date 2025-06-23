<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TreatmentGalleryRequest;
use App\Models\TreatmentGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class TreatmentGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = TreatmentGallery::select('*');
            $lang = app()->getLocale();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($gallery) {
                    $actions = '<div class="btn-group" role="group">';

                    if (auth()->user()->hasPermission('galleries.view')) {
                        $showUrl = route('admin.galleries.show', $gallery->id);
                        $actions .= '<a href="' . $showUrl . '" class="btn btn-primary btn-sm" title="' . __('common.view') . '"><i class="fas fa-eye"></i></a>';
                    }
                    if (auth()->user()->hasPermission('galleries.edit')) {
                        $editUrl = route('admin.galleries.edit', $gallery->id);
                        $actions .= ' <a href="' . $editUrl . '" class="btn btn-info btn-sm" title="' . __('common.edit') . '"><i class="fas fa-edit"></i></a>';
                    }
                    if (auth()->user()->hasPermission('galleries.delete')) {
                        $actions .= ' <button data-id="' . $gallery->id . '" class="btn btn-danger btn-sm delete-gallery" title="' . __('common.delete') . '"><i class="fas fa-trash"></i></button>';
                    }
                    $actions .= '</div>';
                    return $actions;
                })
                ->addColumn('treatment_type', function ($gallery) use ($lang) {
                    return $gallery->{'treatment_type_' . $lang} ?? $gallery->treatment_type_en;
                })
                ->editColumn('before_image_path', function ($gallery) {
                    return $gallery->before_image_path ? '<a href="/' . $gallery->before_image_path . '" data-lightbox="gallery-before" data-title="' . e($gallery->treatment_type_en) . '"><img src="/' . $gallery->before_image_path . '" width="50"/></a>' : '';
                })
                ->editColumn('after_image_path', function ($gallery) {
                    return $gallery->after_image_path ? '<a href="/' . $gallery->after_image_path . '" data-lightbox="gallery-after" data-title="' . e($gallery->treatment_type_en) . '"><img src="/' . $gallery->after_image_path . '" width="50"/></a>' : '';
                })
                ->editColumn('is_active', function ($gallery) {
                    return $gallery->is_active ? '<span class="badge badge-success">' . __('common.active') . '</span>' : '<span class="badge badge-danger">' . __('common.inactive') . '</span>';
                })
                ->editColumn('created_at', function ($gallery) {
                    return $gallery->created_at->format('d.m.Y H:i:s');
                })
                ->rawColumns(['action', 'before_image_path', 'after_image_path', 'is_active'])
                ->make(true);
        }

        return view('admin.treatment-galleries.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.treatment-galleries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TreatmentGalleryRequest $request)
    {
        DB::beginTransaction();
        try {
            [$beforePath, $afterPath] = $this->handleImages($request);

            TreatmentGallery::create([
                'treatment_type_en' => $request->treatment_type_en,
                'treatment_type_tr' => $request->treatment_type_tr,
                'treatment_type_nl' => $request->treatment_type_nl,
                'before_image_path' => $beforePath,
                'after_image_path'  => $afterPath,
                'order'             => $request->order ?? 0,
                'is_active'         => $request->has('is_active'),
            ]);

            DB::commit();
            Log::info('Gallery item created by user: ' . auth()->id());
            return redirect()->route('admin.galleries.index')->with('success', __('common.created_successfully'));
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error creating gallery item: ' . $e->getMessage());
            return back()->withInput()->with('error', __('common.error_creating') . ' ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TreatmentGallery $gallery)
    {
        return view('admin.treatment-galleries.show', compact('gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TreatmentGallery $gallery)
    {
        return view('admin.treatment-galleries.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TreatmentGalleryRequest $request, TreatmentGallery $gallery)
    {
        DB::beginTransaction();
        try {
            [$beforePath, $afterPath] = $this->handleImages($request, $gallery);

            $gallery->update([
                'treatment_type_en' => $request->treatment_type_en,
                'treatment_type_tr' => $request->treatment_type_tr,
                'treatment_type_nl' => $request->treatment_type_nl,
                'before_image_path' => $beforePath,
                'after_image_path'  => $afterPath,
                'order'             => $request->order ?? 0,
                'is_active'         => $request->has('is_active'),
            ]);

            DB::commit();
            Log::info('Gallery item updated. id: ' . $gallery->id . '. By: ' . auth()->id());
            return redirect()->route('admin.galleries.index')->with('success', __('common.updated_successfully'));
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error updating gallery item: ' . $e->getMessage());
            return back()->withInput()->with('error', __('common.error_updating'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TreatmentGallery $gallery)
    {
        DB::beginTransaction();
        try {
            // delete images
            if ($gallery->before_image_path && File::exists(public_path($gallery->before_image_path))) {
                File::delete(public_path($gallery->before_image_path));
            }
            if ($gallery->after_image_path && File::exists(public_path($gallery->after_image_path))) {
                File::delete(public_path($gallery->after_image_path));
            }
            $gallery->delete();
            DB::commit();
            Log::info('Gallery item deleted. id: ' . $gallery->id . '. By: ' . auth()->id());
            return response()->json(['success' => true, 'message' => __('common.deleted_successfully')]);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error deleting gallery item: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => __('common.error_deleting') . ' ' . $e->getMessage()]);
        }
    }

    /**
     * Handle image upload logic.
     *
     * @param Request $request
     * @param TreatmentGallery|null $gallery
     * @return array [beforePath, afterPath]
     */
    private function handleImages(Request $request, ?TreatmentGallery $gallery = null): array
    {
        $beforePath = $gallery->before_image_path ?? null;
        $afterPath  = $gallery->after_image_path ?? null;

        $targetDir = $_SERVER['DOCUMENT_ROOT'] . '/images/gallery';
        if (!File::exists($targetDir)) {
            File::makeDirectory($targetDir, 0755, true);
        }

        if ($request->hasFile('before_image')) {
            if ($beforePath && File::exists(public_path($beforePath))) {
                File::delete(public_path($beforePath));
            }
            $beforeImage = $request->file('before_image');
            $beforeName  = uniqid() . '_' . time() . '_before.' . $beforeImage->getClientOriginalExtension();
            $beforeImage->move($targetDir, $beforeName);
            $beforePath = 'images/gallery/' . $beforeName;
        }

        if ($request->hasFile('after_image')) {
            if ($afterPath && File::exists(public_path($afterPath))) {
                File::delete(public_path($afterPath));
            }
            $afterImage = $request->file('after_image');
            $afterName  = uniqid() . '_' . time() . '_after.' . $afterImage->getClientOriginalExtension();
            $afterImage->move($targetDir, $afterName);
            $afterPath = 'images/gallery/' . $afterName;
        }

        return [$beforePath, $afterPath];
    }
}
