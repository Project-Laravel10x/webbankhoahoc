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

                    <div class="lesson-group">
                        @foreach($lessonsData as $key => $lesson)
                            <div class="course-card">
                                <h6 class="cou-title">
{{--                                    <span class="mt-3">{{ count($lesson['sub_lessons']) }} Bài giảng</span>--}}
                                    <a class="collapsed" data-bs-toggle="collapse" href="#collapse{{ $key }}"
                                       aria-expanded="false">{{ $lesson['name'] }}
                                    </a>
                                </h6>
                                @if(!empty($lesson['sub_lessons']))
                                    @foreach($lesson['sub_lessons'] as $item)
                                        <div id="collapse{{ $key }}" class="card-collapse collapse" style>
                                            <ul>
                                                <li>
                                                    <p><img src="{{ asset('client/assets/img/icon/play.svg') }}"
                                                            alt class="me-2"><a class="text-decoration-none"
                                                            href="{{  $item['slug']}}">{{ $item['name'] }}</a>
                                                    </p>
                                                    <div>
                                                        <span>{{ formatTime($item['durations'])  }}</span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        @endforeach
                    </div>

                </div>
                <div class="col-lg-8">

                    <div class="student-widget lesson-introduction">
                        <div class="lesson-widget-group">
                            <h4 class="tittle">{{ $lessonData->name }}</h4>
                            <div class="introduct-video">
                                <iframe width="700" height="400" src="{{ $lessonData->video?->url }}"
                                        title="LỬNG LƠ ( MASEW x BRAY FT REDT x Ý TIÊN ) - LỬNG VÀ LER  | NHẠC HOT TIKTOK HIỆN NAY"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection


