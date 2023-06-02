<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function forumTopics()
    {
        return $this->hasMany('App\Models\ForumTopic');
    }
}
