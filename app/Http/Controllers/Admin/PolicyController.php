<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PolicyRequest;
use App\Models\Policy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class PolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Policy::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($policy) {
                    $actions = '<div class="btn-group" role="group">';

                    if (auth()->user()->hasPermission('policies.view')) {
                        $actions .= '<a href="' . route('admin.policies.show', $policy->id) . '" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>';
                    }
                    if (auth()->user()->hasPermission('policies.edit')) {
                        $actions .= ' <a href="' . route('admin.policies.edit', $policy->id) . '" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>';
                    }
                    if (auth()->user()->hasPermission('policies.delete')) {
                        $actions .= ' <button data-id="' . $policy->id . '" class="btn btn-danger btn-sm delete-policy"><i class="fas fa-trash"></i></button>';
                    }
                    $actions .= '</div>';

                    return $actions;
                })
                ->editColumn('content_en', function ($policy) {
                    return Str::limit(strip_tags($policy->content_en), 75, '...');
                })
                ->editColumn('type', function ($policy) {
                    return __('policies.' . $policy->type);
                })
                ->editColumn('is_active', function ($policy) {
                    return $policy->is_active ? '<span class="badge badge-success">' . __('common.active') . '</span>' : '<span class="badge badge-danger">' . __('common.inactive') . '</span>';
                })
                ->editColumn('created_at', function ($policy) {
                    return $policy->created_at->format('d.m.Y H:i:s');
                })
                ->rawColumns(['action','is_active'])
                ->make(true);
        }

        return view('admin.policies.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.policies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PolicyRequest $request)
    {
        DB::beginTransaction();
        try {
            Policy::create([
                'type'        => $request->type,
                'title_en'    => $request->title_en,
                'title_tr'    => $request->title_tr,
                'title_nl'    => $request->title_nl,
                'content_en'  => $request->content_en,
                'content_tr'  => $request->content_tr,
                'content_nl'  => $request->content_nl,
                'is_active'   => $request->has('is_active'),
            ]);
            DB::commit();
            Log::info('Policy created by user ' . auth()->id());
            return redirect()->route('admin.policies.index')->with('success', __('common.created_successfully'));
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Policy create error: ' . $e->getMessage());
            return back()->withInput()->with('error', __('common.error_creating'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Policy $policy)
    {
        return view('admin.policies.show', compact('policy'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Policy $policy)
    {
        return view('admin.policies.edit', compact('policy'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PolicyRequest $request, Policy $policy)
    {
        DB::beginTransaction();
        try {
            $policy->update([
                'type'        => $request->type,
                'title_en'    => $request->title_en,
                'title_tr'    => $request->title_tr,
                'title_nl'    => $request->title_nl,
                'content_en'  => $request->content_en,
                'content_tr'  => $request->content_tr,
                'content_nl'  => $request->content_nl,
                'is_active'   => $request->has('is_active'),
            ]);
            DB::commit();
            Log::info('Policy updated. ID ' . $policy->id . ' by user ' . auth()->id());
            return redirect()->route('admin.policies.index')->with('success', __('common.updated_successfully'));
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Policy update error: ' . $e->getMessage());
            return back()->withInput()->with('error', __('common.error_updating'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Policy $policy)
    {
        try {
            $policy->delete();
            return response()->json(['success' => true, 'message' => __('common.deleted_successfully')]);
        } catch (\Throwable $e) {
            Log::error('Policy delete error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => __('common.error_deleting')]);
        }
    }
}
