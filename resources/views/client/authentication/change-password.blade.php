@extends('client.homepage')
@section('title')
    <title>Thông tin tài khoản</title>
@endsection
@section('content_client')
    <section class="signup spad">
        <div class="container">
            <div class="row justify-content-center">
                <div class="login__form">
                    <h3>Thông tin tài khoản</h3>
                    @if(session('message'))
                        <span class="m-2 text-success">{{session('message')}} :)</span>
                    @endif
                    <form action="{{route('client.info.change')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="input__item">
                            <input class="@error('email') is-invalid @enderror" type="email" placeholder="Email" value="{{$user->email}}" disabled>
                            <span class="icon_mail"></span>
                            @error('email')
                            <div class="alert-form">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="input__item">
                            <input class="@error('name') is-invalid @enderror" type="text" placeholder="Tên hiển thị" value="{{$user->name}}" disabled>
                            <span class="icon_profile"></span>
                            @error('name')
                            <div class="alert-form">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="input__item">
                            <input class="@error('old_password') is-invalid @enderror" type="password" placeholder="Mật khẩu hiện tại" name="old_password" minlength="8" required>
                            <span class="icon_lock"></span>
                            @error('old_password')
                            <div class="alert-form">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="input__item">
                            <input class="@error('new_password') is-invalid @enderror" type="password" placeholder="Mật khẩu mới" name="new_password" minlength="8" required>
                            <span class="icon_lock"></span>
                            @error('new_password')
                            <div class="alert-form">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="input__item">
                            <input class="@error('confirm_password') is-invalid @enderror" type="password" placeholder="Xác nhận mật khẩu" name="confirm_password" minlength="8" required>
                            <span class="icon_lock"></span>
                            @error('confirm_password')
                            <div class="alert-form">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="site-btn">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
