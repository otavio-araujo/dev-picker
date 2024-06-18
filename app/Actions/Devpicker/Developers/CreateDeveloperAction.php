<?php

namespace App\Actions\Devpicker\Developers;

use App\Models\Developer;
use Filament\Notifications\Notification;

class CreateDeveloperAction
{
    public static function execute($github_login, $github_name, $is_selected)
    {

        if ($is_selected === true) {

            $developer = Developer::where('github_login', $github_login)->first()->delete();

            Notification::make()
                ->title('Feito!')
                ->body("Desenvolvedor(a) <b> $github_name </b> foi removido.")
                ->success()
                ->color('success')
                ->duration(5000)
                ->send();
        } else {

            $developer = Developer::withTrashed()->where('github_login', $github_login)->first();

            if ($developer !== null) {
                $developer->restore();
            } else {
                $developer = Developer::firstOrCreate(
                    ['github_login' => $github_login],
                    ['user_id' => @auth()->id(), 'github_name' => $github_name]
                );
            }

            Notification::make()
                ->title('Feito!')
                ->body("Desenvolvedor(a) <b> {$developer->github_name} </b> selecionado.")
                ->success()
                ->color('success')
                ->duration(5000)
                ->send();
        }
    }
}
