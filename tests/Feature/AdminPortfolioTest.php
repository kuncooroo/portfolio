<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPortfolioTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_login(): void
    {
        $this->get('/admin')->assertRedirect('/admin/login');
    }

    public function test_login_rejects_invalid_credentials(): void
    {
        $user = User::factory()->create();

        $this->post('/admin/login', [
            'email' => $user->email,
            'password' => 'not-the-password',
        ])->assertSessionHasErrors('email');
    }

    public function test_admin_can_publish_a_project_on_the_homepage(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post(route('admin.projects.store'), [
            'title' => 'Proyek Uji',
            'subtitle' => 'Edukasi',
            'year' => '2026',
            'is_visible' => '1',
        ])->assertRedirect(route('admin.projects.index'));

        $this->assertDatabaseHas('projects', ['title' => 'Proyek Uji']);
        $this->get('/')->assertOk()->assertSee('Proyek Uji');

        $project = Project::query()->where('title', 'Proyek Uji')->first();
        $this->actingAs($user)->delete(route('admin.projects.destroy', $project))
            ->assertRedirect(route('admin.projects.index'));

        $this->assertDatabaseMissing('projects', ['title' => 'Proyek Uji']);
    }

    public function test_seeded_admin_can_open_the_dashboard(): void
    {
        $this->seed();

        $this->post('/admin/login', [
            'email' => 'nayla@portfolio.test',
            'password' => 'Senyum#2026',
        ])->assertRedirect(route('admin.dashboard'));

        $this->get('/admin')->assertOk()->assertSee('Nabila Mutiara Agung Saputri');
        $this->get('/')->assertOk()->assertSee('Universitas Jember')->assertSee('Grobogan')->assertSee('Kedokteran Gigi');
    }
};
