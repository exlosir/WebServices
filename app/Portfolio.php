<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    public $timestamps = false;

    protected $guarded = [];

    protected $casts = [
        'image'=>'array',
    ];
}
