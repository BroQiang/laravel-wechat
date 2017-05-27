<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poster extends Model
{
    protected $fillable = [
        'name',
        'key',
        'get_message',
        'subscribe_message',
        'success_message',
        'end_message',
        'end_time',
        'number',
        'is_send',
    ];
}
