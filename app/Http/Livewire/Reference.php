<?php

namespace App\Http\Livewire;

use App\Models\DraftPurchaseOrder;
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
    public $poCount = 0;
    public $userPoCount = '';

    public function increment()
    {
        $this->user = Ire::where('ire_no', $this->reference)->first();
//        $this->businessCount = IreCommission::where('type', '!=', 0)->where(['ire_no' => $this->reference],['status' => 1])->count();
        $this->businessCount = IreCommission::where('type', '!=', 0)->where(['ire_no' => $this->reference],['status' => 1])->get();

        unset($this->poCount);

        if (isset($this->businessCount) && count($this->businessCount) > 0 )
        {
            $this->poCount = 0;

            foreach ($this->businessCount as $business)
            {
               $this->userPoCount = DraftPurchaseOrder::where(['user_id' => $business->user_id],['status' => 'approved'])->first();

               if (isset($this->userPoCount))
                {
                    $this->poCount += 1;
                }
            }
        }

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
