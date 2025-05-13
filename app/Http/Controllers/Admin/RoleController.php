<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\LogHelper;
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

            // Log successful role creation using LogHelper
            LogHelper::logDbOperation(
                'create',
                'Role',
                [
                    'role_id' => $role->id,
                    'role_name' => $role->name,
                    'role_display_name' => $role->display_name
                ]
            );

            return redirect()->route('admin.roles.index')
                ->with('success', __('roles.role_created'));
        } catch (\Exception $e) {
            DB::rollBack();

            // Log error using LogHelper
            LogHelper::logDbOperation(
                'create',
                'Role',
                ['input' => $request->all()],
                false,
                $e->getMessage()
            );

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

            // Log successful role update using LogHelper
            LogHelper::logDbOperation(
                'update',
                'Role',
                [
                    'role_id' => $role->id,
                    'old_values' => $oldValues,
                    'new_values' => $role->only(['name', 'display_name', 'description', 'color'])
                ]
            );

           return redirect()->route('admin.roles.index')
                ->with('success', __('roles.role_updated'));
        } catch (\Exception $e) {
            DB::rollBack();

            // Log error using LogHelper
            LogHelper::logDbOperation(
                'update',
                'Role',
                [
                    'role_id' => $role->id,
                    'input' => $request->all()
                ],
                false,
                $e->getMessage()
            );

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

                // Log failed deletion due to associated users using LogHelper
                LogHelper::logDbOperation(
                    'delete',
                    'Role',
                    [
                        'role_id' => $role->id,
                        'role_name' => $role->name,
                        'user_count' => $userCount
                    ],
                    false,
                    'Role has associated users'
                );

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

            // Log successful role deletion using LogHelper
            LogHelper::logDbOperation(
                'delete',
                'Role',
                ['deleted_role' => $roleInfo]
            );

            return response()->json([
                'success' => true,
                'message' => __('roles.role_deleted'),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            // Log error using LogHelper
            LogHelper::logDbOperation(
                'delete',
                'Role',
                ['role_id' => $role->id],
                false,
                $e->getMessage()
            );

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
