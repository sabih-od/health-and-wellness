<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    protected $table = "cities";

    protected $fillable = ['name','state_id', 'country_id', 'county_id', 'state_code', 'country_code', 'latitude', 'longitude'];

    public function county()
    {
        return $this->belongsTo(Counties::class, 'county_id', 'id');
    }
}
