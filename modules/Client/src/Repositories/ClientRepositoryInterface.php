<?php

namespace Modules\Client\src\Repositories;

use  App\Repositories\RepositoryInterface;

interface ClientRepositoryInterface extends RepositoryInterface
{
    public function getAllClients();

}
