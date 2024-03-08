<?php

namespace Modules\User\src\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;
use Modules\User\src\Models\User;
use function Laravel\Prompts\password;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function getModel()
    {
        return User::class;
    }

    public function getUsers($limit = [])
    {
        return $this->model->paginate($limit);
    }

    public function getAllUsers()
    {
        return $this->model->select(['name', 'email', 'group_id', 'created_at'])->get();
    }

    public function setPassword($password, $id)
    {
        return $this->update($id, ['password' => Hash::make($password)]);
    }

    public function checkPassword($password, $id)
    {
        $user = $this->getOne($id);

        if ($user) {
            $hashPassword = $user->password;
            return Hash::check($password, $hashPassword);
        }

        return false;
    }
}

