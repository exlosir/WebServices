<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Rating;

class Order extends Model
{
    public function user() {
        return $this->belongsTo(User::class,'customer_id','id');
    }

    public function status() {
        return $this->hasOne(Status::class, 'id', 'status_id');
    }

    public function location() {
//        if(empty($this->street) or empty($this->house)) {
//            return "удаленно";
//        }else {
            $loc =  empty(!$this->house) ? ', д.' .$this->house : '';
            $loc = $loc . (empty(!$this->building) ? ', корп.' .$this->building : '');
            $loc = $loc . (empty(!$this->apartment) ? ', кв.' .$this->apartment : '');
            $loc = $loc . (empty(!$this->street) ? ', ул. '. $this->street : '');
            $loc_glob = $this->country->name . ', '. $this->city->name. '';
//            return $loc_glob . 'ул. '.$this->street . $loc;
//        }
        return $loc_glob . $loc;
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

    public function usersPivot() {
        return $this->belongsToMany(User::class, 'order_user', 'order_id', 'user_id')->withPivot('id','status_id', 'created_at', 'updated_at')->join('statuses', 'order_user.status_id', '=', 'statuses.id')->select('statuses.name as pivot_statuses_name');
    }

    public function getMastersCount() {
        return $this->users->count();
    }

    public function isFeedback() { //проверяет, существует ли отзыв к работе
        $orderUserId = $this->usersPivot()->where('status_id', Status::where('name','Принят')->first()->id)->first()->pivot->id; //нашли мастера, которвый выполнял эту работу
        $feedback = DB::table('rating_order')->where('order_user',$orderUserId)->get();
        return $feedback->isEmpty();
    }

    public function isMaster(User $user) {
        $mst = $this->usersPivot;
        return $mst;
    }

    public function order_users () {
        return $this->belongsTo(OrderUser::class, 'id','order_id');
    }
}
