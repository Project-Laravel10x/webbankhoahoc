<?php

namespace Modules\Categories\src\Repositories;

use App\Repositories\BaseRepository;
use Modules\Categories\src\Models\Category;
use Modules\Courses\src\Models\Course;

class CategoriesRepository extends BaseRepository implements CategoriesRepositoryInterface
{
    public function getModel()
    {
        return Category::class;
    }

    public function getCategories()
    {
        return $this->model->with('subCategories')->where('parent_id', 0)->select(['name', 'slug', 'parent_id', 'id', 'thumbnail', 'created_at'])->latest()->get();
    }

    public function getCategoriesCreate()
    {
        return $this->model->select(['name', 'slug', 'parent_id', 'id', 'thumbnail', 'created_at'])->get();
    }

    public function getAllCategories()
    {
        return $this->getCategories();
    }


    public function deleteCourses($category)
    {
        $courseIds = $category->courses()->pluck('course_id')->toArray();

        Course::whereIn('id', $courseIds)->delete();

        $category->courses()->detach();
    }

}

