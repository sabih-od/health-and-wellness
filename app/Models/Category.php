<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Category extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name',
        'main_category',
    ];

    public function getImageUrl()
    {
        return $this->getMedia('category_images')->first() ? $this->getMedia('category_images')->first()->getUrl() : asset('front/images/card1.png');
    }
}
