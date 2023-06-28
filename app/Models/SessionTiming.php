<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class SessionTiming extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'session_time',
        'is_booked',
    ];

    public function timingBookSession()
    {
        return $this->hasMany(BookSession::class);
    }

    public function session()
    {
        return $this->belongsTo(Sessions::class);
    }

    public function authenticateTimingBookSession()
    {
        return $this->hasMany(BookSession::class)->where('user_id', auth()->user()->id);
    }

}
