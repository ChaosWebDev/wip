<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Desktop - Family Application')]
class Desktop extends Component
{
    public function render()
    {
        return view('desktop');
    }
}
