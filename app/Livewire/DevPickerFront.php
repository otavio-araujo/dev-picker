<?php

namespace App\Livewire;

use App\Actions\Devpicker\Developers\CreateDeveloperAction;
use App\Enums\DeveloperStatusEnum;
use Livewire\Component;
use App\Enums\Languages;
use App\Models\Developers;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Http;
use Filament\Notifications\Notification;
use Illuminate\Pagination\LengthAwarePaginator;

use function PHPUnit\Framework\returnSelf;

class DevPickerFront extends Component
{
    use WithPagination;

    public $users = [];
    public $minFollowers = 10000;
    public $location = 'brasil';
    public $developerType = 'user';
    public $languages = [];
    public $perPage = 5;
    public $currentPage = 1;
    public $total = 0;
    protected $languagesQuery;

    public function searchDev()
    {
        $this->reset('currentPage');
        $this->fetchDevelopers();
    }

    public function selectDeveloper($github_user_url)
    {
        try {
            $userDetails = Http::withToken(config('github.api_token'))->get($github_user_url)->json();

            if (array_key_exists('status', $userDetails) && $userDetails['status'] === '404') {

                Notification::make()
                    ->title('Oooops! Algo deu errado...')
                    ->body('Não foi possivel localizar o desenvolvedor na base de dados do GitHub.')
                    ->danger()
                    ->color('danger')
                    ->send();

                return null;
            }

            CreateDeveloperAction::execute($userDetails['login'], $userDetails['name'], $this->isSelected($userDetails['login']));
            $this->fetchDevelopers();
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

    public function validateDeveloper($github_login)
    {
        return null;
    }

    protected function fetchDevelopers()
    {
        $token = config('github.api_token');

        $response = Http::withToken($token)->get("https://api.github.com/search/users", [
            'q' => $this->getQueryBuilder(),
            'per_page' => $this->perPage,
            'page' => $this->currentPage,
        ]);

        $usersData = $response->json();

        $this->users = $usersData['items'] ?? [];
        $this->total = $usersData['total_count'] ?? 0;

        if (isset($usersData['items'])) {
            $this->users = [];
            foreach ($usersData['items'] as $user) {
                $userDetails = Http::withToken(config('github.api_token'))->get($user['url'])->json();

                $userDetails['is_selected'] = $this->isSelected($userDetails['login']);

                $this->users[] = $userDetails;
            }
        }
    }

    private function isSelected($github_login)
    {
        return Developers::where('github_login', $github_login)->first() !== null ? true : false;
    }

    public function getTotalPagesProperty()
    {
        return ($this->total % $this->perPage) === 0 ? ($this->total / $this->perPage) : intdiv($this->total, $this->perPage) + 1;
    }

    protected function getQueryBuilder(): string
    {
        $queryBuilder = $this->getDeveloperTypeQuery();
        $queryBuilder .= $this->getFollowersQuery();
        $queryBuilder .= $this->getLocationsQuery();
        $queryBuilder .= $this->getLanguagesQuery();

        return str_ireplace('+', ' ', $queryBuilder);
    }

    public function getLanguageEnumsProperty()
    {
        return Languages::getKeyValuePairs();
    }

    protected function getLanguagesQuery(): mixed
    {
        if ($this->languages != null) {
            foreach ($this->languages as $key => $value) {
                $this->languagesQuery .= $value;
            }
            return $this->languagesQuery;
        }
        return null;
    }

    protected function getFollowersQuery(): mixed
    {
        if ($this->minFollowers > 0) {
            return '+followers:>=' . $this->minFollowers . '+sort:followers';
        }

        return null;
    }

    protected function getDeveloperTypeQuery(): mixed
    {
        return match ($this->developerType) {
            'user' => 'type:user',
            'org' => 'type:org',
            default => null,
        };
    }

    protected function getLocationsQuery(): mixed
    {
        if ($this->location === 'brasil') {
            return '+location:brasil+location:brazil+location:br';
        }

        return null;
    }

    public function nextPage()
    {
        if ($this->currentPage * $this->perPage < $this->total) {
            $this->currentPage++;
            $this->fetchDevelopers();
        }
    }

    public function previousPage()
    {
        if ($this->currentPage > 1) {
            $this->currentPage--;
            $this->fetchDevelopers();
        }
    }


    #[Title('Buscar Desenvolvedores')]
    public function render()
    {

        $paginator = new LengthAwarePaginator(
            $this->users,
            $this->total,
            $this->perPage,
            $this->currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        return view('livewire.dev-picker-front', [
            'users' => $paginator
        ]);
    }
}
