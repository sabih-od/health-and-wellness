<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ForumTopic extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id',
        'forum_category_id',
        'description',
    ];

    public static function boot() {

        parent::boot();

        static::creating(function($query) {
            $query->user_id = Auth::id();
        });
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function forum_category()
    {
        return $this->belongsTo('App\Models\ForumCategory');
    }

    public function forum_comments()
    {
        return $this->hasMany('App\Models\ForumComment')->orderBy('created_at', 'DESC');
    }
}
