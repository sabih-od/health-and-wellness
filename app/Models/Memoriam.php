<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @property mixed $birth
 */
class Memoriam extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name',
        'birth',
        'age',
        'death',
        'description',
    ];

    public function getMemorianAgeAttribute(): int
    {
        return Carbon::parse($this->birth)->age;
    }
}
