<?php

namespace App\Http\Livewire;

use App\Models\City;
use Livewire\Component;

class Country extends Component
{

    public $country = 'Saudi Arabia';


    public function render()
    {
//        $list = null;
//        if ($this->country == "Saudi Arabia")
//            $list = City::alL()->sortBy('name_en');
        return view('livewire.country');
    }


//    public function updated()
//    {
//        dd('updating');
//    }
}
