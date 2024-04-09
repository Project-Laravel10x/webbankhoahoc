<?php

namespace Modules\Lessons\src\Repositories;

use App\Repositories\BaseRepository;
use Modules\Courses\src\Models\Course;
use Modules\Lessons\src\Models\Lesson;
use Modules\Students\src\Models\StudentCourse;

class LessonsRepository extends BaseRepository implements LessonsRepositoryInterface
{
    public function getModel()
    {
        return Lesson::class;
    }

    public function getAllLessons()
    {
        return $this->model->select([
            'id', 'name', 'slug', 'video_id',
            'document_id', 'parent_id', 'is_trial',
            'view', 'position', 'durations', 'description', 'created_at'
        ])->get();
    }

    public function getAllLessonsOk()
    {
        return $this->getAll();
    }

    public function getPosition($courseId)
    {
        $result = $this->model->where('course_id', $courseId)->count();
        return $result + 1;
    }

    public function getLessonsByCourseId($courseId)
    {
        $course = Course::findOrFail($courseId);

        return $course->lessons;
    }

    public function getLessons($courseId = null)
    {
        return $this->model
            ->with('subLessons')
            ->where('course_id', $courseId)
            ->where('parent_id', null)
            ->select([
                'id', 'name', 'slug', 'video_id', 'course_id',
                'document_id', 'parent_id', 'is_trial', 'is_trial',
                'view', 'position', 'durations', 'description', 'created_at'
            ])->get();
    }

    public function getLessonByStudentIdAndCourseId($studentId, $lessonsData = [])
    {
        $courseIds = array_column($lessonsData, 'course_id');

        $myCourseRegister = StudentCourse::where('student_id', $studentId)
            ->whereIn('course_id', $courseIds)
            ->with('courses.lessons')
            ->get();

        $courseIds = $myCourseRegister->pluck('course_id')->toArray();

        $courses = Course::whereIn('id', $courseIds)->get();

        return $courses;
    }

    public function getPreviousAndNextLesson($lessonData)
    {
        $previousLesson = null;
        $nextLesson = null;
        if ($lessonData->parent_id !== null) {
            $previousLesson = Lesson::where('parent_id', $lessonData->parent_id)
                ->where('position', '<', $lessonData->position)
                ->orderBy('position', 'desc')
                ->first();

            $nextLesson = Lesson::where('parent_id', $lessonData->parent_id)
                ->where('position', '>', $lessonData->position)
                ->orderBy('position', 'asc')
                ->first();

            if ($nextLesson == null) {
                $nextLesson = Lesson::where('position', $lessonData->position + 2)
                    ->orderBy('position', 'asc')
                    ->first();
            }
            if ($previousLesson == null) {
                $previousLesson = Lesson::where('position', $lessonData->position - 2)
                    ->orderBy('position', 'asc')
                    ->first();
            }
        } else {
            $positionNext = $lessonData->position + 2;

            $nextLesson = Lesson::where('position', $positionNext)
                ->orderBy('position', 'asc')
                ->first();
        }
        return [
            'previousLesson' => $previousLesson == null ? null : $previousLesson,
            'nextLesson' => $nextLesson == null ? null : $nextLesson
        ];

    }

}

