<?php

namespace App\Http\Livewire;

use Livewire\Component;

class RegistrationType extends Component
{

    public $name = 'ssd';
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
        return view('livewire.registration-type');
    }
}
