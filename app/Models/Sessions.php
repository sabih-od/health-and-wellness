<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Sessions extends Model implements HasMedia
{
    use HasFactory , InteractsWithMedia;

    protected $fillable = [
        'name',
        'service_id',
        'fees',
        'date',
        'service',
        'session_time',
        'date',
        'status',
    ];

    protected $appends = ['session_image'];

    public function getSessionImageAttribute()
    {
        return $this->getMedia('session_images');
//        $image_check =  $this->getMedia('session_images')->first();
//        return $image_check ? $image_check->getUrl() : asset("dashboard/images/user.png");
    }

    public function get_session_picture()
    {
        $image_check =  $this->getMedia('session_images')->first();
        return $image_check ? $image_check->getUrl() : asset("dashboard/images/user.png");
    }

    public function bookSession()
    {
        return $this->hasMany(BookSession::class , 'session_id' , 'id');
    }

    public function sessionTimings()
    {
        return $this->hasMany(SessionTiming::class , 'session_id' , 'id');
    }

    public function sessionBookedTimings()
    {
        return $this->hasMany(SessionTiming::class , 'session_id' , 'id')->where('is_booked', 1);
    }

    public function sessionNotBookedTimings()
    {
        return $this->hasMany(SessionTiming::class , 'session_id' , 'id')->where('is_booked', 0);
    }

    public function service()
    {
        return $this->belongsTo('App\Models\Service' , 'service_id' , 'id');
    }

}
