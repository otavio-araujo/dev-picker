<?php

namespace App\Actions\Devpicker\Developers;

use Filament\Notifications\Notification;

class CreateDeveloperAction
{
    public static function execute($github_login)
    {
        Notification::make()
            ->title($github_login)
            ->success()
            ->duration(5000)
            ->send();
    }
}
