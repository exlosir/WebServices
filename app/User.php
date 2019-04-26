<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
//    protected $fillable = [
//        'name', 'email', 'password','login', 'confirmed_email_token', 'email_verified_at'
//    ];

    protected $guarded = [];

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
        'image'=>'array',
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

    public function getEmailConfirmationToken() {

        $this->update([
            'confirmed_email_token'=> $token = Str::random()
        ]);

        return $token;
    }


    public function confirmEmail() {
        $this->update([
            'confirmed_email_token' => null,
            'is_confirmed_email'=> 1,
            'email_verified_at' => \Carbon\Carbon::now()
        ]);

        return $this;
    }

    public function confirmedPhone() {
        return !! $this->is_confirmed_phone;
    }

    public function deleteAccount() {
        return $this->delete();
    }




}


