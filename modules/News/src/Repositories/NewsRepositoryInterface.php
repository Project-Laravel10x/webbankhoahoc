<?php

namespace Modules\News\src\Repositories;

use  App\Repositories\RepositoryInterface;

interface NewsRepositoryInterface extends RepositoryInterface
{
    public function getAllNews();
}
