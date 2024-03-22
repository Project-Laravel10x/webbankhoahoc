<?php

namespace Modules\Students\src\Repositories;

use  App\Repositories\RepositoryInterface;

interface StudentRepositoryInterface extends RepositoryInterface
{
    public function getAllStudents();

}
