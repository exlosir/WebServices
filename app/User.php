<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','login'
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

    public function gender() {
        return $this->belongsTo(Gender::class,'gender_id','id');
    }

    public function city() {
        return $this->belongsTo(City::class,'city_id','id');
    }

    public function country() {
        return $this->belongsTo(Country::class,'country_id','id');
    }

    public function confirmedEmail() {
        return !! $this->is_confirmed_email;
    }

    public function confirmedPhone() {
        return !! $this->is_confirmed_phone;
    }
}
