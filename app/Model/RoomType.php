<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    /**
     * a type has many rooms
     */
    public function rooms()
    {
        return $this->hasMany('App\Model\Room', 'room_type_id');
    }
}
