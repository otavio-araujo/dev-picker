<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Developer;
use Livewire\Attributes\On;
use Filament\Actions\Action;
use App\Models\DeveloperNote;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Actions\Concerns\InteractsWithActions;
use App\Actions\Devpicker\Developers\CreateDeveloperNoteAction;
use App\Actions\Devpicker\Developers\DeleteDeveloperNoteAction;

class DeveloperNotesModal extends Component implements HasForms, HasActions
{

    use InteractsWithActions;
    use InteractsWithForms;

    public $isOpen = false;
    public $developerDetails;
    public $developerNotes;
    public $note;

    protected $rules = [
        'note' => 'required|max: 1000|min: 3'
    ];

    public function createDeveloperNote()
    {
        $data = $this->validate();

        CreateDeveloperNoteAction::execute($this->developerDetails, $data['note']);
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

    public function deleteAction(): Action
    {
        return Action::make('delete')
            ->action(function (array $arguments) {
                $developerNote = DeveloperNote::find($arguments['note']);

                $developerName = $developerNote->developer->github_name;

                $developerNote?->delete();

                Notification::make()
                    ->title('Feito!')
                    ->body('A anotaçõe de <b>' . $developerName . '</b> foi removida com sucesso.')
                    ->success()
                    ->color('success')
                    ->send();

                $this->openModal();
            })
            ->requiresConfirmation()
            ->label('Remover Anotação do Desenvolvedor')
            ->icon('heroicon-o-trash')
            ->iconButton()
            ->color('danger')
            ->modalDescription('Você tem certeza que quer remover as anotações?');
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
