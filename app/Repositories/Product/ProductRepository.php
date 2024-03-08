<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\BaseRepository;
use App\Repositories\Product\UserRepositoryInterface;

class ProductRepository extends BaseRepository implements UserRepositoryInterface
{
    public function getModel()
    {
        return Product::class;
    }

    public function getProduct(){
        return $this->model->getAll();
    }
}
