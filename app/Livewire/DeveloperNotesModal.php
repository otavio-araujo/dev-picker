<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class DeveloperNotesModal extends Component
{

    public $isOpen = false;

    #[On('show-developer-notes')]
    public function showDeveloperNotes()
    {
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function render()
    {
        return view('livewire.developer-notes-modal');
    }
}
