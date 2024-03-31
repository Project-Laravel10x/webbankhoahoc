<?php

namespace Modules\Students\src\Models;

use Illuminate\Database\Eloquent\Model;

use Modules\News\src\Models\News;



class StudentCourse extends Model
{

    protected $table = "students_courses";

    protected $fillable = [
        'student_id',
        'course_id',
    ];

}
