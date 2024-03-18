<?php

namespace Modules\Video\src\Repositories;

use App\Repositories\BaseRepository;
use Modules\Lessons\src\Models\Lesson;
use Modules\Video\src\Models\Video;

class VideoRepository extends BaseRepository implements VideoRepositoryInterface
{
    public function getModel()
    {
        return Video::class;
    }

    public function getAllVideo()
    {
        return $this->model->select(['id', 'url', 'created_at','duration','name'])->get();
    }

    public function createVideo($url,$data = [])
    {
        return $this->model->firstOrCreate($url,$data);
    }

}

