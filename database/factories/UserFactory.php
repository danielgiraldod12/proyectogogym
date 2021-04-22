<?php

namespace Database\Factories;

use App\Models\Record_num;
use App\Models\Training_center;
use App\Models\Training_program;
use App\Models\User;
use Carbon\Carbon as CarbonCarbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'name' => $this->faker->name,
            'typeOfIdentification' => $this->faker->randomElement(['T.I','C.C','Pasaporte','Carnet de Extranjeria']),
            $identification_num = 'identification_num' => $this->faker->unique()->randomNumber,
            'email' => $this->faker->unique()->safeEmail,
            'id_record_num' => function (){
            return Record_num::all()->random()->id;
            },
            'id_training_program' =>function (){
                return Training_program::all()->random()->id;
            },
            'id_training_center'=>function (){
                return Training_center::all()->random()->id;
            },
            'created_at' => $this->faker->date("2020-m-d H:i:s"),
            'password' => bcrypt($identification_num), // password

        ];
    }
}
