<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;

class PurchaseRequestForm extends Component
{
    public $parentCategories;

    public $add = 0;


    public function render()
    {
        $this->parentCategories = Category::where('parent_id', 0)->orderBy('name', 'asc')->get();
//        dd($this->parentCategories);
        return view('livewire.purchase-request-form');
    }


    public function like()
    {
        $this->add += 2;
    }

}
