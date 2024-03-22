<?php

namespace Modules\NewsCategories\src\Repositories;

use App\Repositories\BaseRepository;
use Modules\Categories\src\Models\Category;
use Modules\Courses\src\Models\Course;
use Modules\NewsCategories\src\Models\NewCategory;

class NewsCategoriesRepository extends BaseRepository implements NewsCategoriesRepositoryInterface
{
    public function getModel()
    {
        return NewCategory::class;
    }

    public function getNewsCategories()
    {
        return $this->model->with('subCategories')->where('parent_id', 0)->select(['name', 'slug', 'parent_id', 'id', 'created_at'])->latest()->get();
    }

    public function getCategoriesCreate()
    {
        return $this->model->select(['name', 'slug', 'parent_id', 'id', 'created_at'])->get();
    }


    public function getAllNewsCategories()
    {
        return $this->getNewsCategories();
    }


    public function deleteCourses($category)
    {
        $courseIds = $category->courses()->pluck('course_id')->toArray();

        Course::whereIn('id', $courseIds)->delete();

        $category->courses()->detach();
    }

}

