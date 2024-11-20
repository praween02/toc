<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\DataTables\RolesDataTable;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(RolesDataTable $dataTable)
    {
        abort_if(permission('roles.list'), 403, __('app.permission_denied'));
        return $dataTable->render('pages.role.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(permission('roles.create'), 403, __('app.permission_denied'));
        return view('pages.role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(permission('roles.create'), 403, __('app.permission_denied'));
        $request->validate([
                                'name' => 'required|unique:roles|max:255',
                          ]);
        try {
            $user = Role::create(['name' => $request->name, 'slug' => Str::slug($request->name), 'permission' => get_permission_posts_fields($request->permission), 'created_at' => date("Y-m-d H:i:s")]);
        } catch (\Exception $e) {
            $key = 'error';
            $msg = $e->getMessage();
        }
        return redirect()->route('roles.index')->with($key ?? 'message', $msg ?? 'Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
            abort_if(permission('roles.update'), 403, __('app.permission_denied'));
            return view('pages.role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        abort_if(permission('roles.create'), 403, __('app.permission_denied'));
        $request->validate([
                                'name' => 'required|unique:roles,name,' . $role->id . '|max:255',
                            ]);
        try {
                $role->update(['name' => $request->name, 'permission' => get_permission_posts_fields($request->permission), 'updated_at' => date("Y-m-d H:i:s")]);
        } catch (\Exception $e) {
            $key = 'error';
            $msg = $e->getMessage();
        }
        return redirect()->route('roles.index')->with($key ?? 'message', $msg ?? 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
    }

    // private function permission($permission_arr = []) {

    //     $permission = new \stdClass();
    //     $permission->{'users.list'}   = $permission_arr['users.list'] ?? 0;
    //     $permission->{'users.create'} = $permission_arr['users.create'] ?? 0;
    //     $permission->{'users.update'} = $permission_arr['users.update'] ?? 0;
    //     $permission->{'users.delete'} = $permission_arr['users.delete'] ?? 0;

    //     $permission->{'roles.list'}   = $permission_arr['roles.list'] ?? 0;
    //     $permission->{'roles.create'} = $permission_arr['roles.create'] ?? 0;
    //     $permission->{'roles.update'} = $permission_arr['roles.update'] ?? 0;
    //     $permission->{'roles.delete'} = $permission_arr['roles.delete'] ?? 0;

    //     $permission->{'institute.list'}   = $permission_arr['institute.list'] ?? 0;
    //     $permission->{'institute.create'} = $permission_arr['institute.create'] ?? 0;
    //     $permission->{'institute.update'} = $permission_arr['institute.update'] ?? 0;
    //     $permission->{'institute.delete'} = $permission_arr['institute.delete'] ?? 0;

    //     $permission->{'equ_suppliers.list'}   = $permission_arr['equ_suppliers.list'] ?? 0;
    //     $permission->{'equ_suppliers.create'} = $permission_arr['equ_suppliers.create'] ?? 0;
    //     $permission->{'equ_suppliers.update'} = $permission_arr['equ_suppliers.update'] ?? 0;
    //     $permission->{'equ_suppliers.delete'} = $permission_arr['equ_suppliers.delete'] ?? 0;

    //     $permission->{'inst_user.list'}   = $permission_arr['inst_user.list'] ?? 0;
    //     $permission->{'inst_user.create'} = $permission_arr['inst_user.create'] ?? 0;
    //     $permission->{'inst_user.update'} = $permission_arr['inst_user.update'] ?? 0;
    //     $permission->{'inst_user.delete'} = $permission_arr['inst_user.delete'] ?? 0;
        

    //     return serialize($permission);
    // }

}
