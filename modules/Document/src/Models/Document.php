<?php

namespace Modules\Document\src\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Lessons\src\Models\Lesson;

class Document extends Model
{

    protected $fillable = [
        'id',
        'name',
        'url',
        'size',
    ];


    public function lessons()
    {
        return $this->hasMany(
            Lesson::class,
            'document_id'
        );
    }
}
