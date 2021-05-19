<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use App\Models\UserRequest;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {

//        Validator::make($input, [
//            'name' => ['required', 'string', 'max:100'],
//            'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
//            'password' => $this->passwordRules(),
//        ])->validate();

        return UserRequest::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'typeOfIdentification' => $input['typeOfIdentification'], //tipo doc
            'identification_num' => $input['identification_num'], //documento id
            'id_record_num' => $input['id_record_num'], //ficha
            'id_training_program' => $input['id_training_program'], //programa
            'id_training_center' => $input['id_training_center'], //centro
            'password' => Hash::make($input['password']),
        ]);
    }
}
