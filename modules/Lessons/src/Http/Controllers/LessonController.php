<?php

namespace Modules\Lessons\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Modules\Courses\src\Repositories\CoursesRepository;
use Modules\Document\src\Repositories\DocumentRepository;
use Modules\Lessons\src\Http\Requests\LessonRequest;
use Modules\Lessons\src\Repositories\LessonsRepository;
use Modules\Video\src\Repositories\VideoRepository;
use Illuminate\Support\Facades\File;


class LessonController extends Controller
{

    protected LessonsRepository $lessonsRepository;
    protected CoursesRepository $coursesRepository;
    protected VideoRepository $videoRepository;
    protected DocumentRepository $documentRepository;

    public function __construct(
        LessonsRepository  $lessonsRepository,
        CoursesRepository  $coursesRepository,
        VideoRepository    $videoRepository,
        DocumentRepository $documentRepository
    )
    {
        $this->lessonsRepository = $lessonsRepository;
        $this->coursesRepository = $coursesRepository;
        $this->videoRepository = $videoRepository;
        $this->documentRepository = $documentRepository;
    }

    public function index(int $courseId)
    {

        $course = $this->coursesRepository->getOne($courseId);

        $lessonsData = $this->lessonsRepository->getLessons($courseId)->toArray();

        $lessons = $this->getLessonsTable($lessonsData);

        $pageTitle = "Quản lí bài giảng: $course->name";

        return view('lessons::list', compact('pageTitle', 'lessons', 'courseId'));
    }

    public function create($courseId)
    {
        $pageTitle = "Thêm bài giảng";

        $position = $this->lessonsRepository->getPosition($courseId);

        $lessons = $this->lessonsRepository->getAllLessonsOk()->toArray();

        return view('lessons::add', compact('pageTitle', 'courseId', 'position', 'lessons'));
    }

    public function store(LessonRequest $request, $courseId)
    {
        $dataLessons = $request->except('_token', '_method');

        $pathDocument = $dataLessons['document_id'];
        $pathVideo = $dataLessons['video_id'];

        $video = null;
        $document = null;

        $dataVideo = getFileVideo($pathVideo);
        $dataDocument = getFileDocument($pathDocument);

        if ($dataVideo) {
            $video = $this->videoRepository->createVideo(['url' => $dataVideo['url']], $dataVideo);
        }

        if ($dataDocument) {
            $document = $this->documentRepository->createDocument(['url' => $dataDocument['url']], $dataDocument);
        }


        $dataLessonsNew = [
            'durations' => $dataVideo['duration'] ?? 0.0,
            'parent_id' => $dataLessons['parent_id'] == 0 ? null : $dataLessons['parent_id'],
            'video_id' => $video ? $video->id : null,
            'course_id' => $courseId,
            'document_id' => $document ? $document->id : null,
        ];

        $dataLessons = array_merge($dataLessons, $dataLessonsNew);

        $this->lessonsRepository->create($dataLessons);

        return redirect()->route('admin.lessons.index', $courseId)->with('msg', __('lessons::messages.success'));
    }

    public function edit($courseId, $lessonId)
    {
        $pageTitle = "Sửa bài giảng";

        $lesson = $this->lessonsRepository->getOne($lessonId);

        $lessons = $this->lessonsRepository->getAllLessonsOk()->toArray();

        if (!$lesson) {
            abort('404');
        }

        return view('lessons::edit', compact('pageTitle', 'lesson', 'lessons', 'courseId'));
    }

    public function update(LessonRequest $request, $courseId, $lessonId)
    {
        $dataLessonsUpdate = $request->except('_token', '_method');

        $pathDocument = $dataLessonsUpdate['document_id'];
        $pathVideo = $dataLessonsUpdate['video_id'];

        $video = null;
        $document = null;

        $dataVideo = getFileVideo($pathVideo);
        $dataDocument = getFileDocument($pathDocument);

        if ($dataVideo) {
            $video = $this->videoRepository->createVideo(['url' => $dataVideo['url']], $dataVideo);
        }

        if ($dataDocument) {
            $document = $this->documentRepository->createDocument(['url' => $dataDocument['url']], $dataDocument);
        }

        $dataLessonsUpdateNew = [
            'durations' => $dataVideo['duration'] ?? 0.0,
            'parent_id' => $dataLessonsUpdate['parent_id'] == 0 ? null : $dataLessonsUpdate['parent_id'],
            'video_id' => $video ? $video->id : null,
            'course_id' => $courseId,
            'document_id' => $document ? $document->id : null,
        ];

        $dataLessonsUpdate = array_merge($dataLessonsUpdate, $dataLessonsUpdateNew);

        $this->lessonsRepository->update($lessonId, $dataLessonsUpdate);

        return redirect()
            ->route('admin.lessons.edit', [$courseId, $lessonId])
            ->with('msg', __('lessons::messages.success'));
    }

    public function delete($courseId, $lessonId)
    {
        $lesson = $this->lessonsRepository->getOne($lessonId);

        $status = $this->lessonsRepository->delete($lessonId);
        if ($status) {
            $video = $lesson->video->url;
            $document = $lesson->document->url;
            deleteFileStoge($video);
            deleteFileStoge($document);
        }

        return redirect()->route('admin.lessons.index', $courseId)->with('msg', __('lessons::messages.success'));
    }

    public function sort(Request $request, $courseId)
    {
        $pageTitle = "Sắp xếp bài giảng";

        $modules = $this->lessonsRepository->getLessons($courseId);

        return view('lessons::sort', compact('pageTitle', 'courseId', 'modules'));
    }

    public function handleSort(Request $request, $courseId)
    {
        $lessons = $request->lessons;

        if ($lessons) {
            foreach ($lessons as $index => $lessonId) {
               $this->lessonsRepository->update($lessonId,[
                   'position' =>  $index
               ]);
            }
        }

        return redirect()->route('admin.lessons.sort', $courseId)->with('msg', __('lessons::messages.success'));
    }

    public function getCategories($data)
    {
        $categories = [];
        foreach ($data['categories'] as $category) {
            $categories[$category] = [
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ];
        }
        return $categories;
    }

    public function getLessonsTable($lessons, $char = '', &$result = [])
    {
        if (!empty($lessons)) {
            foreach ($lessons as $lesson) {
                $row = $lesson;
                $row['name'] = $char . $row['name'];
                unset($row['sub_lessons']);
                $result[] = $row;
                if (!empty($lesson['sub_lessons'])) {
                    $this->getLessonsTable($lesson['sub_lessons'], $char . '|-- ', $result);
                }
            }
        }
        return $result;
    }
}
