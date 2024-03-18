<?php

namespace Modules\Lessons\src\Repositories;

use App\Repositories\BaseRepository;
use Modules\Lessons\src\Models\Lesson;

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

    public function getLessons($courseId = null)
    {
        return $this->model
            ->with('subLessons')
            ->where('course_id', $courseId)
            ->where('parent_id', null)
            ->select([
                'id', 'name', 'slug', 'video_id',
                'document_id', 'parent_id', 'is_trial',
                'view', 'position', 'durations', 'description', 'created_at'
            ])->latest()->get();
    }

}

