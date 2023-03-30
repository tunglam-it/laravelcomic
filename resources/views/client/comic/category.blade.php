@extends('client.homepage')
@section('title')
    <title>{{$category->name}}</title>
@endsection
@section('breadcrumb')
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{route('client.home')}}"><i class="fa fa-home"></i> Trang chủ</a>
                        <span>{{$category->name}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                                        <h4>{{$category->name}}</h4>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-4">
                                    <div class="product__page__filter">
                                        <div class="row ml-1 mr-1">
                                            <span>Sắp xếp theo:</span>
                                            <select class="form-control col-lg-7 col-md-7 col-sm-7">
                                                <option value="">A-Z</option>
                                                <option value="">Z-A</option>
                                                <option value="">Đang cập nhật</option>
                                                <option value="">Đã hoàn thành</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @if(count($comics)>0)
                                @foreach($comics as $comic)
                                    <div class="col-lg-2 col-md-3 col-sm-3">
                                        <div class="product__item">
                                            <div class="product__item__pic set-bg" style="height: 220px"
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
                            @else
                                <span class="col-lg-8 col-md-6 col-sm-6 text-white">Đang cập nhật truyện trong thể loại này....</span>
                            @endif
                        </div>
                    </div>
                    {{$comics->links()}}
                </div>
            </div>
        </div>
    </section>
@endsection
