<?php

namespace App\Livewire;

use Livewire\Component;
use App\Enums\Languages;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\WithPagination;

class DevPickerFront extends Component
{
    use WithPagination;

    public $users = [];
    public $minFollowers = 500;
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
                $this->users[] = $userDetails;
            }
        }
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
