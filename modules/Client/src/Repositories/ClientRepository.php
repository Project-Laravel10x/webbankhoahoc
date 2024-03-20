<?php

namespace Modules\Client\src\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;
use Modules\Client\src\Models\Client;
use Modules\User\src\Models\User;
use function Laravel\Prompts\password;

class ClientRepository extends BaseRepository implements ClientRepositoryInterface
{
    public function getModel()
    {
        return Client::class;
    }


    public function getAllClients()
    {
        return $this->model->select(['name', 'email', 'is_active', 'created_at'])->get();
    }


}

