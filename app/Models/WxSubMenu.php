<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WxSubMenu extends Model
{
    protected $fillable = [
        'name', 'type', 'action', 'wx_menu_id',
    ];
}
