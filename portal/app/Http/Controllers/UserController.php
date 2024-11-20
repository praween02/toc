<?php

namespace App\Http\Controllers;

use \App\Models\{Role,User,RoleUser,UserPermission,Institute};

use Illuminate\Http\Request;

use App\DataTables\UsersDataTable;

use Illuminate\Support\Facades\DB;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UsersDataTable $dataTable)
    {
        //
       // abort_if(permission('users.list'), 403, __('app.permission_denied'));

        return $dataTable->render('pages.user.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        abort_if(permission('users.create'), 403, __('app.permission_denied'));

        $roles = $this->getRoles();
        $institutes = Institute::select(['id', 'institute'])->orderBy('institute', 'ASC')->get();
        return view('pages.user.create', compact('roles', 'institutes'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if(permission('users.create'), 403, __('app.permission_denied'));

        $request->validate([
                                'name' => 'required|max:255',
                                'email' => 'required|unique:users|max:255',
                                'password' => 'required|min:6',
                                'address1' => 'required',
                                'mobile' => 'required',
                          ]);
        try {
                DB::beginTransaction();
                    $role_permission = Role::select('permission')->whereId($request->role_id)->first()->{'permission'};
                    $user = User::create(['name' => $request->name, 'email' => $request->email, 'password' => bcrypt($request->password), 'created_at' => date("Y-m-d H:i:s")]);
                    $user->profile()->create(['user_id' => $user->id, 'address1' => $request->address1, 'address2' => $request->address2, 'mobile' => $request->mobile]);
                    $user->permission()->create(['user_id' => $user->id, 'permission' => serialize($role_permission)]);
                    $user->role_user()->create(['user_id' => $user->id, 'role_id' => $request->role_id]);

                    if ($request->role_id == 3)
                    DB::table('user_institutes')->insert(['user_id' => $user->id, 'institute_id' => $request->institute_id]);

                DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $key = 'error';
            $msg = $e->getMessage();
        }

        return redirect()->route('users.index')->with($key ?? 'message', $msg ?? 'Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        abort_if(permission('users.update'), 403, __('app.permission_denied'));

        $roles = $this->getRoles();
        $assigned_role = $user->role_user->role_id;
        return view('pages.user.edit', compact('user', 'roles', 'assigned_role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        abort_if(permission('users.update'), 403, __('app.permission_denied'));

        $request->validate([
                                'name' => 'required|max:255',
                                'email' => 'required|unique:users,email,' . $user->id . '|max:255',
                                'password' => 'nullable|min:6',
                                'address1' => 'required',
                                'mobile' => 'nullable|numeric',
                          ]);
        try {
                DB::beginTransaction();
                

                $params = ['name' => $request->name, 'email' => $request->email, 'updated_at' => date("Y-m-d H:i:s")];
                if ($request->password)
                $params['password'] = bcrypt($request->password);
            
                $user->update($params);

                $user->profile()->update(['address1' => $request->address1, 'address2' => $request->address2, 'mobile' => $request->mobile]);

                $user_role = $user->role_user->role_id; //RoleUser::where(['user_id' => $user->id])->pluck('role_id')->toArray();

                if ($request->role_id != $user_role) {
                    $role_permission = Role::select('permission')->whereId($request->role_id)->first()->{'permission'};
                    $user->permission()->update(['permission' => serialize($role_permission)]);
                }

                $user->role_user()->update(['role_id' => $request->role_id]);

                DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            $key = 'error';
            $msg = $e->getMessage();
        }
        return redirect()->route('users.index')->with($key ?? 'message', $msg ?? 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        abort_if(permission('users.delete'), 403, __('app.permission_denied'));
    }

    /**
     * Get the all roles
     */
    private function getRoles() {
        return Role::select(['id', 'name', 'slug'])->get();
    }

    /**
     * Permission Edit
     */
    public function permission($encryptedId = "") {
        $user = $this->checkEncryptedId($encryptedId);
        $permission = unserialize($user->permission->permission);
        return view('pages.user.permission', compact('permission', 'encryptedId'));
    }

    /**
     * Permission Update
     */

    public function updatePermission(Request $request, $encryptedId = "") {

        try {
            $user = $this->checkEncryptedId($encryptedId);
            $role_permission = get_permission_posts_fields($request->permission);
            $user->permission()->update(['permission' => $role_permission]);
        }
        catch(Exception $e) {
            $msg = $e->getMessage();
        }
        
        return redirect()->route('users.index')->with($key ?? 'message', $msg ?? 'Updated Successfully');
    }

    private function checkEncryptedId($encryptedId = '') {
        try {
            $decryptedId = Crypt::decryptString($encryptedId);
            $user = User::find($decryptedId);
        } catch (DecryptException $e) {
            abort_if(1, 403, __('app.permission_denied'));
        }
        return $user;
    }

}
