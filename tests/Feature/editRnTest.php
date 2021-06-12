<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class editRnTest extends TestCase
{
    use WithoutMiddleware;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_editrn()
    {
        $response = $this->call('PUT','record_nums/update/3',[
            'id_training_program' => '2',
            'record_num' => '13131'
        ]);
        $response->assertStatus(302);
    }
}
