<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
//    protected $fillable = ['room_type_id', 'status', 'display_name', 'building', 'unit', 'room', 'person_number', 'history_record', 'remark'];
    protected $guarded = ['id'];

    protected $hidden = ['created_at', 'updated_at', 'room_type_id', 'building', 'unit', 'room'];

    /**
     * a room belongs to a type
     */
    public function type()
    {
        return $this->belongsTo('App\Model\RoomType', 'room_type_id');
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

    public function getStatusAttribute($value)
    {
        return $value == 0 ? '空置' : '正在使用';
    }
}
