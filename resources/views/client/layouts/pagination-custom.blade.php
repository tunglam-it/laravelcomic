@if ($paginator->hasPages())
    <div class="product__pagination">
        {{--Previous Page Link--}}
        @if($paginator->onFirstPage())
            <a href="#" class="is-disabled"><i class="fa fa-angle-double-left"></i></a>
        @else
            <a href="{{$paginator->previousPageUrl()}}"><i class="fa fa-angle-double-left"></i></a>
        @endif
        {{--Pagination Element--}}
        @foreach($elements as $element)
            @if(is_array($element))
                @foreach($element as $page => $url)
                    @if($page == $paginator->currentPage())
                        <a href="#" class="current-page is-disabled">{{$page}}</a>
                    @elseif (($page == $paginator->currentPage() + 1 || $page == $paginator->currentPage() + 2) || $page == $paginator->lastPage() || ($page == $paginator->currentPage() - 1 || $page == $paginator->currentPage() - 2))
                        <a href="{{$url}}">{{$page}}</a>
                    @elseif($page == $paginator->lastPage()-1)
                        <span class="is-disabled text-white"><i class="fa fa-ellipsis-h"></i></span>
                    @endif
                @endforeach
            @endif
        @endforeach
        {{--Next Page Link--}}
        @if($paginator->hasMorePages())
            <a href="{{$paginator->nextPageUrl()}}"><i class="fa fa-angle-double-right"></i></a>
        @else
            <a href="#" class="is-disabled"><i class="fa fa-angle-double-right"></i></a>
        @endif
    </div>
@endif
