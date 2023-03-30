@extends('client.homepage')
@section('title')
    <title>Tin Tức Tổng Hợp</title>
@endsection
@section('content_client')
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__page__content">
                        <div class="product__page__title">
                            <div class="row">
                                <div class="col-lg-9 col-md-8 col-sm-8">
                                    <div class="section-title">
                                        <h4>Tin Mới Nhất</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @if(count($allNews)>0)
                                @foreach($allNews as $news)
                                    <div class="col-lg-3 col-md-4 col-sm-4">
                                        <div class="product__item">
                                            <div class="product__item__pic set-bg"
                                                 data-setbg="{{$news->image_crawl}}" style="height: 220px">
                                                <div class="ep">{{$news->created_at->diffForHumans()}}</div>
                                            </div>
                                            <div class="product__item__text">
                                                <h5><a href="{{url('/tin-tuc/'.$news->slug)}}">{{$news->title}}</a></h5>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <span class="col-lg-8 col-md-6 col-sm-6 text-white">Đang cập nhật tin tức mới nhất....</span>
                            @endif
                        </div>
                    </div>
                    {{$allNews->links()}}
                </div>
            </div>
        </div>
    </section>
@endsection
