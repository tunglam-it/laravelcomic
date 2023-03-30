@extends('client.homepage')
@section('title')
    <title>{{$comic->name.' '.$currentChapter->title}}</title>
@endsection
@section('breadcrumb')
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{route('client.home')}}"><i class="fa fa-home"></i> Trang chủ</a>
                        <a href="{{url('doc-truyen/'.$comic->slug)}}">{{$comic->name}}</a>
                        <span>{{$currentChapter->title}}</span>
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
                        <h3 class="text-white mb-3">{{$comic->name}}</h3>
                        <h5 class="text-white">{{$currentChapter->title}}</h5>
                    </div>
                </div>
                <div class="col-lg-10 mb-2 p-2" style="background-color: rgb(7,7,70)">
                    <div class="text-center">
                        <i class="fa fa-info-circle text-white"></i>
                        <span class="mb-2 text-white">Sử dụng phím mũi tên trái (<-) hoặc phải (->) để chuyển chương</span>
                    </div>
                </div>
                <div class="col-lg-10 p-1 scroll-chapter">
                    <div style="display: flex;justify-content: center;align-items: center">
                        <a href="{{'client.home'}}"><i class="fa fa-home text-white mr-1" style="font-size: 35px;"></i></a>
                        @if($prevChapter==null)
                            <a class="is-disabled" href="#" id="prev-chapter">
                                <span><i class="fa fa-arrow-circle-o-left text-white ml-3 mr-1"
                                         style="font-size:35px"></i></span></a>
                        @else
                            <a href="{{url('doc-truyen/'.$comic->slug.'/'.$prevChapter)}}" id="prev-chapter">
                                <span><i class="fa fa-arrow-circle-o-left text-white ml-3 mr-1"
                                         style="font-size:35px"></i></span></a>
                        @endif
                        <div class="col-sm-4">
                            <select class="text-black form-control font-weight-bold" id="select-chapter">
                                @foreach($comic->hasChapter as $chapter)
                                    <option
                                        value="{{url('doc-truyen/'.$comic->slug.'/'.$chapter->slug_chapter)}}">{{$chapter->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        @if($nextChapter==null)
                            <a class="is-disabled" href="#" id="prev-chapter">
                                <span><i class="fa fa-arrow-circle-o-right text-white mr-3 ml-1"
                                         style="font-size:35px"></i></span></a>
                        @else
                            <a href="{{url('doc-truyen/'.$comic->slug.'/'.$nextChapter)}}" id="prev-chapter">
                                <span><i class="fa fa-arrow-circle-o-right text-white mr-3 ml-1"
                                         style="font-size:35px"></i></span></a>
                        @endif
                        @auth
                            <span
                                class="btn btn-outline-light ml-1 follow-btn"
                                onclick="changeLikedComic('follow',{{$comic->id}})"
                                style="{{$likedComic?"display: none":""}}">
                                <i class="fa fa-heart mr-1" style="font-size: 14px"></i>Theo dõi</span>
                            <span
                                class="btn btn-outline-light ml-1 unfollow-btn"
                                onclick="changeLikedComic('unfollow',{{$comic->id}})"
                                style="{{$likedComic?"":"display: none"}}">
                                <i class="fa fa-times mr-1" style="font-size: 16px"></i>Bỏ theo dõi</span>
                        @endauth
                    </div>
                </div>
                <div class="col-lg-10 mt-3">
                    <div class="blog__details__content">
                        <div class="blog__details__text">
                            <p>{!! $currentChapter->chapter_content !!}</p>
                        </div>
                        <div class="blog__details__btns">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="blog__details__btns__item">
                                        <h5>
                                            @if($prevChapter==null)
                                                <a class="is-disabled" href="#">
                                                    <span class="arrow_left"></span> Chương trước</a>
                                            @else
                                                <a href="{{url('doc-truyen/'.$comic->slug.'/'.$prevChapter)}}"
                                                   id="prev-chapter">
                                                    <span class="arrow_left"></span> Chương trước</a>
                                            @endif
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="blog__details__btns__item next__btn">
                                        <h5>
                                            @if($nextChapter==null)
                                                <a class="is-disabled" href="#">Chương sau <span
                                                        class="arrow_right"></span></a></h5>
                                        @else
                                            <a href="{{url('doc-truyen/'.$comic->slug.'/'.$nextChapter)}}"
                                               id="next-chapter">Chương sau <span
                                                    class="arrow_right"></span></a></h5>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="blog__details__comment">
                            <h4>Chia sẻ với mọi người:</h4>
                            <div class="blog__details__social">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{route('client.chapter',['slug'=>$comic->slug,'slug_chapter'=>$currentChapter->slug_chapter])}}" target="_blank" class="facebook btn btn-primary mr-2"><i class="fa fa-facebook-square"></i> Facebook</a>
                                <a href="https://twitter.com/share?text=&url={{route('client.chapter',['slug'=>$comic->slug,'slug_chapter'=>$currentChapter->slug_chapter])}}" target="_blank" class="twitter btn btn-info"><i class="fa fa-twitter-square"></i> Twitter</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script type="text/javascript">
        //chuyển chap bằng cách chọn trên thẻ select
        $('#select-chapter').on('change', function () {
            let url = $(this).val();
            if (url) {
                window.location = url
            }
            return false;
        });

        current_chapter();

        // hiển thị chapter hiện tại trong ô select
        function current_chapter() {
            let url = window.location.href;
            $('#select-chapter').find('option[value="' + url + '"]').attr('selected', true)
        };

        //Chuyển chap bằng phím mũi tên
        $(document).on('keydown', function (event) {
            let keycode = (event.keyCode ? event.keyCode : event.which);
            let prevUrl = $('#prev-chapter').attr('href');
            let nextUrl = $('#next-chapter').attr('href');
            if (keycode == 37) {
                window.location = prevUrl;
            }
            if (keycode == 39) {
                window.location = nextUrl;
            }
        });
    </script>
@endsection
