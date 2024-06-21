<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Developer;
use Filament\Actions\Action;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Http;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Actions\Concerns\InteractsWithActions;

class DevelopersResource extends Component implements HasForms, HasActions
{

    use WithPagination;
    use InteractsWithActions;
    use InteractsWithForms;

    public $status;

    public $active = true;
    public $search = '';
    public $sortField;
    public $sortAsc = true;
    protected $queryString = ['search', 'sortAsc', 'sortField'];

    public function deleteAction(): Action
    {
        return Action::make('delete')
            ->action(function (array $arguments) {
                $developer = Developer::find($arguments['developer']);

                $developer?->delete();

                Notification::make()
                    ->title('Feito!')
                    ->body('O desenvolvedor <b>' . $developer->github_name . '</b> foi removido com sucesso.')
                    ->success()
                    ->color('success')
                    ->send();
            })
            ->requiresConfirmation()
            ->label('Remover Desenvolvedor')
            ->icon('heroicon-o-trash')
            ->iconButton()
            ->color('danger')
            ->modalDescription('Você tem certeza que quer remover o desenvolvedor?');
    }

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
