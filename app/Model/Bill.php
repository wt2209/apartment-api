<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Bill
 * @package App\Model
 */
class Bill extends Model
{
    /**
     * the field 'items' will convert between json type and array type automatically
     * @var array
     */
    protected $casts = [
        'items' => 'array',
    ];
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
