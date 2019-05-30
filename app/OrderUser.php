<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderUser extends Model
{
    public $table = 'order_user';
    protected $primaryKey = 'id';
    public function order() {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function status() {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }

}
