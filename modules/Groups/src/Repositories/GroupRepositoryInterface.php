<?php

namespace Modules\Groups\src\Repositories;

use  App\Repositories\RepositoryInterface;

interface GroupRepositoryInterface extends RepositoryInterface
{
    public function getAllGroups();

}
