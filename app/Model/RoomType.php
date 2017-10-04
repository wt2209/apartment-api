<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{

//    protected $fillable = ['name', 'description', 'built_in'];
    protected $guarded = ['id'];

    /**
     * a type has many rooms
     */
    public function rooms()
    {
        return $this->hasMany('App\Model\Room', 'room_type_id');
    }
}
