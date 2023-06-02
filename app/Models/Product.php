<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'user_id',
        'category_id',
        'state_id',
        'city_id',
        'title',
        'price',
        'description',
        'zipcode',
        'condition',
        'is_approved',
        'is_sold',
        'show_name',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function category() {
        return $this->belongsTo('App\Models\ProductCategory', 'category_id', 'id');
    }

    public function state()
    {
        return $this->belongsTo('App\Models\States', 'state_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\Cities', 'city_id', 'id');
    }

    public function get_first_image()
    {
        return $this->getMedia('product_images')->first() ? $this->getMedia('product_images')->first()->getUrl() : asset('front/images/adven-1.png');
    }

    public function get_all_images()
    {
        return $this->getMedia('product_images');
    }
}
