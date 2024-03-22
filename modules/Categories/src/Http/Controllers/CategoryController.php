<?php

namespace Modules\Categories\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Categories\src\Http\Requests\CategoryRequest;
use Modules\Categories\src\Models\Category;
use Modules\Categories\src\Repositories\CategoriesRepository;
use Modules\Categories\src\Repositories\CategoriesRepositoryInterface;


class CategoryController extends Controller
{

    protected CategoriesRepository $categoriesRepository;

    public function __construct(CategoriesRepositoryInterface $categoriesRepository)
    {
        $this->categoriesRepository = $categoriesRepository;
    }

    public function index()
    {
        $pageTitle = "Quản lí danh mục";
        $categoriesData = $this->categoriesRepository->getCategories()->toArray();
        $categories = $this->getCategoriesTable($categoriesData);

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
        $data = $request->except('_token', '_method');

        $this->categoriesRepository->create($data);

        return redirect()->route('admin.categories.index')->with('msg', __('categories::messages.success'));
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

        return redirect()->route('admin.categories.edit', $id)->with('msg', __('categories::messages.success'));
    }

    public function delete(int $id)
    {
        $category = $this->categoriesRepository->getOne($id);

        $this->categoriesRepository->deleteCourses($category);

        $this->categoriesRepository->delete($id);

        return redirect()->route('admin.categories.index')->with('msg', __('categories::messages.success'));
    }


}
