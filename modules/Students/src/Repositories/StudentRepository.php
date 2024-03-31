<?php

namespace Modules\Students\src\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;
use Modules\Courses\src\Models\Course;
use Modules\Students\src\Models\Student;
use Modules\User\src\Models\User;
use function Laravel\Prompts\password;

class StudentRepository extends BaseRepository implements StudentRepositoryInterface
{
    public function getModel()
    {
        return Student::class;
    }


    public function getAllStudents()
    {
        return $this->model->select(['id', 'name', 'email', 'phone', 'address', 'is_active', 'created_at'])->get();
    }


    public function getAllStudentsPaginate($perPage)
    {
        return $this->model->select(['id', 'name', 'email', 'phone', 'address', 'is_active', 'created_at'])->paginate($perPage);
    }


    public function createStudentsCourses($student, $course)
    {
        return $student->courses()->attach($course->id, [
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function deleteStudentsCourses($student, $courseId)
    {
        return $student->courses()->detach($courseId);
    }

}

