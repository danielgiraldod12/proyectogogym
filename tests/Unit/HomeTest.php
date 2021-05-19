<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Record_num;

class HomeTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

//        $this->assertAuthenticated($guard = null);

        $response = new Record_num();

        $response->id_training_program = 1;
        $response->record_num = 201621;
        $response->save();

        $response->assertOk();
    }
}
