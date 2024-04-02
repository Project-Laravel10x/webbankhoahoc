<?php

namespace Modules\News\src\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Categories\src\Models\Category;
use Modules\Lessons\src\Models\Lesson;
use Modules\NewsCategories\src\Models\NewCategory;
use Modules\Students\src\Models\Student;
use Modules\Teacher\src\Models\Teacher;


class News  extends Model
{

    protected $fillable = [
        'name',
        'slug',
        'content',
        'thumbnail',
        'teacher_id',
        'new_category_id',
    ];

    public function newsCategoies()
    {
        return $this->belongsTo(NewCategory::class, 'new_category_id', 'id');
    }


    public function teachers()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }


}
