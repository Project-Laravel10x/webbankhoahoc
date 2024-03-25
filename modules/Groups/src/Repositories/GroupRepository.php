<?php

namespace Modules\Groups\src\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;
use Modules\Groups\src\Models\Group;
use Modules\User\src\Models\User;
use function Laravel\Prompts\password;

class GroupRepository extends BaseRepository implements GroupRepositoryInterface
{
    public function getModel()
    {
        return Group::class;
    }

    public function getAllGroups()
    {
        return $this->model->select(['id','name', 'permissions', 'user_id', 'created_at'])->get();
    }


}

