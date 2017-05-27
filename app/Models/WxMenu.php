<?php

namespace App\Models;

use App\Models\WxSubMenu;
use Illuminate\Database\Eloquent\Model;

class WxMenu extends Model
{
    protected $fillable = [
        'name', 'type', 'action',
    ];

     protected $guarded = [];

    public function wxSubMenu()
    {
        return $this->hasMany('App\Models\WxSubMenu');
    }
}
