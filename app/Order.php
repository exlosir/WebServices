<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    public function user() {
        return $this->belongsTo(User::class,'customer_id','id');
    }

    public function status() {
        return $this->hasOne(Status::class, 'id', 'status_id');
    }

    public function location() {
        if(empty($this->street) or empty($this->house)) {
            return "удаленно";
        }else {
            $loc_glob = $this->country()->first()->name . ', '. $this->city()->first()->name. ', ';
            $loc =  empty(!$this->house) ? ', д.' .$this->house : '';
            $loc = $loc . (empty(!$this->building) ? ', корп.' .$this->building : '');
            $loc = $loc . (empty(!$this->apartment) ? ', кв.' .$this->apartment : '');
            return $loc_glob . 'ул. '.$this->street . $loc;
        }
    }

    public function category() {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function country() {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    public function city() {
        return $this->hasOne(City::class, 'id', 'city_id');
    }

    public function endOrder() {
        return \Carbon\Carbon::parse($this->date_end) < \Carbon\Carbon::now() ? \Carbon\Carbon::parse($this->date_end)->shortAbsoluteDiffForHumans(\Carbon\Carbon::now()) . ' назад' : \Carbon\Carbon::parse($this->date_end)->shortAbsoluteDiffForHumans(\Carbon\Carbon::now());
    }

    public function users() {
        return $this->belongsToMany(User::class, 'order_user', 'order_id', 'user_id');
    }

    public function getMastersCount() {
        return $this->users->count();
    }
}
