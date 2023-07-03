<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifciation extends Model
{
    use HasFactory;

    protected $fillable = [
        'notify_id',
        'notification',
    ];

    public function getNotificationCreateAttribute()
    {
            return "op";
    }

}
