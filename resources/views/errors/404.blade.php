@extends('client.homepage')
@section('title')
    <title>404 | Không tìm thấy</title>
@endsection
@section('content_client')
    <section class="blog-details spad">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <div class="blog__details__title mb-5">
                        <img src="{{asset('client/assets/img/404.png')}}" alt="">
                        <h4 class="text-white mt-2">Lỗi!!! Không tìm thấy đường dẫn này</h4>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="anime__details__episodes">
                        <div class="section-title">
                            <h5>Có thể bạn sẽ thích</h5>
                        </div>
                        <div class="row">
                            @if($randomComics)
                                @foreach($randomComics as $comic)
                                    <div class="col-lg-2 col-md-3 col-sm-3">
                                        <div class="product__item">
                                            <div class="product__item__pic set-bg"
                                                 data-setbg="{{asset('storage/uploads/comic/'.$comic->image)}}"
                                                 style="height: 220px"
                                            >
                                                <div class="ep">{{$comic->created_at->diffForHumans()}}</div>
                                                <div class="view"><i class="fa fa-eye"></i> {{$comic->views}}</div>
                                            </div>
                                            <div class="product__item__text">
                                                <h5>
                                                    <a href="{{url('/doc-truyen/'.$comic->slug)}}">{{$comic->name}}</a>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
