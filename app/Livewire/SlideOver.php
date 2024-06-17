<?php

namespace App\Livewire;


use Livewire\Component;
use Livewire\Attributes\On;

class SlideOver extends Component
{
    public $developerDetails = [];

    #[On('show-developer-details')]
    public function showDetails($developerDetails)
    {
        $this->open();

        $this->developerDetails = $developerDetails;
    }

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
