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

    public function getPreviousAndNextLesson($lessonData, $course_id = null)
    {
        $previousLesson = null;
        if ($lessonData->parent_id !== null) {
            $previousLesson = Lesson::where('parent_id', $lessonData->parent_id)
                ->where('position', '<', $lessonData->position)
                ->where('course_id', $course_id)
                ->orderBy('position', 'desc')
                ->first();

            $nextLesson = Lesson::where('parent_id', $lessonData->parent_id)
                ->where('position', '>', $lessonData->position)
                ->where('course_id', $course_id)
                ->with('video')
                ->orderBy('position', 'asc')
                ->first();


            if ($nextLesson == null) {
                $nextLesson = Lesson::where('position', $lessonData->position + 2)
                    ->where('course_id', $course_id)
                    ->with('video')
                    ->orderBy('position', 'asc')
                    ->first();
            }
            if ($previousLesson == null) {
                $previousLesson = Lesson::where('position', $lessonData->position - 2)
                    ->where('course_id', $course_id)
                    ->orderBy('position', 'asc')
                    ->first();
            }
        } else {
            $positionNext = $lessonData->position + 2;

            $nextLesson = Lesson::where('position', $positionNext)
                ->where('course_id', $course_id)
                ->with('video')
                ->orderBy('position', 'asc')
                ->first();
        }
        return [
            'previousLesson' => $previousLesson == null ? null : $previousLesson,
            'nextLesson' => $nextLesson == null ? null : $nextLesson
        ];

    }

    public function previousLesson($lessonData)
    {
        return $this->model->where('course_id', $lessonData->course_id)
            ->where('position', '<', $lessonData->position)
            ->orderByDesc('id')
            ->first();
    }
}

