<?php

namespace Modules\Document\src\Repositories;

use App\Repositories\BaseRepository;
use Modules\Document\src\Models\Document;
use Modules\Lessons\src\Models\Lesson;

class DocumentRepository extends BaseRepository implements DocumentRepositoryInterface
{

    public function getModel()
    {
        return Document::class;
    }


    public function getAllDocuments()
    {
        return $this->model->select(['id', 'url', 'created_at'])->get();
    }

    public function createDocument($url, $data = [])
    {

        return $this->model->firstOrCreate($url, $data);
    }

}

