<?php

use Modules\Lessons\src\Models\LessonCompletions;
use Modules\Students\src\Models\Student;

function isClientActive($email)
{
    $checkActive = Student::where('email', $email)->where('is_active', 1)->count();

    if ($checkActive > 0) {
        return true;
    }

    return false;
}

function checkCompletedLesson($lessonId)
{
    return LessonCompletions::where('lesson_id', $lessonId)
        ->where('student_id', auth('students')->user()->id)
        ->exists();
}

