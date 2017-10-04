<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Navigation extends Model
{
//    protected $fillable = ['name', 'display_name', 'url', 'icon', 'parent_id'];
    protected $guarded = ['id'];
    protected $hidden = ['created_at', 'updated_at'];
}
