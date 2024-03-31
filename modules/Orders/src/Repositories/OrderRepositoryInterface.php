<?php

namespace Modules\Orders\src\Repositories;

use  App\Repositories\RepositoryInterface;

interface OrderRepositoryInterface extends RepositoryInterface
{
    public function getAllOrders();
}
