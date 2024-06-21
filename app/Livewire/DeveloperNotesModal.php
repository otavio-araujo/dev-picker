<?php

namespace App\Livewire;

use App\Actions\Devpicker\Developers\CreateDeveloperNoteAction;
use App\Actions\Devpicker\Developers\DeleteDeveloperNoteAction;
use Livewire\Component;
use App\Models\Developer;
use Livewire\Attributes\On;
use App\Models\DeveloperNote;

class DeveloperNotesModal extends Component
{

    public $isOpen = false;
    public $developerDetails;
    public $developerNotes;
    public $note;

    public function createDeveloperNote()
    {
        CreateDeveloperNoteAction::execute($this->developerDetails, $this->note);
        $this->note = '';
        $this->developerNotes = $this->developerDetails->notes;
    }

    #[On('show-developer-notes')]
    public function showDeveloperNotes(Developer $developer)
    {
        $this->developerDetails = $developer;
        $this->developerNotes = $developer->notes;
        $this->openModal();
    }

    public function deleteDeveloperNote(DeveloperNote $note)
    {
        DeleteDeveloperNoteAction::execute($note);
        $this->developerNotes = $this->developerDetails->notes;
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
