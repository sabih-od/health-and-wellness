<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class States extends Model
{
    protected $table = "states";

    protected $fillable = ['name', 'country_id'];


    public function country(){
        return $this->belongsTo(Countries::class,'country_id','id');
    }

    public function counties()
    {
        return $this->hasMany(Counties::class, 'state_id', 'id');
    }

    public function business_state()
    {
        return $this->hasOne(BusinessState::class, 'state_id', 'id');
    }
}
