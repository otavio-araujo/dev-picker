<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Developer;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Http;
use Filament\Notifications\Notification;

class DevelopersResource extends Component
{

    use WithPagination;

    public $status;

    public $active = true;
    public $search = '';
    public $sortField;
    public $sortAsc = true;
    protected $queryString = ['search', 'sortAsc', 'sortField'];

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updateDeveloperStatus(Developer $developer, $developer_status)
    {

        $developer->status = $developer_status;
        $developer->save();
    }

    public function updateDeveloperRating(Developer $developer, $rating)
    {
        // dd($developer->rating->value, $rating);
        ($developer->rating->value === 1 && $rating === 1) ? $developer->rating = 0 : $developer->rating = $rating;
        $developer->save();
    }

    public function getDeveloperDetails($github_user_url)
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
            } else {
                return $userDetails;
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

    public function showDeveloperDetails($github_user_url = 'otavio-araujo')
    {
        $developerDetails = $this->getDeveloperDetails($github_user_url);

        $this->dispatch('show-developer-details', $developerDetails)->to(SlideOver::class);
    }

    #[Title('Desenvolvedores Selecionados')]
    public function render()
    {
        return view('livewire.developers-resource', [
            'developers' => Developer::where(function ($query) {
                $query->where('github_name', 'like', '%' . $this->search . '%')
                    ->orWhere('github_login', 'like', '%' . $this->search . '%');
            })
                ->when($this->sortField, function ($query) {
                    $query->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
                })->paginate(5),
        ]);
    }
}
