<?php

namespace Modules\Categories\src\Models;

use Illuminate\Database\Eloquent\Model;


class Category extends Model
{

    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'id',
    ];

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function subCategories()
    {
        return $this->children()->with('subCategories');
    }

}