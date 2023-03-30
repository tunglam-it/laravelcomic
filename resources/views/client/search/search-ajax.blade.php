<ul id="list-result-ajax">
    @if(count($comics)>0)
        @foreach($comics as $comic)
            <li>
                <a href="{{url('/doc-truyen/'.$comic->slug)}}">
                    <div class="image-search">
                        <img src="{{asset('storage/uploads/comic/'.$comic->image)}}" alt="">
                    </div>
                    <div class="info-search">
                        <h3 id="h3-ajax">{{$comic->name}}</h3>
                        <span>
                            @if(count($comic->hasChapter)>0)
                                Chương {{count($comic->hasChapter)}}
                            @else
                                Đang cập nhật
                            @endif
                        </span>
                        <span class="font-italic">
                            @foreach($comic->belongCategory as $category)
                                {{$category->name}},
                            @endforeach
                        </span>
                        <span style="font-weight: bold">{{$comic->author}}</span>
                    </div>
                </a>
            </li>
        @endforeach
    @endif
</ul>
