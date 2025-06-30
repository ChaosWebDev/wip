<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Desktop - Family Application')]
#[Layout('components.layouts.desktop')]
class Desktop extends Component
{


    public function mount() {
        //
    }

    public function render()
    {
        return view('desktop');
    }
}
