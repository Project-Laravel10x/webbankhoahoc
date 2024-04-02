<?php

namespace Modules\Courses\src\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Modules\Courses\src\Models\Course;
use Modules\Lessons\src\Repositories\LessonsRepository;

class CoursesRepository extends BaseRepository implements CoursesRepositoryInterface
{

    public function getModel()
    {
        return Course::class;
    }

    public function getAllCourses($student_id = null, $checkBuyCourse = true)
    {
        $dataCourses = $this->model->with('teachers:id,name,image')
            ->with('lessons')
            ->select(['id', 'name', 'slug', 'shoft_description', 'price',
                'sale_price', 'status', 'thumbnail', 'teacher_id', 'created_at'])->latest();

        if ($student_id != null) {
            if ($checkBuyCourse) {
                $dataCourses->whereHas('students', function ($query) use ($student_id) {
                    $query->where('student_id', $student_id);
                });
            } else {
                $dataCourses->whereDoesntHave('students', function ($query) use ($student_id) {
                    $query->where('student_id', $student_id);
                });
            }
        }

        return $dataCourses->get();
    }

    public function getCourseById($courseId)
    {
        $dataCourses = $this->model->with('teachers:id,name,image')
            ->with('lessons')
            ->select(['id', 'name', 'slug', 'shoft_description', 'price',
                'sale_price', 'status', 'thumbnail', 'teacher_id', 'created_at'])
            ->where('id', $courseId)
            ->latest()
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


    public function filterDataCourses($selectedCategories)
    {
        return Course::with(['teachers', 'lessons' => function ($query) {
            $query->with('video');
        }])->whereHas('categories', function ($query) use ($selectedCategories) {
            $query->whereIn('category_id', $selectedCategories);
        })->get()->toArray();
    }

}

