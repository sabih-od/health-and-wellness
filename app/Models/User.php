<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia
{
    use HasFactory, Notifiable, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'first_name',
        'last_name',
        'phone',
        'city',
        'zip',
        'fax',
        'address',
        'bio',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function get_profile_picture()
    {
        $image_check =  $this->getMedia('user_profile_pictures')->first();
        return $image_check ? $image_check->getUrl() : asset("dashboard/images/user.png");
    }

    public function getMultiSelectPresentableData($column) {
        $string = '';

        if(!str_contains(strval($this->$column), '[')) {
            return strval($this->$column);
        }

        $results = json_decode($this->$column);
        foreach ($results as $key => $result) {
            $string .= $result . (($key === array_key_last($results)) ? '.' : ', ');
        }

        return $string;
    }
}
