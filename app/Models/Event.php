<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Event
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $state
 * @property int $id_user
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @package App\Models
 */

class Event extends Model
{
    use HasFactory;

    /**
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


