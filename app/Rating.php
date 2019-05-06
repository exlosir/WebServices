<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Rating extends Model
{
    protected $table = 'rating_order';

    public function masters() {
        return $this->belongsTo(OrderUser::class, 'order_user', 'id');
    }
}
