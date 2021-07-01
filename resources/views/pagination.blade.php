@if($paginator->hasPages())
<ul class="pages">
    @if($paginator->onFirstPage())
        <li><a><i class="fa fa-angle-double-left"></i></a></li>
    @else
        <li><a href="{{$paginator->previousPageUrl()}}"><i class="fa fa-angle-double-left"></i></a></li>
    @endif

    @if(is_array($elements[0]))
        @foreach($elements[0] as $page => $url)
            @if($page == $paginator->currentPage())
                <li class="active"><a href="{{$url}}" id="btn2">{{$page}}</a></li>
            @else
                <li class=""><a href="{{$url}}" id="btn2">{{$page}}</a></li>
            @endif
        @endforeach
    @endif

    @if($paginator->hasMorePages())
        <li><a href="{{$paginator->nextPageUrl()}}"><i class="fa fa-angle-double-right" target="pro"></i></a></li>
    @else
        <li><a><i class="fa fa-angle-double-right" target="pro"></i></a></li>
    @endif
    <!-- <li class="" id="btn1"><a href="">1</a></li>
    <li class=""><a href="" id="btn2">2</a></li>
    <li class=""><a href="" id="btn3">3</a></li>
    <li class=""><a href="" id="btn4">4</a></li>
    <li><a href=""><i class="fa fa-angle-double-right" target="pro"></i></a></li> -->
</ul>
@endif
