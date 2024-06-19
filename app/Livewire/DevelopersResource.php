<?php

namespace App\Livewire;

use App\Models\Developer;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

class DevelopersResource extends Component
{

    use WithPagination;

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
                })->paginate(10),
        ]);
    }
}
