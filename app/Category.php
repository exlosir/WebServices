<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;

    public static function children($parent=null) {
        return Category::where('parent_id',$parent)->where('published',1)->orderBy('name','desc')->get();
    }

    public static function childrenAll($parent=null) {
        return Category::where('parent_id',$parent)->orderBy('name','desc')->get();
    }

    public function parent() {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function isPublished() {
        return !! $this->published;
    }
}
