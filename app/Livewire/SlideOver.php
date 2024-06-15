<?php

namespace App\Livewire;

use Livewire\Component;

class SlideOver extends Component
{

    public $isOpen = false;

    public function open()
    {
        $this->isOpen = true;
    }

    public function close()
    {
        $this->isOpen = false;
    }

    public function render()
    {
        return view('livewire.slide-over');
    }
}
