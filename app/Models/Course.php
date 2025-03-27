<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function competitions()
    {
        return $this->hasMany(Competition::class);
    }

    public function videos()
    {
        return $this->hasMany(CourseVideo::class);
    }


}
