<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmsPageSection extends Model
{
    use HasFactory;

    protected $table = 'cms_page_sections';

    protected $casts = [
        'content' => 'json'
    ];

    protected $fillable = [
        'content',
        'slug',
        'cms_page_id',
    ];

    public function page() {
        return $this->belongsTo(CmsPage::class);
    }

}
