<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class GitHubApi extends Component
{
    public $query = 'q=type:user';
    public $language = '';
    public $location = '';
    public $followers = 0;
    public $perPage = 5;
    public $page = 1;
    public $users = [];

    protected $listeners = ['search'];

    public function search()
    {
        $this->page = 1;
        $this->fetchUsers();
    }

    public function fetchUsers()
    {
        // Build search query
        $queryParts = [];
        if ($this->query) {
            $queryParts[] = $this->query;
        }
        if ($this->language) {
            $queryParts[] = 'language:' . $this->language;
        }
        if ($this->location) {
            $queryParts[] = 'location:' . $this->location;
        }
        if ($this->followers) {
            $queryParts[] = 'followers:>' . $this->followers;
        }
        $query = implode('+', $queryParts);

        // dd($query);

        // Fetch users from GitHub
        $response = Http::withToken(config('github.api_token'))->get('https://api.github.com/search/users', [
            'q' => $query,
            'per_page' => $this->perPage,
            'page' => $this->page,
        ]);

        $users = $response->json();

        $this->users = [];
        if (isset($users['items'])) {
            foreach ($users['items'] as $user) {
                $userDetails = Http::withToken(config('github.api_token'))->get($user['url'])->json();
                $this->users[] = $userDetails;
            }
        }
    }

    public function nextPage()
    {
        $this->page++;
        $this->fetchUsers();
    }

    public function previousPage()
    {
        if ($this->page > 1) {
            $this->page--;
            $this->fetchUsers();
        }
    }
    public function render()
    {
        return view('livewire.git-hub-api', [
            'users' => $this->users,
        ]);
    }
}
