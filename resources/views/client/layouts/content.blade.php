@extends('client.homepage')
@section('title')
    <title>Đọc truyện online cập nhật mới nhất</title>
@endsection
@section('content_client')
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="trending__product">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="section-title">
                                    <h4>Truyện Mới Cập Nhật</h4>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="btn__all">
                                    <a href="#" class="primary-btn">Xem tất cả<span class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach($updatedComics as $comic)
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        <div class="product__item__pic set-bg"
                                             data-setbg="{{asset('storage/uploads/comic/'.$comic->image)}}">
                                            <div class="ep">{{$comic->updated_at->diffForHumans()}}</div>
                                            <div class="view"><i class="fa fa-eye"></i> {{$comic->views}}</div>
                                        </div>
                                        <div class="product__item__text">
                                            <h5><a href="{{url('/doc-truyen/'.$comic->slug)}}">{{$comic->name}}</a></h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="popular__product">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="section-title">
                                    <h4>Truyện Hay Xem Nhiều</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach($hotComics as $comic)
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        <div class="product__item__pic set-bg"
                                             data-setbg="{{asset('storage/uploads/comic/'.$comic->image)}}">
                                            <div class="ep">{{$comic->updated_at->diffForHumans()}}</div>
                                            <div class="view"><i class="fa fa-eye"></i> {{$comic->views}}</div>
                                        </div>
                                        <div class="product__item__text">
                                            <h5><a href="{{url('/doc-truyen/'.$comic->slug)}}">{{$comic->name}}</a></h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="product__sidebar">
                        <div class="product__sidebar__view">
                            <div class="section-title">
                                <h5>Tin Tức Tổng Hợp</h5>
                            </div>
                            @if(count($news)>0)
                                <ul class="filter__controls">
                                    <a href="{{route('client.news')}}">
                                        <li class="active"><b>XEM TẤT CẢ</b> <span class="arrow_right"></span></li>
                                    </a>
                                </ul>
                                <div class="filter__gallery">
                                    @foreach($news as $item)
                                        <div class="mb-3">
                                            <div class="product__sidebar__view__item set-bg mix day years"
                                                 data-setbg="{{$item->image_crawl}}">
                                                <div class="ep">{{$item->created_at->diffForHumans()}}</div>
                                            </div>
                                            <h5><a href="{{url('/tin-tuc/'.$item->slug)}}" class="mt-0"
                                                   style="color: white;font-size: 14px">{{$item->title}}</a></h5>

                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="filter__gallery text-white">
                                    Đang cập nhật tin tức mới...
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
