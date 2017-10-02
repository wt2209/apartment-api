<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    /**
     * a room belongs to a type
     */
    public function type()
    {
        return $this->belongsTo('App\Model\RoomType');
    }

    /**
     * a room has many people
     */
    public function people()
    {
        return $this->hasMany('App\Model\Person');
    }

    /**
     * a room has many bills
     */
    public function bills()
    {
        return $this->hasMany('App\Model\Bill');
    }
}
