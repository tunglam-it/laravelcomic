@extends('client.homepage')
@section('title')
    <title>{{$comic->name}}</title>
@endsection
@section('breadcrumb')
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{route('client.home')}}"><i class="fa fa-home"></i> Trang chủ</a>
                        <span>{{$comic->name}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content_client')
    <!-- Anime Section Begin -->
    <section class="anime-details spad">
        <div class="container">
            <div class="anime__details__content">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="anime__details__pic set-bg"
                             data-setbg="{{asset('storage/uploads/comic/'.$comic->image)}}">
                            <div class="comment"><i class="fa fa-comments"></i> 11</div>
                            <div class="view"><i class="fa fa-eye"></i> 9141</div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="anime__details__text">
                            <div class="anime__details__title text-white">
                                <h4>{{$comic->name}}</h4>
                            </div>
                            <p>{{$comic->description}}</p>
                            <div class="anime__details__widget">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <ul>
                                            <li><span>Tác giả:</span> {{$comic->author}}</li>
                                            <li><span>Ngày đăng:</span> {{date_format($comic->created_at,"d-m-Y")}}</li>
                                            <li>
                                                <span>Tình trạng:</span> {{$comic->status=='0'?'Đang cập nhật':'Đã hoàn thành'}}
                                            </li>
                                            <li><span>Lượt xem:</span> {{$comic->views}}</li>
                                            <li><span>Thể loại:</span>
                                                @if(count($categories)>0)
                                                    @foreach($categories as $category)
                                                        <a class="btn btn-success text-white"
                                                           href="{{url('the-loai/'.$category->slug)}}">{{$category->name}}
                                                        </a>
                                                    @endforeach
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="anime__details__btn">
                                @auth
                                    <button
                                        class="follow-btn"
                                        onclick="changeLikedComic('follow',{{$comic->id}})"
                                        style="{{$likedComic?"display: none":""}}">
                                        <i class="fa fa-heart-o"></i> Thích truyện
                                    </button>
                                    <button
                                        class="unfollow-btn"
                                        onclick="changeLikedComic('unfollow',{{$comic->id}})"
                                        style="{{$likedComic?"":"display: none"}}">
                                        <i class="fa fa-times"></i> Bỏ thích truyện
                                    </button>
                                @endauth
                                @if(!empty($firstChapter))
                                    <a href="{{url('/doc-truyen/'.$comic->slug.'/'.$firstChapter->slug_chapter)}}"
                                       class="watch-btn"><span style="border-radius: 4px">Đọc ngay</span></a>
                                @else
                                    <a href="#" class="watch-btn"><span style="border-radius: 4px">Đang cập nhật</span></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="anime__details__episodes">
                        <div class="section-title">
                            <h5>Danh sách chapter</h5>
                        </div>
                        <div class="section-chapter">
                            @if(count($allChapter)>0)
                                @foreach($allChapter as $chapter)
                                    <div>
                                        <a href="{{url('/doc-truyen/'.$comic->slug.'/'.$chapter->slug_chapter)}}">{{$chapter->title}}</a>
                                        <span class="float-right text-white mr-3 mt-1"
                                              style="font-size: 14px">{{date_format($comic->updated_at,'d-m-Y')}}</span>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-white">Đang cập nhật thêm chapter mới...</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <div class="anime__details__sidebar">
                        <div class="section-title">
                            <h5>Truyện cùng danh mục</h5>
                        </div>
                        @if(count($comicSameCate)>0)
                            @foreach($comicSameCate as $comic)
                                <div class="col-lg-3 col-md-4 col-sm-4" style="display: inline-block">
                                    <div class="product__item">
                                        <div class="product__item__pic set-bg"
                                             data-setbg="{{asset('storage/uploads/comic/'.$comic->image)}}"
                                         style="height: 220px">
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
                            <span style="color: white">Đang cập nhật truyện cùng danh mục...</span>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 float-lg-right float-md-right">
                    <div class="anime__details__sidebar">
                        <div class="section-title">
                            <h5>Truyện cùng tác giả</h5>
                        </div>
                        @if(count($comicsSameAuthor)>0)
                            @foreach($comicsSameAuthor as $comic)
                                <div class="product__sidebar__view">
                                    <div class="image-search">
                                        <img src="{{asset('storage/uploads/comic/'.$comic->image)}}" alt="">
                                    </div>
                                    <div class="info-search">
                                        <h5><a href="#" style="color: white;font-size: 1rem">{{$comic->name}}</a></h5>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <span style="color: white">Đang cập nhật truyện cùng tác giả...</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Anime Section End -->
@endsection

