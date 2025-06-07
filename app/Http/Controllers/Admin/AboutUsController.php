<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAboutUsRequest;
use App\Http\Requests\UpdateAboutUsRequest;
use App\Models\AboutUs;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;
use ToastMagic;

class AboutUsController extends Controller
{
    public function __construct()
    {
        // Middleware definitions will be moved to routes/web.php
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            return $this->getData();
        }
        return view('admin.about_us.index');
    }

    /**
     * Get about us data for DataTables.
     */
    public function getData()
    {
        $aboutUs = AboutUs::select('*');

        return DataTables::of($aboutUs)
            ->addColumn('action', function ($aboutUs) {
                $actions = '<div class="btn-group">';

                if (auth()->user()->hasPermission('about_us.view')) {
                    $showUrl = route('admin.about_us.show', $aboutUs->id);
                    $actions .= '<a href="' . $showUrl . '" class="btn btn-primary btn-sm" title="' . __('common.view') . '"><i class="fas fa-eye"></i></a>';
                }

                if (auth()->user()->hasPermission('about_us.edit')) {
                    $editUrl = route('admin.about_us.edit', $aboutUs->id);
                    $actions .= ' <a href="' . $editUrl . '" class="btn btn-info btn-sm" title="' . __('common.edit') . '"><i class="fas fa-edit"></i></a>';
                }

                if (auth()->user()->hasPermission('about_us.delete')) {
                    $actions .= ' <button data-id="' . $aboutUs->id . '" class="btn btn-danger btn-sm delete-about-us" title="' . __('common.delete') . '"><i class="fas fa-trash"></i></button>';
                }

                $actions .= '</div>';

                return $actions;
            })
            ->editColumn('is_active', function ($aboutUs) {
                return $aboutUs->is_active ? '<span class="badge badge-success">' . __('common.active') . '</span>' : '<span class="badge badge-danger">' . __('common.inactive') . '</span>';
            })
            ->editColumn('created_at', function ($aboutUs) {
                return $aboutUs->created_at->format('d.m.Y H:i:s');
            })
            ->rawColumns(['action', 'is_active'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.about_us.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAboutUsRequest $request)
    {
        try {
            DB::beginTransaction();

            AboutUs::create($request->validated());

            DB::commit();

            Log::info('About Us record created. Created by: ' . auth()->id());

            return redirect()->route('admin.about_us.index')
                ->with('success', __('common.created_successfully'));
        } catch (\Exception $e) {
            DB::rollback();

            Log::error('About Us record failed while creating. Error: ' . $e->getMessage() . '. By: ' . auth()->id());

            return back()->withInput()
                ->with('error', __('common.error_creating') . ' ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(AboutUs $aboutUs)
    {
        return view('admin.about_us.show', compact('aboutUs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AboutUs $aboutUs)
    {
        return view('admin.about_us.edit', compact('aboutUs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAboutUsRequest $request, AboutUs $aboutUs)
    {
        try {
            DB::beginTransaction();

            $aboutUs->update($request->validated());

            DB::commit();

            Log::info('About Us record updated. AboutUs->id: ' . $aboutUs->id . '. Updated by: ' . auth()->id());

            return redirect()->route('admin.about_us.index')
                ->with('success', __('common.updated_successfully'));
        } catch (\Exception $e) {
            DB::rollback();

            Log::error('About Us record failed while updating. Error: ' . $e->getMessage() . '. By: ' . auth()->id());
            return back()->withInput()
                ->with('error', __('common.error_updating'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AboutUs $aboutUs)
    {
        try {
            DB::beginTransaction();

            $aboutUs->delete();
            DB::commit();

            Log::info('About Us record deleted. AboutUs->id: ' . $aboutUs->id . '. Deleted by: ' . auth()->id());
            return response()->json(['success' => true, 'message' => __('common.deleted_successfully')]);
        } catch (\Exception $e) {
            DB::rollback();

            Log::error('About Us record failed while deleting. Error: ' . $e->getMessage() . '. By: ' . auth()->id());

            return response()->json(['success' => false, 'message' => __('common.error_deleting') . ' ' . $e->getMessage()]);
        }
    }
}
