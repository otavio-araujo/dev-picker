<?php

namespace App\Livewire;

use App\Enums\Languages;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class DevPickerFront extends Component
{
    public $users;
    public $minFollowers = 5000;
    public $location = 'brasil';
    public $languages = [];
    public $perPage = 100;
    public $page = 1;
    protected $languagesQuery;

    public function searchDev()
    {
        $response = Http::get("https://api.github.com/search/users?{$this->getQueryBuilder()}");

        dd($response->json());

        $this->users = $response->json()['items'] ?? [];

        dd($this->users);
    }

    protected function getQueryBuilder(): string
    {
        $queryBuilder = 'q=type:user';
        $queryBuilder .= $this->getFollowersQuery();
        $queryBuilder .= $this->getLocationsQuery();
        $queryBuilder .= $this->getLanguagesQuery();
        $queryBuilder .= $this->getPerPageQuery();
        $queryBuilder .= $this->getPageQuery();

        return $queryBuilder;
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

    protected function getPerPageQuery(): mixed
    {
        return '&per_page=' . $this->perPage;
    }

    protected function getPageQuery(): mixed
    {
        return '&page=' . $this->page;
    }

    protected function getLocationsQuery(): mixed
    {
        if ($this->location === 'brasil') {
            return '+location:brasil+location:brazil+location:br';
        }

        return null;
    }

    public function render()
    {
        return view('livewire.dev-picker-front');
    }
}
