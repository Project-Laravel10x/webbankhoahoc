<?php

namespace Modules\Lessons\src\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Categories\src\Models\Category;
use Modules\Courses\src\Models\Course;
use Modules\Document\src\Models\Document;
use Modules\Teacher\src\Models\Teacher;
use Modules\Video\src\Models\Video;


class Lesson extends Model
{

    protected $fillable = [
        'name',
        'slug',
        'video_id',
        'document_id',
        'course_id',
        'parent_id',
        'is_trial',
        'view',
        'position',
        'durations',
        'description',
    ];

    public function children()
    {
        return $this->hasMany(Lesson::class, 'parent_id')->orderBy('position', 'asc');
    }

    public function subLessons()
    {
        return $this->children()->with('subLessons');
    }

    public function courses()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function video()
    {
        return $this->belongsTo(
            Video::class,
            'video_id',
            'id'
        );
    }

    public function document()
    {
        return $this->belongsTo(
            Document::class,
            'document_id',
            'id'
        );
    }

}
