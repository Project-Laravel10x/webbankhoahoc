<?php

namespace Modules\News\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Modules\News\src\Http\Requests\NewRequest;
use Modules\News\src\Repositories\NewsRepository;
use Modules\NewsCategories\src\Repositories\NewsCategoriesRepository;


class NewController extends Controller
{
    protected NewsRepository $newRepository;
    protected NewsCategoriesRepository $newCategoryRepository;

    public function __construct(NewsRepository $newRepository, NewsCategoriesRepository $newCategoryRepository)
    {
        $this->newRepository = $newRepository;
        $this->newCategoryRepository = $newCategoryRepository;
    }

    public function index()
    {
        $pageTitle = "Quản lí tin tức";

        $news = $this->newRepository->getAllNews();

        return view('news::list', compact('pageTitle', 'news'));
    }

    public function create()
    {
        $pageTitle = "Thêm tin tức";

        $news = $this->newCategoryRepository->getAll();

        return view('news::add', compact('pageTitle', 'news'));
    }

    public function store(NewRequest $request)
    {
        $data = $request->except('_token', '_method');

        $this->newRepository->create($data);

        return redirect()->route('admin.news.index')->with('msg', __('news::messages.success'));
    }

    public function edit(int $id)
    {
        $pageTitle = "Sửa tin tức";

        $new = $this->newRepository->getOne($id);

        $news = $this->newCategoryRepository->getAll();

        if (!$new) {
            abort('404');
        }

        return view('news::edit', compact('pageTitle', 'new','news'));
    }

    public function update(NewRequest $request, $id)
    {
        $data = $request->except('_token', '_method');

        $this->newRepository->update($id, $data);

        return redirect()->route('admin.news.edit', $id)->with('msg', __('news::messages.success'));
    }

    public function delete(int $id)
    {
        $course = $this->newRepository->getOne($id);

        $status = $this->newRepository->delete($id);

        if ($status) {
            $image = $course->thumbnail;
            deleteFileStoge($image);
        }

        return redirect()->route('admin.news.index')->with('msg', __('news::messages.success'));
    }

}
