<?php

namespace Modules\Categories\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Categories\src\Http\Requests\CategoryRequest;
use Modules\Categories\src\Models\Category;
use Modules\Categories\src\Repositories\CategoriesRepository;


class CategoryController extends Controller
{

    protected CategoriesRepository $categoriesRepository;

    public function __construct(CategoriesRepository $categoriesRepository)
    {
        $this->categoriesRepository = $categoriesRepository;
    }

    public function index()
    {
        $pageTitle = "Quản lí danh mục";
        $categoriesData = $this->categoriesRepository->getCategories()->toArray();
        $categories = $this->getCategoriesTable($categoriesData);
//        dd($categories);
        return view('categories::list', compact('pageTitle', 'categories'));
    }

    public function getCategoriesTable($categories, $char = '', &$result = [])
    {

        if (!empty($categories)) {
            foreach ($categories as $key => $category) {
                $row = $category;
                $row['name'] = $char . $row['name'];
                unset($row['sub_categories']);
                $result[] = $row;
                if (!empty($category['sub_categories'])) {
                    $this->getCategoriesTable($category['sub_categories'], $char . '|-- ', $result);
                }
            }
        }
        return $result;
    }

    public function create()
    {
        $pageTitle = "Thêm danh mục";
        $categories = $this->categoriesRepository->getCategoriesCreate();
        return view('categories::add', compact('pageTitle', 'categories'));
    }

    public function store(CategoryRequest $request)
    {
        $this->categoriesRepository->create([
            'name' => $request->name,
            'slug' => $request->slug,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('index')->with('msg', __('categories::messages.success'));
    }


    public function edit(int $id)
    {
        $pageTitle = "Sửa danh mục";
        $category = $this->categoriesRepository->getOne($id);
        $categories = $this->categoriesRepository->getAllCategories();
        if (!$category) {
            abort('404');
        }


        return view('categories::edit', compact('pageTitle', 'category', 'categories'));
    }

    public function update(CategoryRequest $request, int $id)
    {
        $data = $request->except('_token', '_method');

        $this->categoriesRepository->update($id, $data);

        return redirect()->route('edit', $id)->with('msg', __('categories::messages.success'));
    }

    public function delete(int $id)
    {
        $this->categoriesRepository->delete($id);
        return redirect()->route('index')->with('msg', __('categories::messages.success'));
    }


}
