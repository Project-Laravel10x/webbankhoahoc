<?php

namespace Modules\Lessons\src\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Courses\src\Models\Course;

class LessonCompletions extends Model
{

    protected $fillable = [
        'lesson_id',
        'student_id',
        'completed',
    ];

    public function lessons()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id', 'id');
    }

}
