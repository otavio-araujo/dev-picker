<?php

namespace App\Livewire;


use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Http;
use Filament\Notifications\Notification;

class SlideOver extends Component
{
    public $developerDetails = [];
    public $developerRepositories = [];


    #[On('show-developer-details')]
    public function showDetails($developerDetails)
    {
        $this->open();

        $this->developerDetails = $developerDetails;
        $this->developerRepositories = $this->getDeveloperRepositories($developerDetails['repos_url']);
    }

    public function getDeveloperRepositories($github_user_repos_url)
    {
        try {

            $devRepos = Http::withToken(config('github.api_token'))->get($github_user_repos_url)->json();

            if (array_key_exists('status', $devRepos) && $devRepos['status'] === '404') {

                return null;
            } else {
                return $devRepos;
            }
            //
        } catch (\Throwable $th) {

            Notification::make()
                ->title('Oooops! Algo deu errado...')
                ->body('Não foi possivel realizar a comunicação com a API do GitHub.com')
                ->warning()
                ->color('warning')
                ->send();
        }
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
