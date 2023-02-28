<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-lg-2">
                <div class="header__logo">
                    <a href="{{route('client.home')}}">
                        <img src="{{asset('client/assets/img/logo.png')}}" alt="">
                    </a>
                </div>
            </div>
            <div class="col-lg-4" >
                <div class="header__nav">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li style="max-height: 10px"><a href="#">Thể loại <span
                                        class="arrow_carrot-down"></span></a>
                                <ul class="dropdown">
                                    @foreach($categories as $category)
                                        <li><a href="{{url('/the-loai/'.$category->slug)}}">{{$category->name}}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li><a href="{{route('client.favor')}}">Yêu thích</a></li>
                            <li><a href="{{route('client.news')}}">Tin tức</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="col-lg-4" style="margin-top: 15px">
                <form autocomplete="off" action="{{route('client.search')}}" method="get" class="form-inline"
                      id="form-ajax">
                    @csrf
                    <div style="position: relative;width: 100%">
                        <input type="text" id="search_box" name="search_input" class="form-control mr-2"
                               placeholder="Bạn cần tìm truyện gì" style="width: 100%">
                        <button id="btnSearch" type="submit"
                                style="position: absolute;border: none;top:7px;right: 10px"><i class="fa fa-search"></i>
                        </button>
                    </div>
                </form>
                <div id="search-result" class="col-lg-12 col-md-8 col-sm-9">

                </div>
            </div>
            <div class="col-lg-2 p-0">
                @guest()
                    <div class="header__right">
                        <a href="{{route('client.login.show')}}" style="font-size: 15px">Đăng nhập</a>
                        <a href="{{route('client.register.show')}}" style="font-size: 15px">Đăng ký</a>
                    </div>
                @endguest
                @auth
                    <div class="header__right">
                        <ul style="list-style: none;">
                            <li><span class="icon_profile text-white"></span>
                                <ul class="dropdown-user pl-2">
                                    <li class="mb-2 pr-2 pb-2 pt-2"><a href="{{route('client.info')}}">Thông tin tài khoản</a></li>
                                    <li class="mb-2 pr-2 pb-2"><a href="{{route('client.login.logout')}}">Đăng xuất</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                @endauth
            </div>
        </div>
        <div id="mobile-menu-wrap"></div>
    </div>
</header>
