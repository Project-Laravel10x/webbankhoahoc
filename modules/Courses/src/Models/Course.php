<?php

namespace Modules\Courses\src\Models;

use Illuminate\Database\Eloquent\Model;


class Course extends Model
{

    protected $fillable = [
        'name',
        'slug',
        'detail',
        'id',
        'teacher_id',
        'thumbnail',
        'price',
        'sale_price',
        'code',
        'durations',
        'is_document',
        'support',
        'status',
    ];


}
