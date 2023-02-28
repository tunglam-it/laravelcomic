
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Mô tả
Dự án cá nhân về website đọc truyện, có trang quản lý truyện
- Admin Page: đăng nhập tài khoản admin, thêm sửa xoá truyện, danh mục truyện, chapter mới, tin tức
- Client Page: đăng nhập, đăng ký, đổi mật khẩu tài khoản người đọc, tìm kiếm truyện, phân loại truyện theo danh mục, thích/không thích truyện, đọc tin tức anime cập nhât

## Công nghệ sử dụng
    PHP Laravel, HTML, CSS, JS, Ajax
## Cài đặt
- Sau khi clone project về, chạy lệnh sau để cài đặt package: composer:install 
- Thực hiện lệnh sau để copy ra file env: cp .env.example .env
- Tạo DB mới tên là laravelcomic
- Trong file .env mới cập nhật:  DB_DATABASE=laravelcomic
- Tạo key cho dự án:  php artisan key:generate
- Tạo bảng:  php artisan migrate
- Trong thư mục database/data có sẵn file sql để insert
- Tạo folder chứa ảnh:  php artisan storage:link
- Sau khi cài đặt xong, thực hiện lệnh sau để xem dự án trên trình duyệt: php artisan ser
- Tài khoản Admin Page: admin@gmail.com 19981711
- Tài khoản Client Page có thể tự đăng kí hoặc sử dụng: guest1@gmail.com 123456789


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).




