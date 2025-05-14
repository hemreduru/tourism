<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use ToastMagic;

class RoleController extends Controller
{
    /**
     * Display a listing of the roles.
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new role.
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created role in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        try {
            DB::beginTransaction();

            $role = new Role();
            $role->name = $request->name;
            $role->display_name = $request->display_name;
            $role->description = $request->description;
            $role->color = $request->color;
            $role->save();

            DB::commit();

            Log::info('Role created. Role->id: ' . $role->id . '. Created by: ' . auth()->id());

            return redirect()->route('admin.roles.index')
                ->with('success', __('roles.role_created'));
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Role failed while creating. Error: ' . $e->getMessage() . '. By: ' . auth()->id());

           return redirect()->back()->with('error', __('roles.error_occurred'))->withInput();
        }
    }

    /**
     * Display the specified role.
     */
    public function show(Role $role)
    {
        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified role.
     */
    public function edit(Role $role)
    {
        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified role in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        try {
            DB::beginTransaction();

            $oldValues = [
                'name' => $role->name,
                'display_name' => $role->display_name,
                'description' => $role->description,
                'color' => $role->color
            ];

            $role->update([
                'name' => $request->name,
                'display_name' => $request->display_name,
                'description' => $request->description,
                'color' => $request->color,
            ]);

            DB::commit();

            Log::info('Role updated. Role->id: ' . $role->id . '. Updated by: ' . auth()->id());

           return redirect()->route('admin.roles.index')
                ->with('success', __('roles.role_updated'));
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Role failed while updating. Error: ' . $e->getMessage() . '. By: ' . auth()->id());

           return redirect()->back()->with('error', __('roles.error_occurred'))->withInput();
        }
    }

    /**
     * Remove the specified role from storage.
     */
    public function destroy(Role $role)
    {
        try {
            DB::beginTransaction();

            // Check if the role is associated with any users
            $userCount = $role->users()->count();

            if ($userCount > 0) {
                DB::rollBack();

                Log::warning('Role failed while deleting - has users. Role->id: ' . $role->id . '. By: ' . auth()->id());

                return response()->json([
                    'success' => false,
                    'message' => __('roles.delete_error_users'),
                ]);
            }

            // Save role info before deletion for logging
            $roleInfo = [
                'id' => $role->id,
                'name' => $role->name,
                'display_name' => $role->display_name
            ];

            $role->delete();

            DB::commit();

            Log::info('Role deleted. Role->id: ' . $roleInfo['id'] . '. Deleted by: ' . auth()->id());

            return response()->json([
                'success' => true,
                'message' => __('roles.role_deleted'),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Role deletion failed. Error: ' . $e->getMessage() . '. User ID: ' . auth()->id());

            return response()->json([
                'success' => false,
                'message' => __('roles.error_occurred'),
            ]);
        }
    }

    /**
     * Get roles data for DataTables.
     */
   public function getData()
    {
        $roles = Role::select([
            'id',
            'name',
            'display_name',
            'description',
            'color',
            DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y %H:%i:%s") as created_at'),
            DB::raw('DATE_FORMAT(updated_at, "%d-%m-%Y %H:%i:%s") as updated_at')
        ]);

        return datatables()->of($roles)
            ->addColumn('role_badge', function ($role) {
                return '<span class="badge bg-'.$role->color.'">'.$role->display_name.'</span>';
            })
            ->addColumn('actions', function ($role) {
                return view('admin.roles.partials.actions', compact('role'));
            })
            ->editColumn('created_at', function ($role) {
                return $role->created_at;
            })
            ->editColumn('updated_at', function ($role) {
                return $role->updated_at;
            })
            ->rawColumns(['actions', 'role_badge'])
            ->toJson();
    }
}
