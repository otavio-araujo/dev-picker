<?php

namespace App\Livewire;

use Livewire\Component;
use App\Enums\Languages;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class DevPickerFront extends Component
{
    public $users;
    public $minFollowers = 5000;
    public $location = 'brasil';
    public $languages = [];
    public $perPage = 5;
    public $currentPage = 1;
    public $total = 0;
    protected $languagesQuery;

    public function searchDev()
    {
        $response = Http::get("https://api.github.com/search/users?{$this->getQueryBuilder()}");
        $data = $response->json();
        $this->users = $data['items'] ?? [];
        $this->total = $data['total_count'] ?? 0;
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
        return '&page=' . $this->currentPage;
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
            $this->searchDev();
        }
    }

    public function previousPage()
    {
        if ($this->currentPage > 1) {
            $this->currentPage--;
            $this->searchDev();
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
