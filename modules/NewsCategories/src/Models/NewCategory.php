<?php

namespace Modules\NewsCategories\src\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Courses\src\Models\Course;
use Modules\News\src\Models\News;


class NewCategory extends Model
{

    protected $table = "news_categories";

    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'id',
    ];

    public function children()
    {
        return $this->hasMany(NewCategory::class, 'parent_id');
    }

    public function subCategories()
    {
        return $this->children()->with('subCategories');
    }

    public function news()
    {
        return $this->hasMany(News::class, 'new_category_id', 'id');
    }


}
