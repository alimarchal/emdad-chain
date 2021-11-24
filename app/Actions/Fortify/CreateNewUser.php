<?php

namespace App\Actions\Fortify;

use App\Models\Ire;
use App\Models\IreCommission;
use App\Models\User;
use App\Notifications\User\UserRegistration;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Spatie\Permission\Models\Role;

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
        Validator::make($input, [
            'gender' => ['required', 'string', 'max:10'],
            'policy_procedure' => ['required'],
            'service' => ['required'],
            'name' => ['required', 'string', 'max:55'],
            'company_name' => ['required', 'string', 'max:191'],
//            'nid_exp_date' => ['required', 'date'],
            'mobile' => ['required', 'digits:9'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
        ])->validate();

//        $time = strtotime($input['nid_exp_date']);
//        $newformat = date('Y-m-d', $time);
//        $input['nid_exp_date'] = $newformat;
        $input['mobile'] = str_replace(' ', '', $input['mobile']);
        $input['mobile'] = str_replace(')', '', $input['mobile']);
        $input['mobile'] = str_replace('(', '', $input['mobile']);
        $input['mobile'] = str_replace('-', '', $input['mobile']);

        $user = null;
        if ($input['service'] == 3) {
            $user = User::create([
                'gender' => $input['gender'],
                'name' => $input['name'],
                'family_name' => $input['family_name'],
                'mobile' => $input['mobile'],
                'company_name' => $input['company_name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                'usertype' => 'Logistics Solution',
                'logistic_solution' => 1,
            ]);
        } elseif ($input['service'] == 1) {
            $user = User::create([
                'gender' => $input['gender'],
                'name' => $input['name'],
                'family_name' => $input['family_name'],
                'mobile' => $input['mobile'],
                'company_name' => $input['company_name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                'registration_type' => 'Buyer',
                'usertype' => 'CEO',
            ]);
        } elseif ($input['service'] == 2) {
            $user = User::create([
                'gender' => $input['gender'],
                'name' => $input['name'],
                'family_name' => $input['family_name'],
                'mobile' => $input['mobile'],
                'company_name' => $input['company_name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                'registration_type' => 'Supplier',
                'usertype' => 'CEO',
            ]);
        }

        /*
         * The below lines are defined in SendWelcomeMail email listener
         * this class will be invoked when user click on verify link
            $user_language = $user->rtl;
            if ($user_language == 0) {
                User::send_sms($input['mobile'], SmsMessages::find(1)->english_message);
            } else if ($user_language == 1) {
                User::send_sms($input['mobile'], SmsMessages::find(1)->arabic_message);
            }
         */

        $user->notify(new UserRegistration());

        if ($input['referred_no'] == null || $input['referred_no'] == ' ') {
            if ($input['service'] == 3) {
                $role = Role::findByName('Logistics Solution');
                $user->assignRole($role);
                return $user;
            } else {
                $role = Role::findByName('CEO');
                $user->assignRole($role);
                return $user;
            }
        } else {
            $ireReferred = Ire::where('ire_no', $input['referred_no'])->first();
            if (isset($ireReferred)) {
                IreCommission::create([
                    'ire_no' => $input['referred_no'],
                    'user_id' => $user->id,
                    'type' => 3,
                ]);
            }
        }


        if ($input['service'] == 3) {
            $role = Role::findByName('Logistics Solution');
            $user->assignRole($role);
        } else {
            $role = Role::findByName('CEO');
            $user->assignRole($role);
        }


        return $user;
    }
}
