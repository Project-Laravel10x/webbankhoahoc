<?php

namespace Modules\OrdersDetail\src\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Courses\src\Models\Course;
use Modules\News\src\Models\News;
use Modules\Orders\src\Models\Order;


class OrderDetail extends Model
{

    protected $table = "orders_detail";

    protected $fillable = [
        'order_id',
        'course_id',
        'price',
    ];

    public function courses()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function orders()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

}
