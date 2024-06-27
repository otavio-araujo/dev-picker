<?php

namespace Tests\Feature;

use App\Livewire\DeveloperNotesModal;
use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Livewire\SlideOver;
use App\Livewire\DevPickerFront;
use function Pest\Laravel\{actingAs};
use Illuminate\Foundation\Testing\RefreshDatabase;

class DevpickerFrontTest extends TestCase
{
    use RefreshDatabase;

    public function test_devpickerfront_component_can_be_rendered(): void
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(DevPickerFront::class)
            ->assertStatus(200);
    }

    public function test_devpickerfront_has_the_search_form_and_no_developers_found(): void
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(DevPickerFront::class)
            ->assertStatus(200)
            ->assertSeeHtml('<form wire:submit="searchDev">')
            ->assertSee("Nenhum desenvolvedor encontrado");
    }
}
