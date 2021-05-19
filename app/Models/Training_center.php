<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Training_center
 * @property int $id
 * @property string $name_center
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @package App\Models
 */

class Training_center extends Model
{
    use HasFactory;

    /**
     * Relacion 1 a muchos
     */

    /**
     * A tabla usuarios
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users(){
        return $this->hasMany('App\Models\User');
    }

    /**
     * A tabla solicitud de usuarios
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function request_users(){
        return $this->hasMany('App\Models\UserRequest');
    }


}
