<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_accepted_response()
    {
        $response = $this->withHeaders([
            'X-Mock-Status' => 'accepted',
        ])->post('/mock-response');

        $response->assertStatus(200);
        $response->assertJson(['status' => 'accepted']);
    }

    /** @test */
    public function it_returns_failed_response()
    {
        $response = $this->withHeaders([
            'X-Mock-Status' => 'failed',
        ])->post('/mock-response');

        $response->assertStatus(400);
        $response->assertJson(['status' => 'failed']);
    }
}
