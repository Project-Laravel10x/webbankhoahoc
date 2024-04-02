<?php

namespace Modules\Teacher\src\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Courses\src\Models\Course;
use Modules\News\src\Models\News;


class Teacher extends Model
{

    protected $fillable = [
        'id',
        'name',
        'slug',
        'image',
        'description',
        'exp',
        'major',
    ];

    public function courses()
    {
        return $this->hasMany(Course::class,'teacher_id','id');
    }
    public function news()
    {
        return $this->hasMany(News::class,'teacher_id','id');
    }
}
