## Hướng dẫn sử dụng Sudo Page ##

**Giới thiệu:** Module tạo rss cho website trên SudoCore.

### Cài đặt để sử dụng ###

- Package cần phải có base `sudo/core` để có thể hoạt động không gây ra lỗi
- Để có thể sử dụng Package cần require theo lệnh `composer require sudo/rss`
- Chạy `php artisan vendor:publish --tag=sudo/rss` để public file config
- Cấu hình các dữ liệu muốn hiển thị tại file `config/SudoRss.php` 

Lưu ý: Model cấu hình để sử dụng Rss phải có các functions `getUrl()` và `getImage()`. Hai functions này mặc định đã có nếu extends lại `BaseModel`, cần phải viết lại để ghi đè giá trị cho chính xác.
