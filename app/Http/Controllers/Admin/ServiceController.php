<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Admin\ServiceRequest;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Service::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($service) {
                    $actions = '<div class="btn-group" role="group" aria-label="Basic example">';

                    if (auth()->user()->hasPermission('services.view')) {
                        $showUrl = route('admin.services.show', $service->id);
                        $actions .= '<a href="' . $showUrl . '" class="btn btn-primary btn-sm" title="' . __('common.view') . '"><i class="fas fa-eye"></i></a>';
                    }

                    if (auth()->user()->hasPermission('services.edit')) {
                        $editUrl = route('admin.services.edit', $service->id);
                        $actions .= ' <a href="' . $editUrl . '" class="btn btn-info btn-sm" title="' . __('common.edit') . '"><i class="fas fa-edit"></i></a>';
                    }

                    if (auth()->user()->hasPermission('services.delete')) {
                        $actions .= ' <button data-id="' . $service->id . '" class="btn btn-danger btn-sm delete-service" title="' . __('common.delete') . '"><i class="fas fa-trash"></i></button>';
                    }

                    $actions .= '</div>';

                    return $actions;
                })
                ->editColumn('short_description_en', function ($service) {
                    return Str::limit(strip_tags($service->short_description_en), 75, '...');
                })
                ->editColumn('short_description_tr', function ($service) {
                    return Str::limit(strip_tags($service->short_description_tr), 75, '...');
                })
                ->editColumn('short_description_nl', function ($service) {
                    return Str::limit(strip_tags($service->short_description_nl), 75, '...');
                })
                ->editColumn('is_active', function ($service) {
                    return $service->is_active ? '<span class="badge badge-success">' . __('common.active') . '</span>' : '<span class="badge badge-danger">' . __('common.inactive') . '</span>';
                })
                ->editColumn('created_at', function ($service) {
                    return $service->created_at->format('d.m.Y H:i:s');
                })
                ->rawColumns(['action', 'is_active'])
                ->make(true);
        }

        return view('admin.services.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServiceRequest $request)
    {
        DB::beginTransaction();
        try {
            $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');

                // Ensure folder exists
                $targetDir = $_SERVER['DOCUMENT_ROOT'] . '/images/services';
                if (!File::exists($targetDir)) {
                    File::makeDirectory($targetDir, 0755, true);
                }

                $imageName = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
                $image->move($targetDir, $imageName);
                $imagePath = 'images/services/' . $imageName;
            }

            $link = $request->link;
            if (!empty($link) && !preg_match("~^(?:f|ht)tps?://~i", $link)) {
                $link = "https://" . $link;
            }

            Service::create([
                'service_name_en' => $request->service_name_en,
                'service_name_tr' => $request->service_name_tr,
                'service_name_nl' => $request->service_name_nl,
                'image_path' => $imagePath,
                'short_description_en' => $request->short_description_en,
                'short_description_tr' => $request->short_description_tr,
                'short_description_nl' => $request->short_description_nl,
                'content_en' => $request->content_en,
                'content_tr' => $request->content_tr,
                'content_nl' => $request->content_nl,
                'link' => $link,
                'is_active' => $request->has('is_active'),
            ]);

            DB::commit();
            Log::info('Service record created. Created by: ' . auth()->id());

            return redirect()->route('admin.services.index')
                ->with('success', __('common.created_successfully'));
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error creating service record: ' . $e->getMessage());

            return back()->withInput()
                ->with('error', __('common.error_creating') . ' ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        return view('admin.services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServiceRequest $request, Service $service)
    {
        DB::beginTransaction();
        try {
            $imagePath = $service->image_path;
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($imagePath && File::exists(public_path($imagePath))) {
                    File::delete(public_path($imagePath));
                }

                $image = $request->file('image');

                // Ensure target directory exists
                $targetDir = public_path('images/services');
                if (!File::exists($targetDir)) {
                    File::makeDirectory($targetDir, 0755, true);
                }

                $imageName = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
                $image->move($targetDir, $imageName);
                $imagePath = 'images/services/' . $imageName;
            }
            $link = $request->link;
            if (!empty($link) && !preg_match("~^(?:f|ht)tps?://~i", $link)) {
                $link = "https://" . $link;
            }

            $service->update([
                'service_name_en' => $request->service_name_en,
                'service_name_tr' => $request->service_name_tr,
                'service_name_nl' => $request->service_name_nl,
                'image_path' => $imagePath,
                'short_description_en' => $request->short_description_en,
                'short_description_tr' => $request->short_description_tr,
                'short_description_nl' => $request->short_description_nl,
                'content_en' => $request->content_en,
                'content_tr' => $request->content_tr,
                'content_nl' => $request->content_nl,
                'link' => $link,
                'is_active' => $request->has('is_active'),
            ]);

            DB::commit();
            Log::info('Service record updated. Service->id: ' . $service->id . '. Updated by: ' . auth()->id());

            return redirect()->route('admin.services.index')
                ->with('success', __('common.updated_successfully'));
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error updating service record: ' . $e->getMessage());

            return back()->withInput()
                ->with('error', __('common.error_updating'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        DB::beginTransaction();
        try {
            // Delete image file
            if ($service->image_path && File::exists(public_path($service->image_path))) {
                File::delete(public_path($service->image_path));
            }
            $service->delete();

            DB::commit();
            Log::info('Service record deleted. Service->id: ' . $service->id . '. Deleted by: ' . auth()->id());
            return response()->json(['success' => true, 'message' => __('common.deleted_successfully')]);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error deleting service record: ' . $e->getMessage());

            return response()->json(['success' => false, 'message' => __('common.error_deleting') . ' ' . $e->getMessage()]);
        }
    }
}
