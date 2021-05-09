<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Record_num
 * @property int $id
 * @property int $record_num
 * @property int $id_training_program
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @package App\Models
 */

class Record_num extends Model
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
     * Relacion 1 a muchos (inversa)
     */

    /**
     * A tabla programas
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function training_program(){
        return $this->belongsTo('App\Models\Training_program');
    }
}
