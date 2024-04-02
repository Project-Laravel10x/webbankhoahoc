@extends('layouts.client')


@section('content')

    <div class="breadcrumb-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-12">
                    <div class="breadcrumb-list">
                        <nav aria-label="breadcrumb" class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">Trang chủ</a></li>
                                <li class="breadcrumb-item" aria-current="page">{{ $pageTitle }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <section class="course-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-12">
                    @foreach($news as $new)
                        <div class="blog">
                            <div class="blog-image">
                                <a href="{{ route('detailNew',$new->slug) }}"><img class="img-fluid"
                                                                                   src="{{ $new->thumbnail }}"
                                                                                   alt="Post Image"></a>
                            </div>
                            <div class="blog-info clearfix">
                                <div class="post-left">
                                    <ul>
                                        <li>
                                            <div class="post-author">
                                                <a href="#"><img
                                                        src="{{ $new->teachers->image }}"
                                                        alt="Post Author">
                                                    <span>{{ $new->teachers->name }}</span></a>
                                            </div>
                                        </li>
                                        <li><img class="img-fluid" src="{{ asset('client//img/icon/icon-22.svg') }}"
                                                 alt>{{ $new->created_at }}
                                        </li>
                                        <li><img class="img-fluid"
                                                 src="{{ asset('client/assets/img/icon/icon-23.svg') }}"
                                                 alt>{{ $new->newsCategoies->name }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <h3 class="blog-title"><a href="{{ route('detailNew',$new->slug) }}">{{ $new->name }}</a>
                            </h3>
                            <div class="blog-content blog-read">
                                <p>{!! Str::limit($new->content, 200, '...') !!}</p>

                                <a href="{{ route('detailNew',$new->slug) }}" class="read-more btn btn-primary">ĐỌC
                                    NGAY</a>
                            </div>
                        </div>
                    @endforeach
                    <div class="row">
                        <div class="col-md-12">
                            {!! $news->links() !!}
                        </div>
                    </div>

                </div>

                <div class="col-lg-3 col-md-12 sidebar-right theiaStickySidebar">


                    <div class="card post-widget blog-widget">
                        <div class="card-header">
                            <h4 class="card-title">Bài viết gần đây</h4>
                        </div>
                        <div class="card-body">
                            <ul class="latest-posts">
                                @foreach($newsRecently as $newRecently)
                                    <li>
                                        <div class="post-thumb">
                                            <a href="{{ route('detailNew',$newRecently->slug) }}">
                                                <img class="img-fluid"
                                                     src="{{$newRecently->thumbnail}}" alt>
                                            </a>
                                        </div>
                                        <div class="post-info">
                                            <h4>
                                                <a href="{{ route('detailNew',$newRecently->slug) }}">{{$newRecently->name  }}</a>
                                            </h4>
                                            <p><img class="img-fluid"
                                                    src="{{asset('client/assets/img/icon/icon-22.svg') }}"
                                                    alt>{{$newRecently->created_at  }}</p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </section>
@endsection

