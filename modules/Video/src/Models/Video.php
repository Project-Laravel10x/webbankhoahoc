<?php

namespace Modules\Video\src\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Categories\src\Models\Category;
use Modules\Lessons\src\Models\Lesson;


class Video extends Model
{

    protected $fillable = [
        'url',
        'id',
        'name',
        'duration',
    ];

    public function lessons()
    {
        return $this->hasMany(
            Lesson::class,
            'video_id'
        );
    }


}
