<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmsPage extends Model
{
    use HasFactory;

    protected $table = 'cms_pages';

    protected $casts = [
        'page_title' => 'string',
        'url_key' => 'string',
        'meta_title' => 'string',
        'meta_description' => 'string',
        'meta_keywords' => 'string',
    ];

    protected $fillable = [
        'page_title',
        'url_key',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    public function sections() {
        return $this->hasMany(CmsPageSection::class, 'cms_page_id', 'id');
    }

}
