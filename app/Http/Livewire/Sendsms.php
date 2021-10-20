<?php

namespace App\Http\Livewire;

use http\Client\Curl\User;
use Livewire\Component;

class Sendsms extends Component
{

    public $sendSms = false;
    public $wrong_sms  = false;
    public $mobile_verify_check  = false;
    public $sms_code = '';

    public function render()
    {
        $user = \App\Models\User::where('id',auth()->user()->id)->first();
        $mobile_verify_check = $user->mobile_verify;
        if ($mobile_verify_check)
        {
            $this->mobile_verify_check = true;
        }
        return view('livewire.sendsms');
    }

    public function send_sms()
    {
        $user = \App\Models\User::find(auth()->user())->first();
        $mobile_no = $user->mobile;
        $randomNumber = rand(1001,9999);
        $user->mobile_verify_code = $randomNumber;
        $user->save();
        \App\Models\User::send_sms($mobile_no,'Your sms code is: ' . $randomNumber);
        $this->sendSms = true;
    }

    public function verify_sms()
    {
        $user = \App\Models\User::find(auth()->user())->first();
        $mobile_verify_code = $user->mobile_verify_code;
        if ($mobile_verify_code == $this->sms_code)
        {
            $user->mobile_verify = 1;
            $user->save();
            $this->mobile_verify_check = true;
        }
        else {
            $this->wrong_sms = true;
        }

    }



//    public function updated()
//    {
//        dd('updated');
//    }
}
