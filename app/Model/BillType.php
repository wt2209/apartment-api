<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BillType extends Model
{
    protected $table = 'bill-types';
    protected $hidden = ['created_at', 'updated_at'];

}
