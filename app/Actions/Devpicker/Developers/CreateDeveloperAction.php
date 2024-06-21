<?php

namespace App\Actions\Devpicker\Developers;

use App\Models\Developer;
use Filament\Notifications\Notification;

class CreateDeveloperAction
{
    public static function execute($github_login, $github_name, $is_selected, $github_avatar, $github_url)
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
                $developer->github_name = $github_name;
                $developer->github_login = $github_login;
                $developer->github_avatar = $github_avatar;
                $developer->github_url = $github_url;
                $developer->user_id = @auth()->id();
                $developer->save();
            } else {
                $developer = Developer::firstOrCreate(
                    ['github_login' => $github_login],
                    ['user_id' => @auth()->id(), 'github_name' => $github_name, 'github_avatar' => $github_avatar, 'github_url' => $github_url]
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
