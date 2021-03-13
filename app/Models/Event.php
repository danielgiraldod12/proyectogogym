<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

//    protected $dates = ['date';
//
//    /**
//     * Get the event's id number
//     *
//     * @return int
//     */
//    public function getId() {
//        return $this->id;
//    }
//
//    /**
//     * Get the event's title
//     *
//     * @return string
//     */
//    public function getTitle()
//    {
//        return $this->title;
//    }
//
//    /**
//     * Is it an all day event?
//     *
//     * @return bool
//     */
//    public function isAllDay()
//    {
//        return (bool)$this->all_day;
//    }
//
//    /**
//     * Get the start time
//     *
//     * @return DateTime
//     */
//    public function getSDate()
//    {
//        return $this->date;
//    }


    //Relacion uno a muchos (inversa)
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}


