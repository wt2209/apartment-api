<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    /**
     * a person belongs to a room
     */
    public function room()
    {
        return $this->belongsTo('App\Model\Room');
    }

    /**
     * a person has many bills
     */
    public function bills()
    {
        return $this->hasMany('App\Model\Bill', 'person_id');
    }
}
