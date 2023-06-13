<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Testimonial extends Model implements HasMedia
{
    use HasFactory , InteractsWithMedia;

    protected $fillable = [
        'user_id' ,
        'name',
        'description',
        'job_title',
    ];

    public function get_testimonial_picture()
    {
        $image_check =  $this->getMedia('testimonial_image')->first();
        return $image_check ? $image_check->getUrl() : asset("dashboard/images/user.png");
    }
}
