<?php

namespace Modules\NewsCategories\src\Repositories;

use  App\Repositories\RepositoryInterface;

interface NewsCategoriesRepositoryInterface extends RepositoryInterface
{
    public function getAllNewsCategories();

    public function getNewsCategories();
}
