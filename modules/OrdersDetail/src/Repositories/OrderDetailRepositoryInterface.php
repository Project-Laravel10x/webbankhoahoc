<?php

namespace Modules\OrdersDetail\src\Repositories;

use  App\Repositories\RepositoryInterface;

interface OrderDetailRepositoryInterface extends RepositoryInterface
{
    public function getAllOrdersDetail();
}
