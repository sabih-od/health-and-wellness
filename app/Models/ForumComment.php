<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ForumComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'forum_topic_id',
        'content',
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

    public function forum_topic()
    {
        return $this->belongsTo('App\Models\ForumTopic');
    }
}
