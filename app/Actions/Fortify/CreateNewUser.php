<?php

namespace App\Actions\Fortify;

use App\Models\Ire;
use App\Models\IreCommission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param array $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        $time = strtotime($input['nid_exp_date']);
        $newformat = date('Y-m-d',$time);
        $input['nid_exp_date'] = $newformat;
        Validator::make($input, [
            'gender' => ['required', 'string', 'max:10'],
            'policy_procedure' => ['required'],
            'name' => ['required', 'string', 'max:55'],
            'middle_initial' => ['required', 'string', 'max:3'],
            'family_name' => ['required', 'string', 'max:55'],
            'nid_num' => ['required', 'string', 'max:10'],
            'nid_exp_date' => ['required', 'date'],
            'mobile' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
        ])->validate();

        $user = User::create([
            'gender' => $input['gender'],
            'name' => $input['name'],
            'middle_initial' => $input['middle_initial'],
            'family_name' => $input['family_name'],
            'nid_num' => $input['nid_num'],
            'nid_exp_date' => $input['nid_exp_date'],
            'mobile' => $input['mobile'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'usertype' => 'CEO',
        ]);

        if ($input['referred_no'] == null || $input['referred_no'] == ' ')
        {
            $role = Role::findByName('CEO');
            $user->assignRole($role);
            return $user;
        }
        else
        {
            $ireReferred = Ire::where('ire_no', $input['referred_no'])->first();

            if (isset($ireReferred))
            {
                IreCommission::create([
                    'ire_no' => $input['referred_no'],
                    'user_id' => $user->id,
                    'type' => 3,
                ]);
            }
        }

        $role = Role::findByName('CEO');
        $user->assignRole($role);
        return $user;
    }
}
