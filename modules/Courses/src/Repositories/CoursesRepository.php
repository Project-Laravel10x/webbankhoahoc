<?php

namespace Modules\Courses\src\Repositories;

use App\Repositories\BaseRepository;
use Modules\Courses\src\Models\Course;
use Modules\Lessons\src\Repositories\LessonsRepository;

class CoursesRepository extends BaseRepository implements CoursesRepositoryInterface
{

    public function getModel()
    {
        return Course::class;
    }

    public function getAllCourses()
    {
        $dataCourses = $this->model->with('teachers:id,name,image')
            ->select(['id', 'name', 'price','sale_price', 'status', 'thumbnail', 'teacher_id', 'created_at'])
            ->get();

        foreach ($dataCourses as $key => $course) {
            $course['lessons'] = [];

            $courseId = $course['id'];

            $lessonsByCourseId = (new lessonsRepository)->getLessonsByCourseId($courseId)->toArray();
            $dataCourses[$key]['lessons'] = array_merge($course['lessons'], $lessonsByCourseId);

        }

        return $dataCourses;
    }


    public function createCoursesCategories($course, $data = [])
    {
        $course->categories()->attach($data);
    }


    public function updateCoursesCategories($course, $data = [])
    {
        $course->categories()->sync($data);
    }


    public function getRelatedCategories($course)
    {
        return $course->categories()->allRelatedIds()->toArray();
    }


}

