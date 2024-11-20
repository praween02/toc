<?php

namespace App\Actions\Fortify;

use App\Models\{User,RoleUser,Profile};
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\DB;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
	$user = '';

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
	    'mobile' => ['required', 'numeric', 'digits:10'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

            DB::beginTransaction();

            try 
                {
                    $user = User::create([
                        'name' => $input['name'],
                        'email' => $input['email'],
                        'password' => Hash::make($input['password']),
                    ]);

                    RoleUser::create([
                        'role_id' => 8,
                        'user_id' => $user->id,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]); 

		    Profile::create([
                        'user_id' => $user->id,
                        'mobile' => $input['mobile'],
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]); 

                    DB::commit();
                }

            catch (\Exception $e) {
                DB::rollback();
            }

            return $user;
    }
    /**
     * Function to create user role in role table.
     *
     * @param  <string, string>  $id, $role
     **/
    public function setRole($id= '',$role='') {
        date_default_timezone_set('Asia/Kolkata');
        return RoleUser::create([
            'role_id' => $role,
            'user_id' => $id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]); 
    }   
}
