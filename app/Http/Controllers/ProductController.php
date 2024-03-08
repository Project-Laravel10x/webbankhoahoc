<?php

namespace App\Http\Controllers;

use App\Repositories\Product\ProductRepository;

class ProductController extends Controller
{
    protected $productRepo;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepo = $productRepository;
    }

    public function index()
    {
        $products = $this->productRepo->getAll();
        dd($products);
    }
}
