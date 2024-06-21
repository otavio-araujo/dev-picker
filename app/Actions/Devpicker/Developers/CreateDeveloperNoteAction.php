<?php

namespace App\Actions\Devpicker\Developers;

use App\Models\Developer;
use App\Models\DeveloperNote;
use Filament\Notifications\Notification;

class CreateDeveloperNoteAction
{
    public static function execute(Developer $developer, $note)
    {
        $note = DeveloperNote::create([
            'note' => $note,
            'developer_id' => $developer->id,
            'user_id' => auth()->user()->id,
        ]);

        Notification::make()
            ->title('Feito!')
            ->body("Observação cadastrada com sucesso para <b> {$developer->github_name} </b>.")
            ->success()
            ->color('success')
            ->duration(5000)
            ->send();
    }
}
