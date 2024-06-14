<?php

namespace App\Actions\Devpicker\Developers;

use Filament\Notifications\Notification;

class CreateDeveloperAction
{
    public static function execute()
    {
        Notification::make()
            ->title('Execute')
            ->success()
            ->duration(5000)
            ->send();
    }
}
