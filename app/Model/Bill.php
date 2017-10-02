<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    /**
     * TODO a bill may not has a person_id, is that OK ???
     * need some test
     */
    public function person()
    {
        return $this->belongsTo('App\User', 'person_id');
    }

    /**
     * TODO a bill may not has a room_id, is that OK ???
     * need some test
     */
    public function room()
    {
        return $this->belongsTo('App\Model\Room');
    }
}
