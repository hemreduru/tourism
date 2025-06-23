<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FaqStoreRequest;
use App\Http\Requests\Admin\FaqUpdateRequest;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use DataTables;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Faq::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('is_active', function ($faq) {
                    return $faq->is_active ? '<span class="badge badge-success">' . __('common.active') . '</span>' : '<span class="badge badge-danger">' . __('common.inactive') . '</span>';
                })
                ->editColumn('created_at', function ($faq) {
                    return $faq->created_at?->format('d.m.Y H:i:s');
                })
                ->addColumn('action', function ($faq) {
                    $actions = '<div class="btn-group" role="group">';
                    if (auth()->user()->hasPermission('faqs.edit')) {
                        $actions .= '<a href="' . route('admin.faqs.edit', $faq->id) . '" class="btn btn-info btn-sm" title="' . __('common.edit') . '"><i class="fas fa-edit"></i></a>';
                    }
                    if (auth()->user()->hasPermission('faqs.delete')) {
                        $actions .= '<button data-id="' . $faq->id . '" class="btn btn-danger btn-sm delete-faq" title="' . __('common.delete') . '"><i class="fas fa-trash"></i></button>';
                    }
                    $actions .= '</div>';
                    return $actions;
                })
                ->rawColumns(['is_active', 'action'])
                ->make(true);
        }
        return view('admin.faqs.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.faqs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FaqStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $validatedData = $request->validated();
            $validatedData['is_active'] = $request->has('is_active');
            Faq::create($validatedData);
            DB::commit();
            return redirect()->route('admin.faqs.index')
                ->with('success', __('common.created_successfully'));
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('FAQ create error: ' . $e->getMessage());
            return back()->withInput()->with('error', __('common.error_creating') . ' ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Faq $faq): View
    {
        return view('admin.faqs.edit', compact('faq'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Faq $faq): View
    {
        return view('admin.faqs.show', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FaqUpdateRequest $request, Faq $faq)
    {
        DB::beginTransaction();
        try {
            $validatedData = $request->validated();
            $validatedData['is_active'] = $request->has('is_active');
            $faq->update($validatedData);
            DB::commit();
            return redirect()->route('admin.faqs.index')
                ->with('success', __('common.updated_successfully'));
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('FAQ update error: ' . $e->getMessage());
            return back()->withInput()->with('error', __('common.error_updating') . ' ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faq $faq)
    {
        DB::beginTransaction();
        try {
            $faq->delete();
            DB::commit();
            return response()->json(['success' => true, 'message' => __('common.deleted_successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('FAQ delete error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => __('common.error_deleting') . ' ' . $e->getMessage()]);
        }
    }
}
