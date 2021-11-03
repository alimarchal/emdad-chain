<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MobileVerification extends Component
{
    public $wrong_sms  = false;
    public $mobile_verify_check  = false;
    public $sms_code = '';
    public $warehouse;
    public $i = 0;

    public function render()
    {
        $warehouse = \App\Models\BusinessWarehouse::where('business_id', auth()->user()->business_id)->first();
        $this->warehouse = $warehouse;
        return view('livewire.mobile-verification');
    }

    public function send_sms()
    {
        $warehouse = \App\Models\BusinessWarehouse::where('business_id', auth()->user()->business_id)->first();
        $mobile_no = $warehouse->mobile;
        $randomNumber = rand(1001,9999);
        $warehouse->mobile_verification_code = $randomNumber;
        $warehouse->save();
//        \App\Models\User::send_sms($mobile_no,'Your sms code is: ' . $randomNumber);
    }

    public function verify_sms()
    {
        $warehouse = \App\Models\BusinessWarehouse::where('business_id', auth()->user()->business_id)->first();
        $mobile_verify_code = $warehouse->mobile_verification_code;
        if ($mobile_verify_code == $this->sms_code)
        {
            $warehouse->mobile_verified = 1;
            $warehouse->save();
            $this->mobile_verify_check = true;
            $this->i++;
        }
        else {
            $this->wrong_sms = true;
        }

    }
}
