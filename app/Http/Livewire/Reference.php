<?php

namespace App\Http\Livewire;

use App\Models\Ire;
use Livewire\Component;

class Reference extends Component
{
    public $reference = '';
    public $count = 0;
    public $user = '';

    public function increment()
    {
        $this->user = Ire::where('seller_no', $this->reference)->first();
        $this->count++;
    }

    public function render()
    {
        return view('livewire.reference');
    }
}
