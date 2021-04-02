<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $guard_name = 'web';

    protected $fillable = [
        'name',
        'email',
        'password',
        'typeOfIdentification',
        'identification_num',
        'id_record_num',
        'id_training_program',
        'id_training_center',
        'id_rol',
    ];

    /**
     * The attributes that should be hidden for arrays.
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function adminlte_profile_url(){
        return 'show';
    }

    //Relacion uno a muchos (inversa)
    public function record_num(){
        return $this->belongsTo('App\Models\Record_num');
    }
    public function training_program(){
        return $this->belongsTo('App\Models\Training_program');
    }
    public function training_center(){
        return $this->belongsTo('App\Models\Training_center');
    }

    //Relacion uno a muchos
    public function asistencias(){
        return $this->hasMany('App\Models\Asist');
    }
    public function eventos(){
        return $this->hasMany('App\Models\Event');
    }

    /**
     * @param Builder $query
     * @param $roles
     * @param null $guard
     * @return Builder
     * how to use it:
     * $users = User::notRole('Admin')->get();
     * $users = User::notRole(['Admin', 'Super Admin'])->get();
     */

    public function scopeNotRole(Builder $query, $roles, $guard = null): Builder
    {
        if ($roles instanceof Collection) {
            $roles = $roles->all();
        }

        if (! is_array($roles)) {
            $roles = [$roles];
        }

        $roles = array_map(function ($role) use ($guard) {
            if ($role instanceof Role) {
                return $role;
            }

            $method = is_numeric($role) ? 'findById' : 'findByName';
            $guard = $guard ?: $this->getDefaultGuardName();

            return $this->getRoleClass()->{$method}($role, $guard);
        }, $roles);

        return $query->whereHas('roles', function ($query) use ($roles) {
            $query->where(function ($query) use ($roles) {
                foreach ($roles as $role) {
                    $query->where(config('permission.table_names.roles').'.id', '!=' , $role->id);
                }
            });
        });
    }


}

