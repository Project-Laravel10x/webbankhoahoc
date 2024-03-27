<?php

namespace Modules\Teacher\src\Repositories;

use App\Repositories\BaseRepository;
use Modules\Teacher\src\Models\Teacher;


class TeacherRepository extends BaseRepository implements TeacherRepositoryInterface
{
    public function getModel()
    {
        return Teacher::class;
    }

    public function getAllTeacher()
    {
        return $this->model->select(['id', 'name', 'slug', 'image', 'major', 'description', 'exp','created_at'])->get();
    }


}

