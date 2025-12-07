<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\ShortUrl;
use App\Models\User;
use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShortUrlTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function short_url_belongs_to_company_and_user()
    {
        $company = Company::factory()->create();
        $user = User::factory()->create(['company_id' => $company->id]);

        $url = ShortUrl::factory()->create([
            'created_by' => $user->id,
            'company_id' => $company->id
        ]);

        $this->assertEquals($company->id, $url->company->id);
        $this->assertEquals($user->id, $url->creator->id);
    }
}
