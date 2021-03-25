<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'daniel',
            'typeOfIdentification' => 'T.I',
            'identification_num' => '1001227025',
            'email' => 'daniskzo12@gmail.com',
            'id_record_num' => '1',
            'id_training_program' => '1',
            'id_training_center' => '1',
            'password' => bcrypt('12345678')
        ])->assignRole('Administrador');

        User::create([
            'name'=>'danielg',
            'typeOfIdentification' => 'T.I',
            'identification_num' => '1001224025',
            'email' => 'daniskzo13@gmail.com',
            'id_record_num' => '1',
            'id_training_program' => '1',
            'id_training_center' => '1',
            'password' => bcrypt('12345678')
        ]);

        User::factory(150)->create();

    }
}
