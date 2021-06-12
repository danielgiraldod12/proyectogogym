<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserRequest
 * @property int $id
 * @property string $typeOfIdentification
 * @property int $identification_num
 * @property string $name
 * @property string $email
 * @property int $id_record_num
 * @property int $id_training_program
 * @property int $id_training_center
 * @property string $password
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @package App\Models
 */

class UserRequest extends Model
{
    use HasFactory;

    /**
     * Los atributos que pueden ser rellenados masivamente.
     *
     * @var array
     */

    protected $fillable = [
        'name',
        'email',
        'password',
        'typeOfIdentification',
        'identification_num',
        'id_record_num',
        'id_training_program',
        'id_training_center'
    ];

    /***
     * Relacion 1 a muchos (inversa)
     */

    /**
     * A tabla Fichas
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function record_num(){
        return $this->belongsTo('App\Models\Record_num');
    }

    /**
     * A tabla programas
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function training_program(){
        return $this->belongsTo('App\Models\Training_program');
    }

    /**
     * A tabla centros
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function training_center(){
        return $this->belongsTo('App\Models\Training_center');
    }

    /**
     * Relacion 1 a muchos
     */

    /**
     * A tabla asistencias
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function asistencias(){
        return $this->hasMany('App\Models\Asist');
    }

    /**
     * A tabla eventos
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function eventos(){
        return $this->hasMany('App\Models\Event');
    }

}
