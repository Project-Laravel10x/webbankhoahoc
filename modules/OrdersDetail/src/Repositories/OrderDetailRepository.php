<?php

namespace Modules\OrdersDetail\src\Repositories;

use App\Repositories\BaseRepository;
use Modules\Categories\src\Models\Category;
use Modules\Courses\src\Models\Course;
use Modules\NewsCategories\src\Models\NewCategory;
use Modules\Orders\src\Models\Order;
use Modules\OrdersDetail\src\Models\OrderDetail;

class OrderDetailRepository extends BaseRepository implements OrderDetailRepositoryInterface
{
    public function getModel()
    {
        return OrderDetail::class;
    }


    public function getAllOrdersDetail()
    {
        return $this->model->select([
            'id', 'order_id', 'course_id', 'price', 'created_at'
        ])->get();
    }

    public function getOrdersDetailById($id)
    {
        return $this->model->select([
            'id', 'order_id', 'course_id', 'price', 'created_at'
        ])->where('order_id', $id)->get();
    }

}

