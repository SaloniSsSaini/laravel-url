<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\ShortUrl;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RedirectTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function short_url_is_not_publicly_resolvable()
    {
        $url = ShortUrl::factory()->create([
            'short_code' => 'abc123',
            'original_url' => 'https://google.com'
        ]);

        $this->get('/abc123')
            ->assertStatus(404); // Should NOT redirect
    }
}
