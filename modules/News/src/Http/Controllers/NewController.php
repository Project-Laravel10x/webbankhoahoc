<?php

namespace Modules\News\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Modules\News\src\Http\Requests\NewRequest;
use Modules\News\src\Models\News;
use Modules\News\src\Repositories\NewsRepository;
use Modules\NewsCategories\src\Repositories\NewsCategoriesRepository;
use Modules\Teacher\src\Repositories\TeacherRepository;
use Modules\Teacher\src\Repositories\TeacherRepositoryInterface;


class NewController extends Controller
{
    protected NewsRepository $newRepository;
    protected NewsCategoriesRepository $newCategoryRepository;
    protected TeacherRepository $teacherRepository;

    public function __construct(
        NewsRepository             $newRepository,
        TeacherRepositoryInterface $teacherRepository,
        NewsCategoriesRepository   $newCategoryRepository)
    {
        $this->newRepository = $newRepository;
        $this->newCategoryRepository = $newCategoryRepository;
        $this->teacherRepository = $teacherRepository;
    }

    public function index()
    {
        $pageTitle = "Quản lí tin tức";
        $news = $this->newRepository->getAllNews();

        return view('news::admin.list', compact('pageTitle', 'news'));
    }

    public function create()
    {
        $pageTitle = "Thêm tin tức";
        $news = $this->newCategoryRepository->getAll();
        $teachers = $this->teacherRepository->getAllTeacher();

        return view('news::admin.add', compact('pageTitle', 'news', 'teachers'));
    }

    public function store(NewRequest $request)
    {
        $data = $request->except('_token', '_method');

        $this->newRepository->create($data);

        return redirect()->route('admin.news.index')->with('msg', __('news::messages.success'));
    }

    public function edit(News $new)
    {
        $pageTitle = "Sửa tin tức";
        $news = $this->newCategoryRepository->getAll();
        $teachers = $this->teacherRepository->getAllTeacher();

        return view('news::admin.edit', compact('pageTitle', 'new', 'news', 'teachers'));
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

    public function listAllNews()
    {
        $pageTitle = "Danh sách tin tức";

        $news = $this->newRepository->getNewsPagination(2);

        $newsRecently = $this->newRepository->getAllNews();

        $newsCategories = $this->newCategoryRepository->getNewsCategories();

        return view('news::client.listNews', compact('pageTitle', 'news', 'newsCategories', 'newsRecently'));
    }

    public function detailNew($slug)
    {
        $pageTitle = "Chi tiết tin tức";

        $newDetail = News::where('slug', $slug)->first();

        return view('news::client.detailNew', compact('pageTitle', 'newDetail'));
    }

}
