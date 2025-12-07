<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShortUrlRestrictionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function superadmin_cannot_create_short_url()
    {
        $user = User::factory()->create(['role' => 'SuperAdmin']);

        $this->actingAs($user)
            ->post('/urls', ['original_url' => 'https://google.com'])
            ->assertStatus(403);
    }

    /** @test */
    public function admin_cannot_create_short_url()
    {
        $company = Company::factory()->create();

        $user = User::factory()->create([
            'role' => 'Admin',
            'company_id' => $company->id,
        ]);

        $this->actingAs($user)
            ->post('/urls', ['original_url' => 'https://google.com'])
            ->assertStatus(403);
    }

    /** @test */
    public function member_cannot_create_short_url()
    {
        $company = Company::factory()->create();

        $user = User::factory()->create([
            'role' => 'Member',
            'company_id' => $company->id,
        ]);

        $this->actingAs($user)
            ->post('/urls', ['original_url' => 'https://google.com'])
            ->assertStatus(403);
    }
}
