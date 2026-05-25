<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectFeatureTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test bahwa halaman login mengembalikan status HTTP 200.
     */
    public function test_login_page_returns_http_200(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    /**
     * Test bahwa route redirect Google SSO mengembalikan status HTTP 302.
     */
    public function test_google_redirect_returns_http_302(): void
    {
        $response = $this->get('/auth/google');

        $response->assertStatus(302);
    }
}
