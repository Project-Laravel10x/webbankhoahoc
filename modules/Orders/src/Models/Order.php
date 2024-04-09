<?php

namespace Modules\Orders\src\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Courses\src\Models\Course;
use Modules\News\src\Models\News;
use Modules\OrdersDetail\src\Models\OrderDetail;
use Modules\Students\src\Models\Student;


class Order extends Model
{

    protected $table = "orders";

    protected $fillable = [
        'student_id',
        'total',
        'status',
    ];



    public function students()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }


}
