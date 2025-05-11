<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AssignPermissionRoleRequest;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\LogHelper;

class PermissionController extends Controller
{

    /**
     * Display a listing of the permissions.
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new permission.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.permissions.create', compact('roles'));
    }

    /**
     * Store a newly created permission in storage.
     */
    public function store(StorePermissionRequest $request)
    {
        try {
            DB::beginTransaction();

            $permission = new Permission();
            $permission->name = $request->name;
            $permission->display_name = $request->display_name;
            $permission->description = $request->description;
            // Color is automatically assigned in the Permission model boot method
            $permission->save();

            // Attach roles to permission if selected
            $attachedRoles = [];
            if ($request->has('roles') && is_array($request->roles)) {
                $permission->roles()->sync($request->roles);
                $attachedRoles = Role::whereIn('id', $request->roles)->pluck('name')->toArray();
            }

            DB::commit();

            // Log successful permission creation using LogHelper
            LogHelper::logDbOperation(
                'create',
                'Permission',
                [
                    'permission_id' => $permission->id,
                    'permission_name' => $permission->name,
                    'attached_roles' => $attachedRoles
                ]
            );

            return redirect()->route('admin.permissions.index')->with('success', __('permissions.permission_created'));
        } catch (\Exception $e) {
            DB::rollBack();

            // Log error using LogHelper
            LogHelper::logDbOperation(
                'create',
                'Permission',
                ['input' => $request->all()],
                false,
                $e->getMessage()
            );

            return redirect()->back()->with('error', __('permissions.error_occurred'))->withInput();
        }
    }

    /**
     * Display the specified permission.
     */
    public function show(Permission $permission)
    {
        $permission->load('roles');
        return view('admin.permissions.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified permission.
     */
    public function edit(Permission $permission)
    {
        $roles = Role::all();
        $selectedRoles = $permission->roles->pluck('id')->toArray();
        return view('admin.permissions.edit', compact('permission', 'roles', 'selectedRoles'));
    }

    /**
     * Update the specified permission in storage.
     */
    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        try {
            DB::beginTransaction();

            $oldValues = [
                'name' => $permission->name,
                'display_name' => $permission->display_name,
                'description' => $permission->description,
            ];

            $oldRoles = $permission->roles()->pluck('name')->toArray();

            $permission->update([
                'name' => $request->name,
                'display_name' => $request->display_name,
                'description' => $request->description,
            ]);

            // Sync roles
            $newRoles = [];
            if ($request->has('roles')) {
                $permission->roles()->sync($request->roles);
                $newRoles = Role::whereIn('id', $request->roles)->pluck('name')->toArray();
            } else {
                $permission->roles()->detach();
            }

            DB::commit();

            // Log successful permission update using LogHelper
            LogHelper::logDbOperation(
                'update',
                'Permission',
                [
                    'permission_id' => $permission->id,
                    'old_values' => $oldValues,
                    'new_values' => $permission->only(['name', 'display_name', 'description']),
                    'old_roles' => $oldRoles,
                    'new_roles' => $newRoles
                ]
            );

            return redirect()->route('admin.permissions.index')->with('success', __('permissions.permission_updated'));
        } catch (\Exception $e) {
            DB::rollBack();

            // Log error using LogHelper
            LogHelper::logDbOperation(
                'update',
                'Permission',
                [
                    'permission_id' => $permission->id,
                    'input' => $request->all()
                ],
                false,
                $e->getMessage()
            );

            return redirect()->back()->with('error', __('permissions.error_occurred'))->withInput();
        }
    }

    /**
     * Remove the specified permission from storage.
     */
    public function destroy(Permission $permission)
    {
        try {
            DB::beginTransaction();

            // Check if the permission is assigned to any roles
            $roleCount = $permission->roles()->count();
            if ($roleCount > 0) {
                DB::rollBack();

                // Log failed deletion due to associated roles using LogHelper
                LogHelper::logDbOperation(
                    'delete',
                    'Permission',
                    [
                        'permission_id' => $permission->id,
                        'permission_name' => $permission->name,
                        'role_count' => $roleCount,
                        'roles' => $permission->roles()->pluck('name')->toArray()
                    ],
                    false,
                    'Permission has associated roles'
                );

                return response()->json([
                    'success' => false,
                    'message' => __('permissions.delete_error_roles'),
                ]);
            }

            // Save permission info before deletion for logging
            $permissionInfo = [
                'id' => $permission->id,
                'name' => $permission->name,
                'display_name' => $permission->display_name
            ];

            $permission->delete();

            DB::commit();

            // Log successful permission deletion using LogHelper
            LogHelper::logDbOperation(
                'delete',
                'Permission',
                ['deleted_permission' => $permissionInfo]
            );

            return response()->json([
                'success' => true,
                'message' => __('permissions.permission_deleted'),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            // Log error using LogHelper
            LogHelper::logDbOperation(
                'delete',
                'Permission',
                ['permission_id' => $permission->id],
                false,
                $e->getMessage()
            );

            return response()->json([
                'success' => false,
                'message' => __('permissions.error_occurred'),
            ]);
        }
    }

    /**
     * Get permissions data for DataTables.
     */
    public function getData()
    {
        $permissions = Permission::select([
            'id',
            'name',
            'display_name',
            'description',
            'color',
            DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y %H:%i:%s") as created_at'),
            DB::raw('DATE_FORMAT(updated_at, "%d-%m-%Y %H:%i:%s") as updated_at')
        ]);

        return datatables()->of($permissions)
            ->addColumn('permission_badge', function ($permission) {
                return '<span class="badge bg-'.$permission->color.'">'.$permission->display_name.'</span>';
            })
            ->addColumn('actions', function ($permission) {
                return view('admin.permissions.partials.actions', compact('permission'));
            })
            ->editColumn('created_at', function ($permission) {
                return $permission->created_at;
            })
            ->editColumn('updated_at', function ($permission) {
                return $permission->updated_at;
            })
            ->rawColumns(['actions', 'permission_badge'])
            ->toJson();
    }

    /**
     * Show the form for assigning permissions to a role.
     */
    public function assignRoleForm()
    {
        $roles = Role::all();

        // Get all permissions and group them by module
        $permissions = Permission::all();
        $groupedPermissions = [];

        foreach ($permissions as $permission) {
            // Extract module name from permission name (e.g., users.view => users)
            $module = strstr($permission->name, '.', true);
            if (!$module) {
                $module = 'other'; // fallback for permissions without dot notation
            }

            if (!isset($groupedPermissions[$module])) {
                // Initialize the module group with a translated name
                $translatedModule = __('permissions.' . $module);
                $groupedPermissions[$module] = [
                    'name' => $translatedModule ?? ucfirst($module),
                    'permissions' => []
                ];
            }

            // Add permission to its module group
            $groupedPermissions[$module]['permissions'][] = $permission;
        }

        // Sort modules alphabetically
        ksort($groupedPermissions);

        return view('admin.permissions.assign', compact('roles', 'groupedPermissions'));
    }

    /**
     * Get permissions for a specific role (AJAX request).
     */
    public function getPermissionsByRole(Request $request)
    {
        $roleId = $request->input('role_id');
        $role = Role::findOrFail($roleId);

        $assignedPermissions = $role->permissions->pluck('id')->toArray();

        return response()->json([
            'success' => true,
            'assignedPermissions' => $assignedPermissions,
        ]);
    }

    /**
     * Assign permissions to a role.
     */
    public function assignPermissionsToRole(AssignPermissionRoleRequest $request)
    {
        try {
            DB::beginTransaction();

            $role = Role::findOrFail($request->role_id);
            $role->permissions()->sync($request->permission_ids);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => __('permissions.permissions_assigned'),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => __('permissions.error_occurred'),
            ]);
        }
    }
}
