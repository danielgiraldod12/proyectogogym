<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Faker;
use Faker\Factory;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->type('email', 'daniskzo12@gmail.com')
                ->type('password', '12345678')
                ->click('.button-loggin')
                ->assertRouteIs('dashboard');
        });
    }

    public function testCreateUser()
    {

        $this->browse(function (Browser $browser) {
            $rand = rand(100, 200);
            $browser->loginAs(User::find(1))->visit('/users/create')
                ->type('identification_num', $rand)
                ->type('name', 'jose')
                ->type('email', 'daniskzo' . $rand . '@gmail.com')
                ->click('#button')
                ->assertSee('¡Usuario creado satisfactoriamente!');
        });
    }

    public function testEditUser()
    {
        $this->browse(function (Browser $browser) {
            $randId = rand(5, 40);
            $rand = rand(3000, 3100);
            $browser->loginAs(User::find(1))->visit('/users/edit/' . $randId)
                ->type('identification_num', $rand)
                ->type('name', 'jose')
                ->type('email', 'daniskzo' . $rand . '@gmail.com')
                ->click('#button')
                ->click('.swal2-confirm.swal2-styled')
                ->assertSee('¡Actualizacion de usuario satisfactoria!');
        });
    }

    public function testDeleteUser()
    {
        $this->browse(function (Browser $browser) {
            $randId = rand(10, 40);
            $user = User::query()->where('id',$randId)->first();
            $browser->loginAs(User::find(1))->visit('/users')
                ->script('deleteUser(' . $randId . ')');
                $browser->click('.swal2-confirm.swal2-styled')
                ->assertDontSee($user->email);
        });
    }

}
