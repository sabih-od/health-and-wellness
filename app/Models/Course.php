<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Course extends Model implements HasMedia
{
    use HasFactory ,InteractsWithMedia;


    protected $fillable = [
        'category_id',
        'course_title',
        'course_description',
        'time_detail',
        'price',
        'course_attachment',
    ];

    public function get_course_attachment()
    {
        $image_check =  $this->getMedia('course_attachment')->first();
        return $image_check ? $image_check->getUrl() : asset("images/service.webp");
    }
}
