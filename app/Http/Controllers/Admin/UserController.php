<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\StoreUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;
use App\Helpers\LogHelper;
use ToastMagic;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        $roles = Role::all();
        if (request()->ajax()) {
            return $this->getData();
        }

        return view('admin.users.index', compact('roles'));
    }

    /**
     * Get users data for DataTables.
     */
    public function getData()
    {
        $users = User::with('roles')->select('users.*');

        // Apply role filter if provided
        if (request()->has('role') && !empty(request('role'))) {
            $users->whereHas('roles', function($q) {
                $q->where('id', request('role'));
            });
        }

        return DataTables::of($users)
            ->addColumn('role', function ($user) {
                $badges = '';
                foreach($user->roles as $role) {
                    $badges .= '<span class="badge bg-'.$role->color.'">'.$role->display_name.'</span> ';
                }
                return $badges;
            })
            ->editColumn('created_at', function ($user) {
                return Carbon::parse($user->created_at)->format('d.m.Y H:i');
            })
            ->addColumn('action', function ($user) {
                $actions = '<div class="btn-group">';

                if (auth()->user()->hasPermission('users.view')) {
                    $showUrl = route('admin.users.show', $user->id);
                    $actions .= '<a href="' . $showUrl . '" class="btn btn-primary btn-sm" title="' . __('users.view') . '"><i class="fas fa-eye"></i></a>';
                }

                if (auth()->user()->hasPermission('users.edit')) {
                    $editUrl = route('admin.users.edit', $user->id);
                    $actions .= ' <a href="' . $editUrl . '" class="btn btn-info btn-sm" title="' . __('users.edit') . '"><i class="fas fa-edit"></i></a>';
                }

                if (auth()->user()->hasPermission('users.delete')) {
                    $actions .= ' <button data-id="' . $user->id . '" class="btn btn-danger btn-sm delete-user" title="' . __('users.delete') . '"><i class="fas fa-trash"></i></button>';
                }

                $actions .= '</div>';

                return $actions;
            })
            ->rawColumns(['action', 'role'])
            ->make(true);
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(StoreUserRequest $request)
    {
        try {
            DB::beginTransaction();

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $user->syncRoles($request->roles);

            DB::commit();

            // Log successful user creation using LogHelper
            LogHelper::logDbOperation(
                'create',
                'User',
                [
                    'created_user_id' => $user->id,
                    'created_user_email' => $user->email,
                    'roles' => $request->roles
                ]
            );

            return redirect()->route('admin.users.index')
                ->with('success', __('users.created_successfully'));
        } catch (\Exception $e) {
            DB::rollback();

            // Log error using LogHelper
            LogHelper::logDbOperation(
                'create',
                'User',
                ['input' => $request->except('password')],
                false,
                $e->getMessage()
            );

            return back()->withInput()
                ->with('error', __('users.error_creating') . ' ' . $e->getMessage());
        }
    }

    /**
     * Display the specified user.
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $userRoles = $user->roles->pluck('id')->toArray();
        return view('admin.users.edit', compact('user', 'roles', 'userRoles'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            DB::beginTransaction();

            $userData = [
                'name' => $request->name,
                'email' => $request->email,
            ];

            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->password);
            }

            $user->update($userData);
            $user->syncRoles($request->roles);

            DB::commit();

            // Log successful user update using LogHelper
            LogHelper::logDbOperation(
                'update',
                'User',
                [
                    'updated_user_id' => $user->id,
                    'updated_user_email' => $user->email,
                    'updated_fields' => array_keys($userData),
                    'roles_updated' => $request->roles
                ]
            );

            return redirect()->route('admin.users.index')
                ->with('success', __('users.updated_successfully'));
        } catch (\Exception $e) {
            DB::rollback();

            // Log error using LogHelper
            LogHelper::logDbOperation(
                'update',
                'User',
                [
                    'updated_user_id' => $user->id,
                    'input' => $request->except('password')
                ],
                false,
                $e->getMessage()
            );

            return back()->withInput()
                ->with('error', __('users.error_updating'));
        }
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        try {
            DB::beginTransaction();

            $deletedUserInfo = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'roles' => $user->roles()->pluck('name')->toArray()
            ];

            $user->delete();
            DB::commit();

            // Log successful user deletion using LogHelper
            LogHelper::logDbOperation(
                'delete',
                'User',
                ['deleted_user' => $deletedUserInfo]
            );

            return response()->json(['success' => true, 'message' => __('users.deleted_successfully')]);
        } catch (\Exception $e) {
            DB::rollback();

            // Log error using LogHelper
            LogHelper::logDbOperation(
                'delete',
                'User',
                ['deleted_user_id' => $user->id],
                false,
                $e->getMessage()
            );

            return response()->json(['success' => false, 'message' => __('users.error_deleting') . ' ' . $e->getMessage()]);
        }
    }
}
