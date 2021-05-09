<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Asist
 * @property int $id
 * @property int $id_user
 * @property string $name
 * @property int $record_num
 * @property string $createdBy
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @package App\Models
 */

class Asist extends Model
{
    use HasFactory;

    /***
     * Relacion 1 a muchos (inversa)
     */

    /**
     * A tabla usuarios
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
