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
        'service_id',
        'session_id',
        'detail',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function session()
    {
        return $this->belongsTo('App\Models\Session');
    }

    public function service()
    {
        return $this->belongsTo('App\Models\Service');
    }
}
