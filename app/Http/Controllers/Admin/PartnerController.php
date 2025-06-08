<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Admin\PartnerRequest;
use Illuminate\Support\Str;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Partner::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($partner) {
                    $actions = '<div class="btn-group" role="group" aria-label="Basic example">';

                    if (auth()->user()->hasPermission('partners.view')) {
                        $showUrl = route('admin.partners.show', $partner->id);
                        $actions .= '<a href="' . $showUrl . '" class="btn btn-primary btn-sm" title="' . __('common.view') . '"><i class="fas fa-eye"></i></a>';
                    }

                    if (auth()->user()->hasPermission('partners.edit')) {
                        $editUrl = route('admin.partners.edit', $partner->id);
                        $actions .= ' <a href="' . $editUrl . '" class="btn btn-info btn-sm" title="' . __('common.edit') . '"><i class="fas fa-edit"></i></a>';
                    }

                    if (auth()->user()->hasPermission('partners.delete')) {
                        $actions .= ' <button data-id="' . $partner->id . '" class="btn btn-danger btn-sm delete-partner" title="' . __('common.delete') . '"><i class="fas fa-trash"></i></button>';
                    }

                    $actions .= '</div>';

                    return $actions;
                })
                ->editColumn('description_en', function ($partner) {
                    return Str::limit(strip_tags($partner->description_en), 75, '...');
                })
                ->editColumn('description_tr', function ($partner) {
                    return Str::limit(strip_tags($partner->description_tr), 75, '...');
                })
                ->editColumn('description_nl', function ($partner) {
                    return Str::limit(strip_tags($partner->description_nl), 75, '...');
                })
                ->editColumn('is_active', function ($partner) {
                    return $partner->is_active ? '<span class="badge badge-success">' . __('common.active') . '</span>' : '<span class="badge badge-danger">' . __('common.inactive') . '</span>';
                })
                ->editColumn('created_at', function ($partner) {
                    return $partner->created_at->format('d.m.Y H:i:s');
                })
                ->rawColumns(['action', 'is_active'])
                ->make(true);
        }

        return view('admin.partners.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.partners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PartnerRequest $request)
    {
        DB::beginTransaction();
        try {
            $logoPath = null;
            if ($request->hasFile('logo')) {
                $logo = $request->file('logo');
                $logoName = time() . '.' . $logo->getClientOriginalExtension();
                $logo->move(public_path('images/partners'), $logoName);
                $logoPath = 'images/partners/' . $logoName;
            }

            $website = $request->website;
            if (!empty($website) && !preg_match("~^(?:f|ht)tps?://~i", $website)) {
                $website = "https://" . $website;
            }

            Partner::create([
                'company_name_en' => $request->company_name_en,
                'company_name_tr' => $request->company_name_tr,
                'company_name_nl' => $request->company_name_nl,
                'logo_path' => $logoPath,
                'description_en' => $request->description_en,
                'description_tr' => $request->description_tr,
                'description_nl' => $request->description_nl,
                'website' => $website,
                'order' => $request->order ?? 0,
                'is_active' => $request->has('is_active'),
            ]);

            DB::commit();
            Log::info('Partner record created. Created by: ' . auth()->id());

            return redirect()->route('admin.partners.index')
                ->with('success', __('common.created_successfully'));
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error creating partner record: ' . $e->getMessage());

            return back()->withInput()
                ->with('error', __('common.error_creating') . ' ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Partner $partner)
    {
        return view('admin.partners.show', compact('partner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partner $partner)
    {
        return view('admin.partners.edit', compact('partner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PartnerRequest $request, Partner $partner)
    {
        DB::beginTransaction();
        try {
            $logoPath = $partner->logo_path;
            if ($request->hasFile('logo')) {
                // Delete old logo if exists
                if ($logoPath && File::exists(public_path($logoPath))) {
                    File::delete(public_path($logoPath));
                }
                $logo = $request->file('logo');
                $logoName = time() . '.' . $logo->getClientOriginalExtension();
                $logo->move(public_path('images/partners'), $logoName);
                $logoPath = 'images/partners/' . $logoName;
            }

            $website = $request->website;
            if (!empty($website) && !preg_match("~^(?:f|ht)tps?://~i", $website)) {
                $website = "https://" . $website;
            }

            $partner->update([
                'company_name_en' => $request->company_name_en,
                'company_name_tr' => $request->company_name_tr,
                'company_name_nl' => $request->company_name_nl,
                'logo_path' => $logoPath,
                'description_en' => $request->description_en,
                'description_tr' => $request->description_tr,
                'description_nl' => $request->description_nl,
                'website' => $website,
                'order' => $request->order ?? 0,
                'is_active' => $request->has('is_active'),
            ]);

            DB::commit();
            Log::info('Partner record updated. Partner->id: ' . $partner->id . '. Updated by: ' . auth()->id());

            return redirect()->route('admin.partners.index')
                ->with('success', __('common.updated_successfully'));
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error updating partner record: ' . $e->getMessage());

            return back()->withInput()
                ->with('error', __('common.error_updating'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partner $partner)
    {
        DB::beginTransaction();
        try {
            // Delete logo file
            if ($partner->logo_path && File::exists(public_path($partner->logo_path))) {
                File::delete(public_path($partner->logo_path));
            }
            $partner->delete();

            DB::commit();
            Log::info('Partner record deleted. Partner->id: ' . $partner->id . '. Deleted by: ' . auth()->id());
            return response()->json(['success' => true, 'message' => __('common.deleted_successfully')]);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error deleting partner record: ' . $e->getMessage());

            return response()->json(['success' => false, 'message' => __('common.error_deleting') . ' ' . $e->getMessage()]);
        }
    }
}
