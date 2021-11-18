<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class LogisticSolution extends Component
{

    public $PackagingSolution = 0;
    public $StorageSolution = 0;
    public $LocalCargo = 0;
    public $InternationalCargo = 0;

    public function mount()
    {
        $this->PackagingSolution = auth()->user()->packaging_solution;
        $this->StorageSolution = auth()->user()->storage_solution;
        $this->LocalCargo = auth()->user()->local_cargo;
        $this->InternationalCargo = auth()->user()->international_cargo;
    }

    public function render()
    {
        return view('livewire.logistic-solution');
    }

    public function updated()
    {
        $user = User::find(auth()->user()->id);
        $user->packaging_solution = $this->PackagingSolution;
        $user->storage_solution = $this->StorageSolution;
        $user->local_cargo = $this->LocalCargo;
        $user->international_cargo = $this->InternationalCargo;
        $user->save();
    }
}
