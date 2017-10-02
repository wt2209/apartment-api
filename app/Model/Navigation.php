<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Navigation extends Model
{
    public $fillable = ['name', 'display_name', 'url', 'icon', 'parent_id'];
    public $hidden = ['created_at', 'updated_at'];
}
