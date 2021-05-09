<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Training_program
 * @property int $id
 * @property string $name_program
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @package App\Models
 */
class Training_program extends Model
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
     * A tabla fichas
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function record_nums(){
        return $this->hasMany('App\Models\Record_num');
    }
}
