<?php
use App\Helpers\Custom;
use App\Http\Controllers\ParichayController;

if ( ! function_exists('permission')) {
    function permission($module = '') {
        return (! Custom::permission($module));
    }
}


if ( ! function_exists('get_roles')) {
    function get_roles() {
         return (Custom::get_roles());
    }
}

if ( ! function_exists('get_enum_all_key_values')) {
    function get_enum_all_key_values($enum_cases = []) {
         return array_combine(array_column($enum_cases, 'value'), array_column($enum_cases, 'name'));
    }
}

if ( ! function_exists('current_role')) {
    function current_role() {
         return (Custom::current_role());
    }
}

if ( ! function_exists('current_user_id')) {
    function current_user_id() {
         return (Custom::current_user_id());
    }
}

if ( ! function_exists('get_vendor_inst_id')) {
    function get_vendor_inst_id() {
         return (Custom::get_vendor_inst_id());
    }
}



if ( ! function_exists('get_permission_posts_fields')) {
    function get_permission_posts_fields($permission_arr = []) {
        $permission = new \stdClass();
        $permission->{'users.list'}   = $permission_arr['users.list'] ?? 0;
        $permission->{'users.create'} = $permission_arr['users.create'] ?? 0;
        $permission->{'users.update'} = $permission_arr['users.update'] ?? 0;
        $permission->{'users.delete'} = $permission_arr['users.delete'] ?? 0;

        $permission->{'roles.list'}   = $permission_arr['roles.list'] ?? 0;
        $permission->{'roles.create'} = $permission_arr['roles.create'] ?? 0;
        $permission->{'roles.update'} = $permission_arr['roles.update'] ?? 0;
        $permission->{'roles.delete'} = $permission_arr['roles.delete'] ?? 0;

        $permission->{'institute.list'}   = $permission_arr['institute.list'] ?? 0;
        $permission->{'institute.create'} = $permission_arr['institute.create'] ?? 0;
        $permission->{'institute.update'} = $permission_arr['institute.update'] ?? 0;
        $permission->{'institute.delete'} = $permission_arr['institute.delete'] ?? 0;

        $permission->{'equ_suppliers.list'}   = $permission_arr['equ_suppliers.list'] ?? 0;
        $permission->{'equ_suppliers.create'} = $permission_arr['equ_suppliers.create'] ?? 0;
        $permission->{'equ_suppliers.update'} = $permission_arr['equ_suppliers.update'] ?? 0;
        $permission->{'equ_suppliers.delete'} = $permission_arr['equ_suppliers.delete'] ?? 0;

        $permission->{'inst_user.list'}   = $permission_arr['inst_user.list'] ?? 0;
        $permission->{'inst_user.create'} = $permission_arr['inst_user.create'] ?? 0;
        $permission->{'inst_user.update'} = $permission_arr['inst_user.update'] ?? 0;
        $permission->{'inst_user.delete'} = $permission_arr['inst_user.delete'] ?? 0;

        $permission->{'equipment.list'}   = $permission_arr['equipment.list'] ?? 0;
        $permission->{'equipment.create'} = $permission_arr['equipment.create'] ?? 0;
        $permission->{'equipment.update'} = $permission_arr['equipment.update'] ?? 0;
        $permission->{'equipment.delete'} = $permission_arr['equipment.delete'] ?? 0;

        return serialize($permission);
    }
}

if ( ! function_exists('parichay_login')) {
    function parichay_login() {
        return (new ParichayController())->login();
    }
}

if ( ! function_exists('get_user_telecom_department')) {
    function get_user_telecom_department() {
         return (Custom::get_user_telecom_department());
    }
}

if ( ! function_exists('check_expert_app_exist')) {
    function check_expert_app_exist() {
         return (Custom::check_expert_app_exist());
    }
}