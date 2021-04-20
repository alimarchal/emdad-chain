<?php

namespace App\Http\Livewire;

use App\Models\Seller;
use Livewire\Component;

class Reference extends Component
{
    public $reference = '';
    public $count = 0;
    public $user = '';

    public function increment()
    {
        $this->user = Seller::where('seller_no', $this->reference)->first();
        $this->count++;
    }

    public function render()
    {
        return view('livewire.reference');
    }
}
