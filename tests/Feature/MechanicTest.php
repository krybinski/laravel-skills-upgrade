<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MechanicTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_fetch_all_mechanics()
    {
        $response = $this->get('/api/v1/mechanics');

        $response->assertStatus(200);
    }
}
