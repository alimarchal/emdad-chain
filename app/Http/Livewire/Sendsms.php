<?php

namespace App\Http\Livewire;

use App\Models\SmsMessages;
use App\Models\User;
use Livewire\Component;

class Sendsms extends Component
{

    public $sendSms = false;
    public $wrong_sms  = false;
    public $mobile_verify_check  = false;
    public $sms_code = '';
    public $mobile_number = '';

    protected $rules = [
        'mobile_number' => 'required|regex:([5][0-9]{8})',
    ];

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
        $user = User::find(auth()->user()->id);

        if ($user->mobile != $this->mobile_number && $this->mobile_number != null)
        {
            $this->validate();
            $user->update(['mobile' => $this->mobile_number]);
        }

        $mobile_no = $user->mobile;
        $randomNumber = rand(1001,9999);
        $user->mobile_verify_code = $randomNumber;
        $user->save();


        $message = SmsMessages::find(5)->english_message;
        $message = str_replace("{user_name}",$user->name, $message);
        $message = str_replace("{registration_type}",$user->registration_type, $message);
        $message = str_replace("{company_name}",$user->company_name,$message);
        $message = str_replace("{mobile}",$user->mobile,$message);

        // $message = ' %0a New user ' . $user->name .' has registered as ' . $user->registration_type . '%0a Company name: ' . $user->company_name . '%0a Mobile: '. $user->mobile;


        User::send_sms(env('SMS_NO_ONE'),config('app.url') . $message);
        User::send_sms(env('SMS_NO_TWO'),config('app.url') . $message);


        $message = SmsMessages::find(6)->english_message;
        $message = str_replace("{otp}",$randomNumber, $message);
        User::send_sms($mobile_no,$message);
        $this->sendSms = true;
    }

    public function verify_sms()
    {
        $user = User::find(auth()->user()->id);
        $mobile_verify_code = $user->mobile_verify_code;
        if ($mobile_verify_code == $this->sms_code)
        {
            $user->mobile_verify = 1;
            $user->save();
            $this->mobile_verify_check = true;
            $this->redirect('packages');
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
