<?php

namespace Modules\Courses\src\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Categories\src\Models\Category;
use Modules\Lessons\src\Models\Lesson;
use Modules\OrdersDetail\src\Models\OrderDetail;
use Modules\Students\src\Models\Student;
use Modules\Teacher\src\Models\Teacher;


class Course extends Model
{

    protected $fillable = [
        'name',
        'slug',
        'detail',
        'id',
        'teacher_id',
        'thumbnail',
        'price',
        'sale_price',
        'code',
        'durations',
        'is_document',
        'support',
        'status',
        'shoft_description',
    ];


    public function categories()
    {
        return $this->belongsToMany(Category::class, 'categories_courses');
    }


    public function students()
    {
        return $this->belongsToMany(Student::class, 'students_courses');
    }


    public function teachers()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }


    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'course_id', 'id');
    }


    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class, 'course_id', 'id');
    }


}
