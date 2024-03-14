<?php

namespace Modules\Courses\src\Repositories;

use App\Repositories\BaseRepository;
use Modules\Courses\src\Models\Course;

class CoursesRepository extends BaseRepository implements CoursesRepositoryInterface
{
    public function getModel()
    {
        return Course::class;
    }

    public function getAllCourses()
    {
        return $this->model->select(['id', 'name', 'price', 'status', 'created_at'])->get();
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

