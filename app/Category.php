<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public static function children($parent=null) {
        return Category::where('parent_id',$parent)->where('published',1)->orderBy('name','desc')->get();
    }
}
