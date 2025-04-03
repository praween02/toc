<?php
namespace App\Helpers;

use App\Models\{User,Role,RoleUser,AskExpertDetail};

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

class Custom
{
    public static function permission($module = "")
        {
            $user_id = Auth::user()->id;
            $role_type = User::find($user_id)->role()->pluck('slug')->toArray();

            if (in_array('super_admin', $role_type)) {
                return 1;
            } else {

                $permission = User::find($user_id)->permission()->pluck('permission')->first();
                $permission_arr = unserialize($permission);
                return isset($permission_arr->{$module}) ? $permission_arr->{$module} : 0;
            }      
        }

    public static function get_roles() {
        return User::find(Auth::user()->id)->role()->pluck('slug')->toArray();
    }

    public static function current_role() {
        return RoleUser::select('role_id')->where('user_id', Auth::user()->id)->first()->role_id;
    }
	
	public static function current_user_id() {
        return Auth::user()->id;
    }
	
    public static function get_vendor_inst_id() {
        return DB::table('user_institutes')->select('institute_id')->where('user_id', current_user_id())->first()->institute_id ?? 0;
    }

    public static function get_user_telecom_department() {
        $current_user_id = current_user_id();
        $rec =  DB::SELECT("SELECT `department` FROM `" . DB::getTablePrefix() . "telecom_departments` WHERE `id` = (SELECT `department_id` FROM `" . DB::getTablePrefix() . "user_telecom_departments` WHERE `user_id` = $current_user_id) LIMIT 1");
        return $rec[0]->department ?? 'N/A';
    }

   public static function check_expert_app_exist() {
        return AskExpertDetail::where('user_id', current_user_id())->count();   
   }

   public static function current_institute_id() {
        return DB::table('user_institutes')->select('institute_id')->where('user_id', current_user_id())->first()->institute_id ?? 0;
   }
}
