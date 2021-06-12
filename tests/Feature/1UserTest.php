<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_factory()
    {
        $usersBefore = User::all()->count();
        $user = \App\Models\User::factory(2)->create();
        $usersAfter = User::all()->count();

        $this->assertEquals($usersBefore+2,$usersAfter);
    }
}
