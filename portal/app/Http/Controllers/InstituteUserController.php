<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InstituteUser;

use Illuminate\Validation\Rule;

use App\Enums\{Gender, InstituteUserType};
use App\DataTables\InstituteUsersDataTable;

class InstituteUserController extends Controller
{
    const PROFILE_PATH = 'public/profile';
    /**
     * Display a listing of the resource.
     */
    public function index(InstituteUsersDataTable $dataTable)
    {
        //abort_if(permission('inst_user.list'), 403, __('app.permission_denied'));
	abort_if((count(array_intersect(['institute'], get_roles())) ? 0 : 1), 403, __('app.permission_denied'));

        return $dataTable->render('pages.institute_users.index');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        //abort_if(permission('inst_user.create'), 403, __('app.permission_denied'));
	abort_if((count(array_intersect(['institute', 'super_admin'], get_roles())) ? 0 : 1), 403, __('app.permission_denied'));

        $gender = get_enum_all_key_values(Gender::cases());
        $user_type = get_enum_all_key_values(InstituteUserType::cases());

        return view('pages.institute_users.create', compact('gender', 'user_type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        //abort_if(permission('inst_user.create'), 403, __('app.permission_denied'));
	abort_if((count(array_intersect(['institute', 'super_admin'], get_roles())) ? 0 : 1), 403, __('app.permission_denied'));

        $request->validate($this->validationArray());
        $post_data = $this->getPostData($request);
        $post_data['institute_id'] = get_vendor_inst_id();
        $post_data['created_at'] = date("Y-m-d H:i:s");

        try {
            InstituteUser::create($post_data);
        } catch (\Exception $e) {
            $key = 'error';
            $msg = $e->getMessage();
        }
        return redirect()->route('institute_users.index')->with($key ?? 'message', $msg ?? 'Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(InstituteUser $instituteUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InstituteUser $instituteUser)
    {
        //
        //abort_if(permission('inst_user.update'), 403, __('app.permission_denied'));
	abort_if((count(array_intersect(['institute', 'super_admin'], get_roles())) ? 0 : 1), 403, __('app.permission_denied'));

	//if ($instituteUser->created_by != current_user_id() AND ( ! in_array('super_admin', get_roles())))
        //abort(403);

        $gender = get_enum_all_key_values(Gender::cases());
        $user_type = get_enum_all_key_values(InstituteUserType::cases());
        return view('pages.institute_users.edit', compact('instituteUser', 'gender', 'user_type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InstituteUser $instituteUser)
    {
        //
        //abort_if(permission('inst_user.update'), 403, __('app.permission_denied'));

	abort_if((count(array_intersect(['institute', 'super_admin'], get_roles())) ? 0 : 1), 403, __('app.permission_denied'));

        $request->validate($this->validationArray());

        $post_data = $this->getPostData($request);
        $post_data['updated_at'] = date("Y-m-d H:i:s");

        try {
             $instituteUser->update($post_data);
        } catch (\Exception $e) {
            $key = 'error';
            $msg = $e->getMessage();
        }
        return redirect()->route('institute_users.index')->with($key ?? 'message', $msg ?? 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InstituteUser $instituteUser)
    {
        //abort_if(permission('inst_user.delete'), 403, __('app.permission_denied'));
	abort_if((count(array_intersect(['institute', 'super_admin'], get_roles())) ? 0 : 1), 403, __('app.permission_denied'));
    }

    private function getPostData(Request $request) {

        if ($request->hasFile('profile_pic')) {
            $profile_pic = time() . '_' . mt_rand() . '.' . $request->profile_pic->extension();
            $request->profile_pic->storeAs(self::PROFILE_PATH, $profile_pic);
        }

        return ['first_name' => $request->first_name, 'last_name' => $request->last_name, 'email_id' => $request->email, 'phone_no' => $request->phone_no, 'username' => $request->user_name, 'gender' => $request->gender, 'user_type' => $request->user_type, 'profile_pic' => $profile_pic ?? ''];
    }

    private function validationArray() {
        return [
                    'first_name' => 'required|max:96',
                    'last_name' => 'required|max:96',
                    'phone_no' => 'required|max:16',
                    'email' => 'required|email|max:96',
                    'user_name' => 'required|max:32',
                    'gender' => [Rule::enum(Gender::class)],
                    'user_type' => [Rule::enum(InstituteUserType::class)],
                    'profile_pic' => 'mimes:jpg,jpeg,png,gif|max:1024'
                ];
    }
}
