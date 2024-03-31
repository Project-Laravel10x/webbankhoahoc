<?php

namespace Modules\Orders\src\Repositories;

use App\Repositories\BaseRepository;
use Modules\Categories\src\Models\Category;
use Modules\Courses\src\Models\Course;
use Modules\NewsCategories\src\Models\NewCategory;
use Modules\Orders\src\Models\Order;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    public function getModel()
    {
        return Order::class;
    }


    public function getAllOrders()
    {
        return $this->model->select([
            'id', 'student_id', 'total', 'status', 'created_at'
        ])->get();
    }

}

