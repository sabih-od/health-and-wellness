<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Faqs extends Model implements HasMedia
{
    use HasFactory , InteractsWithMedia;


    protected $fillable = [
        'user_id' ,
        'question',
        'answer',
    ];

    public function get_faq_picture()
    {
        $image_check =  $this->getMedia('faq_image')->first();
        return $image_check ? $image_check->getUrl() : asset("dashboard/images/user.png");
    }

}
