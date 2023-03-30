@extends('client.homepage')
@section('title')
    <title>Đăng ký</title>
@endsection
@section('content_client')
<!-- Signup Section Begin -->
<section class="signup spad">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="login__form">
                    <h3>Đăng Ký</h3>
                    <form action="{{route('client.register.perform')}}" method="post">
                        @csrf
                        <div class="input__item">
                            <input class="@error('email') is-invalid @enderror" type="email" placeholder="Email" name="email" value="{{old('email')}}" required>
                            <span class="icon_mail"></span>
                            @error('email')
                            <div class="alert-form">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="input__item">
                            <input class="@error('name') is-invalid @enderror" type="text" placeholder="Tên hiển thị" name="name" value="{{old('name')}}">
                            <span class="icon_profile"></span>
                            @error('name')
                            <div class="alert-form">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="input__item">
                            <input class="@error('password') is-invalid @enderror" type="password" placeholder="Password" name="password"
                                   minlength="8" required>
                            <span class="icon_lock"></span>
                            @error('password')
                            <div class="alert-form">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="site-btn">Đăng ký</button>
                    </form>
                    <h5>Bạn đã có tài khoản? <a href="{{route('client.login.show')}}">Đăng nhập!</a></h5>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Signup Section End -->
@endsection

