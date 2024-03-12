<?php

namespace Modules\Categories\src\Repositories;

use App\Repositories\BaseRepository;
use Modules\Categories\src\Models\Category;

class CategoriesRepository extends BaseRepository implements CategoriesRepositoryInterface
{
    public function getModel()
    {
        return Category::class;
    }

    public function getCategories()
    {
        return $this->model->with('subCategories')->where('parent_id', 0)->select(['name', 'slug', 'parent_id', 'id', 'created_at'])->latest()->get();
    }


    public function getCategoriesCreate()
    {
        return $this->model->select(['name', 'slug', 'parent_id', 'id', 'created_at'])->get();
    }


    public function getAllCategories()
    {
        return $this->getCategories();
    }


}

