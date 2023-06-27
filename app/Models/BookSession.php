<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookSession extends Model
{
    use HasFactory;


    protected $fillable=[
        'user_id',
        'name',
        'email',
        'address',
        'phone_number',
        'session_id',
        'session_timing_id',
        'detail',
        'status',
        'payment_status',
        'txnid'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function session()
    {
        return $this->belongsTo('App\Models\Sessions');
    }

    public function sessionTiming()
    {
        return $this->belongsTo('App\Models\SessionTiming');
    }

//    public function service()
//    {
//        return $this->belongsTo('App\Models\Service');
//    }
}
