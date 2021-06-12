<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class createRnTest extends TestCase
{
    use WithoutMiddleware;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_creatern()
    {
        $response = $this->call('POST','crearrn',
            [
                'id_training_program' => '1',
                'record_num' => '42'
            ]);

        $response->assertStatus(302);
    }
}
