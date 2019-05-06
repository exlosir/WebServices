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

    public function scopeFeedbackCount (User $user) { // получаем количество не оставленных отзывов, где текущий пользователь является заказчиком
        $count = $this->masters();
        return $count;
    }
}
