<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Service extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name',
        'description',
        'pricing_detail',
    ];

    public function getImageUrl()
    {
        return $this->getMedia('service_images')->first() ? $this->getMedia('service_images')->first()->getUrl() : asset('images/service.webp');
    }

    public function get_service_picture()
    {
        $image_check =  $this->getMedia('service_images')->first();
        return $image_check ? $image_check->getUrl() : asset("images/service.webp");
    }

}
