<?php

namespace App\Http\Livewire;

use App\Models\Ire;
use App\Models\IreCommission;
use Carbon\Carbon;
use Livewire\Component;

class Reference extends Component
{
    public $reference = '';
    public $count = 0;
    public $user = '';
    public $days = '';
    public $businessCount = '';

    public function increment()
    {
        $this->user = Ire::where('ire_no', $this->reference)->first();
        $this->businessCount = IreCommission::where('type', '!=', 0)->where(['ire_no' => $this->reference],['status' => 1])->count();
        $this->count++;
        $current = Carbon::now();
        if (isset($this->user->created_at))
        {
            $this->days = $current->diffInDays($this->user->created_at);
        }
    }

    public function render()
    {
        return view('livewire.reference');
    }
}
