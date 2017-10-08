<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    protected $table = 'room_types';
//    protected $fillable = ['name', 'description', 'built_in'];
    protected $guarded = ['id'];

    protected $hidden = ['created_at', 'updated_at', 'built_in'];

    /**
     * a type has many rooms
     */
    public function rooms()
    {
        return $this->hasMany('App\Model\Room', 'room_type_id');
    }
}
