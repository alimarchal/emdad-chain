<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;

class PurchaseRequestForm extends Component
{
    public $parentCategories;
    public $childs;
    public $user;

    public $add = 0;


    public function render()
    {

        return view('livewire.purchase-request-form');
    }


    public function like()
    {
        $this->add += 2;
    }

}
