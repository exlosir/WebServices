<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];

    public function country() {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
}
