@extends('layouts.client')


@section('content')


    <div class="breadcrumb-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-12">
                    <div class="breadcrumb-list">
                        <nav aria-label="breadcrumb" class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                                <li class="breadcrumb-item" aria-current="page">Chi tiết tin tức </li>
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
                <div class="col-lg-12 col-md-12">

                    <div class="blog">
                        <div class="blog-image">
                            <a href="#"><img class="img-fluid" src="{{ $newDetail->thumbnail }}" alt="Post Image"></a>
                        </div>
                        <div class="blog-info clearfix">
                            <div class="post-left">
                                <ul>
                                    <li>
                                        <div class="post-author">
                                            <a href="instructor-profile.html"><img src="{{  $newDetail->teachers->image }}" alt="Post Author"> <span>{{ $newDetail->teachers->name }}</span></a>
                                        </div>
                                    </li>
                                    <li><img class="img-fluid" src=" asset('client/assets/img/icon/icon-22.svg') }}" alt>{{ $newDetail->created_at }}</li>
                                    <li><img class="img-fluid" src=" asset('client/assets/img/icon/icon-23.svg') }}" alt>{{ $newDetail->newsCategoies->name }}</li>
                                </ul>
                            </div>
                        </div>
                        <h3 class="blog-title"><a href="blog-details.html">{{ $newDetail->name }}</a></h3>
                        <div class="blog-content">
                            <p>{!!  $newDetail->content  !!}</p>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
@endsection

