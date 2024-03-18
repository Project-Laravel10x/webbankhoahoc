<?php

namespace Modules\Document\src\Repositories;

use  App\Repositories\RepositoryInterface;

interface DocumentRepositoryInterface extends RepositoryInterface
{
    public function getAllDocuments();

    public function createDocument($url,$data);

}
