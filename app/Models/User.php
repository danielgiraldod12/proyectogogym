<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
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
 * @function validateRoles
 * @package App\Models
 */

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    protected $guard_name = 'web';
    /**
     * Los atributos que pueden ser rellenados masivamente (factorys, seeders, etc).
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

    /**
     * Los atributos de la tabla usuarios que deberian estar escondidos en los arrays.
     *
     * @var array
     */
    protected $hidden = [
        'profile_photo_url',
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * Los atributos que desea castear a un tipo en especifico.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Agregar atributo del accesor al array del modelo.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function adminlte_profile_url(){
        return 'show';
    }

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

    /**
     * Recibe los roles de un usuario y verifica si en estos roles existe un rol con un nombre diferente al
     * de "Usuario", en caso de que si haya un rol diferente al de Usuario, retornara un true, de lo contrario
     * retornara un false.
     * exista
     * @param $roles
     * @return bool
     */
    public static function validateRoles($roles){
        foreach($roles->toArray() as $role){
            if($role['rol'] != 'Usuario'){
                return true;
            }
            return false;
        }
    }
}

