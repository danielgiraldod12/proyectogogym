<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);

//        $response = $this->call('POST','crearrn',
//            [
//                'id_training_program' => '1',
//                'record_num' => '211111'
//            ]);
//
//        $response->assertStatus(302);
    }
}
