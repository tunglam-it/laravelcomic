@extends('client.homepage')
@section('title')
    <title>Đăng nhập</title>
@endsection
@section('content_client')
    <!-- Login Section Begin -->
    <section class="signup spad">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="login__form">
                        <h3>Đăng Nhập</h3>
                        @if(session('message'))
                            <h5 class="mt-0 mb-3">{{session('message')}}</h5>
                        @endif
                        <form action="{{route('client.login.perform')}}" method="post">
                            @csrf
                            <div class="input__item">
                                <input class="@error('email') is-invalid @enderror" type="email" placeholder="Email"
                                       name="email" value="{{old('email')}}" required>
                                <span class="icon_mail"></span>
                                @error('email')
                                <div class="alert-form">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="input__item">
                                <input class="@error('password') is-invalid @enderror" type="password"
                                       placeholder="Password" name="password" minlength="8" required>
                                <span class="icon_lock"></span>
                                @error('password')
                                <div class="alert-form">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="site-btn">Đăng nhập</button>
                        </form>

                        <h5>Bạn chưa có tài khoảnt ? <a href="{{route('client.register.show')}}">Đăng ký!</a></h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Login Section End -->
@endsection
