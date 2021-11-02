<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PrescriptionTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_required_fields()
    {
        $response = $this->post('/api/prescriptions');
        $response->assertStatus(422);
    }

    public function test_full_request()
    {
        $response = $this->json('POST', '/api/prescriptions', ['clinic' => ['id'=> 1],'physician' => ['id'=> 1],'patient' => ['id'=> 1],'text'=>"Dipirona 1x ao dia"]);
        $response->assertStatus(200);
    }
}
