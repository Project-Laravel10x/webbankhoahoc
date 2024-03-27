<?php

use Modules\Lessons\src\Repositories\LessonsRepository;

function countLessonsTeacher($courses)
{
    $sumLessonByTeacher = 0;
    foreach ($courses->toArray() as $course) {
        $courseData = (new LessonsRepository())->getLessons($course['id'])->toArray();
        foreach ($courseData as $item) {
            $sumLessonByTeacher += count($item['sub_lessons']);
        }
    }
    return $sumLessonByTeacher;
}

function countDurationTeacher($courses)
{
    $sumDurations = 0;
    foreach ($courses->toArray() as $course) {
        $courseData = (new LessonsRepository())->getLessonsByCourseId($course['id'])->toArray();
        foreach ($courseData as $item) {
            $sumDurations += $item['durations'];
        }
    }

    return formatTime($sumDurations);
}
