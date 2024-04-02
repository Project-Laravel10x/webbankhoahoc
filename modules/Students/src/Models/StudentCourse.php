<?php

namespace Modules\Students\src\Models;

use Illuminate\Database\Eloquent\Model;

use Modules\Courses\src\Models\Course;
use Modules\News\src\Models\News;



class StudentCourse extends Model
{

    protected $table = "students_courses";

    protected $fillable = [
        'student_id',
        'course_id',
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'students_courses', 'student_id', 'course_id');
    }
}
