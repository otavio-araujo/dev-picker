<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Filament\Actions\Action;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Filament\Actions\ViewAction;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Spatie\Permission\Models\Permission;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Actions\Concerns\InteractsWithActions;

class UsersResource extends Component implements HasForms, HasActions
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

    public function createFormAction(): Action
    {
        return Action::make('createFormAction')
            ->label('Cadastrar novo usuário')
            ->color('info')
            ->form([
                TextInput::make('name')
                    ->translateLabel()
                    ->required(),
                TextInput::make('email')
                    ->translateLabel()
                    ->required()
                    ->unique(column: 'email'),
                TextInput::make('password')
                    ->translateLabel()
                    ->required()
                    ->password()
                    ->minLength(8)
                    ->confirmed()
                    ->revealable(),
                TextInput::make('password_confirmation')
                    ->label('Confirmação de senha')
                    ->required()
                    ->password()
                    ->minLength(8)
                    ->revealable(),
                Select::make('role_id')
                    ->label('Tipo de usuário')
                    ->required()
                    ->extraAttributes(['class' => 'capitalize'])
                    ->options(Role::query()->pluck('name', 'name'))
                    ->native(false),
                Select::make('permissions')
                    ->translateLabel()
                    ->extraAttributes(['class' => 'capitalize'])
                    ->options(Permission::query()->pluck('name', 'name'))
                    ->multiple()
                    ->searchable()
                    ->native(false)
                    ->required(),
            ])
            ->action(function (array $data): void {

                if (Gate::check('create user') === false) {
                    Notification::make()
                        ->title('404 - Permissão Negada!')
                        ->body("Você não tem autorização para criar usuários.")
                        ->warning()
                        ->color('warning')
                        ->send();
                } else {
                    $user = User::create([
                        'name' => $data['name'],
                        'email' => $data['email'],
                        'password' => Hash::make($data['password']),
                    ]);
                    $user->assignRole($data['role_id']);
                    $user->givePermissionTo($data['permissions']);

                    Notification::make()
                        ->title('Feito!')
                        ->body("Usuário cadastrado com sucesso!")
                        ->success()
                        ->color('success')
                        ->send();
                }
            })
            ->modalSubmitActionLabel('Salvar Dados')
            ->slideOver();
    }

    public function viewAction(): Action
    {
        return ViewAction::make('view')
            ->record(function (array $arguments) {
                $user = User::find($arguments['user']);
                return $user;
            })
            ->mutateRecordDataUsing(function (array $data): array {
                $user = User::find($data['id']);
                $data['role'] = $user->roles()->first()->name;
                $permissions = $user->getAllPermissions()->pluck('name', 'name')->toArray();
                $data['permissions'] = $permissions;
                return $data;
            })
            ->form([
                TextInput::make('name'),
                TextInput::make('email'),
                TextInput::make('role')
                    ->extraInputAttributes(['class' => 'capitalize'])
                    ->label('Tipo de usuário'),
            ])
            ->label('Detalhar Usuário')
            ->icon('heroicon-o-eye')
            ->iconButton()
            ->color('info')
            ->modalHeading('Detalhes do usuário')
            ->slideOver();
    }

    public function deleteAction(): Action
    {
        return Action::make('delete')
            ->action(function (array $arguments) {

                if (Gate::check('delete user') === false) {
                    Notification::make()
                        ->title('404 - Permissão Negada!')
                        ->body("Você não tem autorização para apagar usuários.")
                        ->warning()
                        ->color('warning')
                        ->send();
                } else {
                    $user = User::find($arguments['user']);

                    $user?->delete();

                    Notification::make()
                        ->title('Feito!')
                        ->body('O usuário <b>' . $user->name . '</b> foi removido com sucesso.')
                        ->success()
                        ->color('success')
                        ->send();
                }
            })
            ->requiresConfirmation()
            ->label('Remover Usuário')
            ->icon('heroicon-o-trash')
            ->iconButton()
            ->color('danger')
            ->modalDescription('Você tem certeza que quer remover o usuário?');
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

    public function mount()
    {
        if (Gate::check('view user') === false) {
            Notification::make()
                ->title('404 - Permissão Negada!')
                ->body("Você não tem autorização para acessar este recurso.")
                ->warning()
                ->color('warning')
                ->send();
            $this->redirect(DevPickerFront::class);
        }
    }

    #[Title('Cadastro de Usuários')]
    public function render()
    {

        return view('livewire.users-resource', [
            'users' => User::where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            })->with('roles')
                ->when($this->sortField, function ($query) {
                    $query->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
                })->paginate(5),
        ]);
    }
}
