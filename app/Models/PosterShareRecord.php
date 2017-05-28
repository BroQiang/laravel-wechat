<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PosterShareRecord extends Model
{
    protected $fillable = ['poster_id', 'share_user_openid', 'scan_user_openid'];
}
