@extends('layouts.client')

@section('content')

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
                                                        <a class="text-decoration-none" href="{{  $item['slug']}}">
                                                            @if(last(explode('/', request()->path())) ==$item['slug'] )
                                                                <strong style="color: red">{{ $item['name'] }}</strong>
                                                            @else
                                                                {{ $item['name'] }}
                                                            @endif
                                                        </a>
                                                    </p>
                                                    <div>
                                                        <span>{{ formatTime($item['durations']) }}</span>
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
                <div class="col-lg-8">

                    <div class="student-widget lesson-introduction">
                        <div class="lesson-widget-group">
                            <h4 class="tittle">{{ $lessonData->name }}</h4>
                            <div class="introduct-video">
                                <iframe width="815" height="450" src="{{ $lessonData->video?->url }}"
                                        title=""
                                        frameborder="0"
                                        allow="accelerometer; autoplay;  clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                </a>
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
                                    <a href="{{  $buttonPrevAndNext['nextLesson']?->slug}}" class="btn btn-action
                                        @if($buttonPrevAndNext['nextLesson'] == null) d-none @endif">Sau</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <script>
        // Tạo một đối tượng player cho video YouTube
        var player;

        function onYouTubeIframeAPIReady() {
            player = new YT.Player('youtube-player', {
                events: {
                    'onReady': onPlayerReady,
                    'onStateChange': onPlayerStateChange
                }
            });
        }

        // Khi video đã sẵn sàng
        function onPlayerReady(event) {
            // Bắt đầu theo dõi sự kiện thay đổi trạng thái của video
            event.target.playVideo();
        }

        // Xử lý sự kiện thay đổi trạng thái của video
        function onPlayerStateChange(event) {
            if (event.data == YT.PlayerState.ENDED) {
                // Xử lý khi video đã kết thúc
                // Ví dụ: Hiển thị thông báo, chuyển sang video khác, vv.
                alert('Video đã kết thúc');
            }
        }

    </script>

@endsection



