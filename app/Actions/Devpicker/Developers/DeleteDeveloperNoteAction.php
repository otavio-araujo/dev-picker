<?php

namespace App\Actions\Devpicker\Developers;

use App\Models\DeveloperNote;
use Filament\Notifications\Notification;

class DeleteDeveloperNoteAction
{
    public static function execute(DeveloperNote $note)
    {
        $note->delete();
        Notification::make()
            ->title('Feito!')
            ->body("Observação de <b> {$note->developer->github_name} </b> removida com sucesso!")
            ->success()
            ->color('success')
            ->send();
    }
}
