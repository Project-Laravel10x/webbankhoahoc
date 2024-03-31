<?php

namespace Modules\OrdersDetail\src\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\NewsCategories\src\Http\Requests\NewsCategoryRequest;
use Modules\NewsCategories\src\Repositories\NewsCategoriesRepository;
use Modules\NewsCategories\src\Repositories\NewsCategoriesRepositoryInterface;
use Modules\Orders\src\Repositories\OrderRepository;
use Modules\Orders\src\Repositories\OrderRepositoryInterface;

class OrderDetailController extends Controller
{

    protected OrderRepository $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function index()
    {
        $pageTitle = "Thanh toán";

        $newCategoriesData = $this->newsCategoriesRepository->getNewsCategories()->toArray();

        $newCategories = $this->getCategoriesTable($newCategoriesData);

        return view('newscategories::list', compact('pageTitle', 'newCategories'));
    }

    public function getCategoriesTable($newCategories, $char = '', &$result = [])
    {

        if (!empty($newCategories)) {
            foreach ($newCategories as $key => $category) {
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
        $pageTitle = "Thêm danh mục tin tức";
        $newCategories = $this->newsCategoriesRepository->getCategoriesCreate();
        return view('newscategories::add', compact('pageTitle', 'newCategories'));
    }

    public function store(NewsCategoryRequest $request)
    {
        $data = $request->except('_token', '_method');

        $this->newsCategoriesRepository->create($data);

        return redirect()->route('admin.news_categories.index')->with('msg', __('newscategories::messages.success'));
    }


    public function edit(int $id)
    {
        $pageTitle = "Sửa danh mục tin tức";
        $newCategory = $this->newsCategoriesRepository->getOne($id);
        $newCategories = $this->newsCategoriesRepository->getAllNewsCategories();
        if (!$newCategory) {
            abort('404');
        }

        return view('newscategories::edit', compact('pageTitle', 'newCategory', 'newCategories'));
    }

    public function update(NewsCategoryRequest $request, int $id)
    {
        $data = $request->except('_token', '_method');

        $this->newsCategoriesRepository->update($id, $data);

        return redirect()->route('admin.news_categories.edit', $id)->with('msg', __('newscategories::messages.success'));
    }

    public function delete(int $id)
    {
        $this->newsCategoriesRepository->delete($id);

        return redirect()->route('admin.news_categories.index')->with('msg', __('newscategories::messages.success'));
    }


    public function thanhToan(Request $request)
    {
        $pageTitle = "Giỏ hàng";

        $dataCart = $request->all();

        return view('orders::client.thanh_toan', compact('pageTitle', 'dataCart'));
    }



}
