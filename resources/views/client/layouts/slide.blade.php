<section class="hero">
    <div class="container">
        <div class="hero__slider owl-carousel">
            @foreach($hotComics as $comic)
            <div class="item">
                <a href="{{url('/doc-truyen/'.$comic->slug)}}">
                    <img src="{{asset('storage/uploads/comic/'.$comic->image)}}" alt="">
                </a>
                <div class="slide-caption">
                    <h3>
                        <a href="{{url('/doc-truyen/'.$comic->slug)}}" class="pl-2 pr-2 pt-1">{{$comic->name}}</a>
                    </h3>
                    <a class="mr-2" href="#">Chapter {{count($comic->hasChapter)}}</a>
                    <span class="time"><i class="fa fa-clock-o"></i> {{$comic->updated_at->diffForHumans()}} </span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
