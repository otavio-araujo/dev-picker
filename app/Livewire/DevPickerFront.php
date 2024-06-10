<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use League\CommonMark\Util\UrlEncoder;
use Livewire\Component;

class DevPickerFront extends Component
{
    public $search;
    public $users;

    public function searchDev()
    {
        $query = 'q=type:user+followers:>=500+sort:followers+location:brasil+location:brazil+location:br+language:php+language:css+language:html+language:js+language:javascript';
        $response = Http::get("https://api.github.com/search/users?{$query}");
        $this->users = $response->json()['items'] ?? [];
    }



    public function render()
    {
        return view('livewire.dev-picker-front');
    }
}
