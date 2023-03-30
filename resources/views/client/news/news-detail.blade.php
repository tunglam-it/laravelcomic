@extends('client.homepage')
@section('title')
    <title>{{$news->title}}</title>
@endsection
@section('breadcrumb')
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{route('client.home')}}"><i class="fa fa-home"></i> Trang chủ</a>
                        <a href="{{route('client.news')}}">Tin Tức Tổng Hợp</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content_client')
    <section class="blog-details spad">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <div class="blog__details__title mb-5">
                        <h3 class="text-white mb-3">{{$news->title}}</h3>
                        <h5 class="text-white">{{date_format($news->updated_at,'d-m-Y')}}</h5>
                    </div>
                </div>
                <div class="col-lg-10 mt-3">
                    <div class="blog__details__content">
                        <div class="blog__details__text" style="color: white;">
                            <div >{!! $news->content !!}</div>
                        </div>
                        <div class="blog__details__btns">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="blog__details__btns__item">
                                        <h5 style="color: white">
                                            Nguồn: <a href="{{$news->url}}">chuuniotaku.com</a>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="blog__details__comment">
                            <h4>Chia sẻ với mọi người:</h4>
                            <div class="blog__details__social">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{route('client.news.detail',['slug'=>$news->slug])}}" target="_blank" class="facebook btn btn-primary mr-2"><i class="fa fa-facebook-square"></i>
                                    Facebook</a>
                                <a href="https://twitter.com/share?text=&url={{route('client.news.detail',['slug'=>$news->slug])}}" target="_blank" class="twitter btn btn-info"><i class="fa fa-twitter-square"></i>
                                    Twitter</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
