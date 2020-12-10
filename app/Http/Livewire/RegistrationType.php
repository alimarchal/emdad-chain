<?php

namespace App\Http\Livewire;

use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RegistrationType extends Component
{

    public $business_tick = false;
    public $tab1 = "";
    public $tab2 = "hidden";
    public $tab3 = "hidden";
    public $border = "text-blue-500 border-blue-500 border-b-2";

    public function show($tabName)
    {
        if ($tabName == "tab1") {
            $this->tab1 = "";
            $this->tab2 = "hidden";
            $this->tab3 = "hidden";
        } elseif ($tabName == "tab2") {
            $this->tab1 = "hidden";
            $this->tab2 = "";
            $this->tab3 = "hidden";
        } elseif ($tabName == "tab3") {
            $this->tab1 = "hidden";
            $this->tab2 = "hidden";
            $this->tab3 = "";
        }
    }

    public function render()
    {
        $business = Business::where('user_id', Auth::id())->get();
        $this->business_tick = $business->count() >= 1 ? true : false;
        return view('livewire.registration-type', ['business_tick' => $this->business_tick, 'business' => $business]);
    }
}
