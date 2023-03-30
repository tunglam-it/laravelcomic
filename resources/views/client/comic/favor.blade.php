@extends('client.homepage')
@section('title')
    <title>Truyện yêu thích</title>
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
                                        <h4>Truyện yêu thích</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @auth
                                @if(count($comics)>0)
                                    @foreach($comics as $comic)
                                        <div class="col-lg-2 col-md-3 col-sm-3">
                                            <div class="product__item">
                                                <div class="product__item__pic set-bg"
                                                     data-setbg="{{asset('storage/uploads/comic/'.$comic->image)}}"
                                                     style="height: 220px"
                                                >
                                                    <div class="ep">{{$comic->updated_at->diffForHumans()}}</div>
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
                                @else
                                    <span
                                        class="col-lg-8 col-md-6 col-sm-6 text-white">Bạn chưa yêu thích truyện nào</span>
                                @endif
                            @endauth
                            @guest()
                                <span class="col-lg-8 col-md-6 col-sm-6 text-white">Bạn cần <a
                                        href="{{route('client.login.show')}}" class="text-primary">đăng nhập</a> để hiển thị danh sách truyện yêu thích</span>
                            @endguest
                        </div>
                    </div>
                    @auth
                        {{$comics->links()}}
                    @endauth
                </div>
            </div>
        </div>
    </section>
@endsection
