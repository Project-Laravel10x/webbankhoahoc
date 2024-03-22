<?php

namespace Modules\Teacher\src\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Courses\src\Models\Course;


class Teacher extends Model
{

    protected $fillable = [
        'id',
        'name',
        'slug',
        'image',
        'description',
        'exp',
    ];

    public function courses()
    {
        return $this->hasMany(Course::class,'teacher_id','id');
    }
}
