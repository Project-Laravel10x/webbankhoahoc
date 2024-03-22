<?php

namespace Modules\News\src\Repositories;

use App\Repositories\BaseRepository;
use Modules\Courses\src\Models\Course;
use Modules\Lessons\src\Repositories\LessonsRepository;
use Modules\News\src\Models\News;

class NewsRepository extends BaseRepository implements NewsRepositoryInterface
{

    public function getModel()
    {
        return News::class;
    }

    public function getAllNews()
    {
        return $this->model->select([
            'name',
            'id',
            'slug',
            'content',
            'thumbnail',
            'new_category_id',
            'created_at',
        ])->get();
    }

}

