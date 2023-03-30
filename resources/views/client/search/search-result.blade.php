@extends('client.homepage')
@section('title')
    <title>Kết quả tìm kiếm | ComicVui</title>
@endsection
@section('breadcrumb')
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{route('client.home')}}"><i class="fa fa-home"></i> Trang chủ</a>
                        <span>Tìm kiếm</span>
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
                                        <h4>Kết quả tìm kiếm:</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @if(count($comics)>0)
                                @foreach($comics as $comic)
                                    <div class="col-lg-2 col-md-3 col-sm-3">
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
                            @else
                                <span class="col-lg-8 col-md-6 col-sm-6 text-white">Không tìm thấy truyện khớp với từ khoá</span>
                            @endif
                        </div>
                    </div>
                    {{ $comics->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
