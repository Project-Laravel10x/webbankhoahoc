@extends('layouts.client')


@section('style')
    <style>
        .video-js button {
            background: #000;
        }

        .course-lesson span {
            color: #fff;
        }

        .disabled-link {
            pointer-events: none;
            background-color: grey;
            color: white;
            cursor: not-allowed;
        }

        .disabled-name {
            pointer-events: none;
            color: grey;
            cursor: not-allowed;
        }
    </style>
@endsection

@section('content')

    @if(session('notification'))
        <script>alert("Bạn chưa hoàn thành bài giảng trước đó")</script>
    @endif

    <div class="course-student-header bg-body-secondary">
        <div class="container">
            <h5>{{ $pageTitle }}</h5>
        </div>
    </div>

    <section class="page-content course-sec course-lesson">
        <div class="container-xl">
            <div class="row">
                <div class="col-lg-4">
                    <div class="lesson-group" style="max-height: 535px; overflow-y: auto;">
                        @foreach($lessonsData as $key => $lesson)
                            <div class="course-card">
                                <h6 class="cou-title">
                                    <a href="#" aria-expanded="false">{{ $lesson['name'] }}</a>
                                </h6>
                                <div id="collapse{{ $key }}" class="card-collapse">
                                    <ul>
                                        @if(!empty($lesson['sub_lessons']))
                                            @foreach($lesson['sub_lessons'] as $item)
                                                <li>
                                                    <p style="max-width: 250px;"><img
                                                            src="{{ asset('client/assets/img/icon/play.svg') }}" alt
                                                            class="me-2">
                                                        @if(last(explode('/', request()->path())) == $item['slug'] )
                                                            <a class="text-decoration-none"
                                                               href="{{  $item['slug']}}"><strong
                                                                    style="color: red">{{ $item['name'] }}</strong>
                                                            </a>
                                                        @else
                                                            <a class="text-decoration-none @if(!checkCompletedLesson($item['id'])) disabled-name @endif "
                                                               href="{{  $item['slug']}}"><strong
                                                                >{{ $item['name'] }}</strong> </a>
                                                        @endif
                                                    </p>
                                                    <div class="d-flex">
                                                        <p>{{ formatTime($item['durations']) }}</p>
                                                        @if(!checkCompletedLesson($item['id']))
                                                            <i class="fa-solid fa-lock ms-1 mt-1 lock"></i>
                                                        @endif
                                                    </div>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </div>


                </div>
                <form hidden id="formToken" action="{{ route('mark-lesson-completed') }}" method="post">
                    @csrf
                </form>
                <div class="col-lg-8">

                    <div class="student-widget lesson-introduction">
                        <div class="lesson-widget-group">
                            <h4 class="tittle">{{ $lessonData->name }}</h4>
                            <div class="introduct-video">
                                @if($lessonData->video_id != null)
                                    @if (strstr($lessonData->video?->url, '/storage/videos/'))
                                        <video
                                            id="my-video"
                                            class="video-js"
                                            controls
                                            preload="auto"
                                            width="770px"
                                            height="450px"
                                            data-setup="{}"

                                        >
                                            <source src="{{ route('data.stream') }}?video={{$lessonData->video?->url}}"
                                                    type="video/mp4"/>
                                            <p class="vjs-no-js">
                                                To view this video please enable JavaScript, and consider upgrading to a
                                                web browser that
                                            </p>
                                        </video>
                                    @else
                                        <iframe width="815" height="450" src="{{ $lessonData->video?->url }}"
                                                title=""
                                                frameborder="0"
                                                allow="accelerometer; autoplay;  clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                referrerpolicy="strict-origin-when-cross-origin"
                                                allowfullscreen></iframe>

                                    @endif
                                    @if($lessonData->document?->id)
                                        <form action="{{ route('students.downloadFile') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="document_id"
                                                   value="{{ $lessonData->document?->id }}">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa-solid fa-file-arrow-down fa-1x me-2"></i>Tải tài liệu
                                            </button>
                                        </form>
                                    @endif
                                    <div class="d-flex justify-content-between mt-3">
                                        <a href="{{  $buttonPrevAndNext['previousLesson']?->slug }}" class="btn btn-action
                                       @if($buttonPrevAndNext['previousLesson'] == null) d-none @endif">Trước</a>
                                        <a disabled
                                           href="{{ $buttonPrevAndNext['nextLesson']?->slug }}"
                                           id="nextLessonSlug"
                                           class="btn btn-action
                                        @if($buttonPrevAndNext['nextLesson'] == null) d-none @endif
                                        @if(!checkCompletedLesson($lessonData['id'])) disabled-link @endif">Sau</a>
                                    </div>
                                @else
                                    @if($lessonData->parent_id != null)
                                        <p>{!!  $lessonData->description  !!}</p>
                                        <form action="{{ route('students.generatePdf') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="course_name"
                                                   value="{{ $lessonData->courses->name }}">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa-solid fa-file-arrow-down fa-1x me-2"></i>Nhận chứng chỉ
                                            </button>
                                        </form>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection


@section('js_custom')
    <script>
        window.addEventListener('DOMContentLoaded', () => {

            const modalElement = document.querySelector('#my-video');
            let isVideoEnded = false;

            if (modalElement != null) {
                const videoPlayer = videojs(modalElement)
                const videoKey = `resume_playback_course_{{$lessonData->course_id}}_video_{{$lessonData->id}}`;

                const getDataVideo = function () {
                    const savedVideoState = localStorage.getItem(videoKey);
                    if (savedVideoState) {
                        const videoState = JSON.parse(savedVideoState);
                        videoPlayer.currentTime(videoState.currentTime);
                        videoPlayer.volume(videoState.volume);
                    }
                }
                getDataVideo()

                videoPlayer.on('ended', function () {
                    isVideoEnded = true;
                    const savedVideoState = JSON.parse(localStorage.getItem(videoKey));
                    savedVideoState.currentTime = 0;
                    savedVideoState.volume = 1;
                    localStorage.setItem(videoKey, JSON.stringify(savedVideoState));

                    markLessonCompleted()

                    window.location.href = document.getElementById('nextLessonSlug').getAttribute('href');
                });

                window.addEventListener('beforeunload', function (e) {
                    if (!isVideoEnded) {
                        e.preventDefault();

                        const videoState = {
                            currentTime: videoPlayer.currentTime(),
                            volume: videoPlayer.volume(),
                        };
                        localStorage.setItem(videoKey, JSON.stringify(videoState));
                    }
                });

                window.addEventListener('keydown', function (event) {
                    switch (event.key) {
                        case 'ArrowRight':
                            videoPlayer.currentTime(videoPlayer.currentTime() + 10);
                            break;
                        case 'ArrowLeft':
                            videoPlayer.currentTime(videoPlayer.currentTime() - 10);
                            break;
                        default:
                            break;
                    }
                });

                window.addEventListener('load', function () {
                    videoPlayer.play();
                });
            }


            const markLessonCompleted = function () {
                const formToken = document.getElementById('formToken');
                const csrfToken = formToken.querySelector('input[name="_token"]').value;

                fetch('{{route('mark-lesson-completed')}}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        lesson_id: {{$lessonData->id}}
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data.message);
                    })
                    .catch(error => console.error('Error:', error));
            }

            window.addEventListener('load', function () {
                if (modalElement == null) {
                    markLessonCompleted()
                }
            });

        })
    </script>
@endsection



