<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Company;
use App\Models\ShortUrl;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UrlVisibilityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_sees_only_urls_not_in_their_company()
    {
        $companyA = Company::factory()->create();
        $companyB = Company::factory()->create();

        $admin = User::factory()->create([
            'role' => 'Admin',
            'company_id' => $companyA->id,
        ]);

        ShortUrl::factory()->create([
            'company_id' => $companyA->id,   // SHOULD NOT BE VISIBLE
        ]);

        ShortUrl::factory()->create([
            'company_id' => $companyB->id,   // SHOULD BE VISIBLE
        ]);

        $this->actingAs($admin)
            ->get('/urls')
            ->assertSee($companyB->name)
            ->assertDontSee($companyA->name);
    }

    /** @test */
    public function member_sees_only_urls_not_created_by_themself()
    {
        $company = Company::factory()->create();

        $member = User::factory()->create([
            'role' => 'Member',
            'company_id' => $company->id,
        ]);

        ShortUrl::factory()->create([
            'created_by' => $member->id,  // SHOULD NOT BE VISIBLE
        ]);

        $otherUser = User::factory()->create([
            'company_id' => $company->id,
        ]);

        ShortUrl::factory()->create([
            'created_by' => $otherUser->id,  // SHOULD BE VISIBLE
        ]);

        $this->actingAs($member)
            ->get('/urls')
            ->assertDontSee($member->id)
            ->assertSee($otherUser->id);
    }
}
