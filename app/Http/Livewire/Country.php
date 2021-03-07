<?php

namespace App\Http\Livewire;

use App\Models\City;
use Livewire\Component;

class Country extends Component
{

    public $country = null;

    public function render()
    {
        $list = City::where('name_en', 'a')->get();
        if($this->country =="Saudi Arabia")
            $list = City::alL()->sortBy('name_en');
        return view('livewire.country', compact('list'));
    }
}
