<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRoleRequest;
use Illuminate\Http\RedirectResponse;

class RolesAndPermissionController extends Controller
{
    
    public function index()
    {
        $breadcrumbsItems = [
            [
                'name'      => 'Settings',
                'url'       => route('settings.index'),
                'active'    => false
            ],
            [
                'name'      => 'Roles',
                'url'       => route('settings.roles.index'),
                'active'    => true
            ],
        ];
        
        return view('settings.roles.index',[
            'breadcrumbItems'   => $breadcrumbsItems,
            'pageTitle'         => 'Roles',
            'roles'             => Role::latest()->get(['id','name','guard_name'])
        ]);
    }

    public function permissionIndex(Request $request)
    {
        $breadcrumbsItems = [
            [
                'name'      => 'Settings',
                'url'       => route('settings.index'),
                'active'    => false
            ],
            [
                'name'      => 'Permissions',
                'url'       => route('settings.roles.permissions.index'),
                'active'    => true
            ],
        ];

        return view('settings.permissions.index', [
            'breadcrumbItems'   => $breadcrumbsItems,
            'pageTitle'         => 'Permissions',
            'permissions'       => Permission::latest()->get(['id','name','guard_name'])
        ]);
    }


    public function create()
    {
        $breadcrumbsItems = [
            [
                'name' => 'Roles',
                'url' => route('settings.roles.index'),
                'active' => false
            ],
            [
                'name' => 'Create',
                'url' => route('settings.roles.create'),
                'active' => true
            ],
        ];

        $permissionModules = Permission::all()->groupBy('module_name');

        return view('settings.roles.create', [
            'breadcrumbItems' => $breadcrumbsItems,
            'permissionModules' => $permissionModules,
            'pageTitle' => 'Create Role'
        ]);
    }
 /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRoleRequest  $request
     * @return RedirectResponse
     */
    public function store(StoreRoleRequest $request)
    {
        $createdRole = Role::create(['name' => $request->validated('name')]);
        $createdRole->syncPermissions($request->validated('permissions'));

        return to_route('settings.roles.index')->with('message', 'Role created successfully');
    }

    public function edit(Role $role)
    
    {
       
            $breadcrumbsItems = [
                ['name' => 'Roles', 'url' => route('settings.roles.index'), 'active' => false],
                ['name' => 'Edit', 'url' => '#', 'active' => true],
            ];
      
        $permissionModules = Permission::all()->groupBy('module_name');
        return view('settings.roles.edit', [
            'role'              => $role,
            'role_permissions'  => $role->permissions->pluck('name')->toArray(),
            'permissions'       => Permission::get(),
            'breadcrumbItems' => $breadcrumbsItems,
            'pageTitle' => 'Edit Role',
            'permissionModules' => $permissionModules
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $validated  = $request->validate([
            'name'          => 'required',
            'permissions'   => 'required|array'
        ]);

        $role->update($validated);

        $role->syncPermissions($request->permissions);

        return redirect()->route('settings.roles.index');
    }


    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('settings.roles.index');
    }
    
}
