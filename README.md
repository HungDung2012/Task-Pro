# Task Pro - Phần mềm Quản lý Nhiệm vụ và Nhân viên

## Giới thiệu

Task Pro là một hệ thống quản lý nhiệm vụ và nhân viên được thiết kế để giúp doanh nghiệp theo dõi, phân công và quản lý công việc một cách hiệu quả. Phần mềm cung cấp giao diện trực quan, dễ sử dụng cho cả quản trị viên và nhân viên.

## Tính năng chính

### Dành cho Quản trị viên
- Quản lý tài khoản người dùng (thêm, sửa, xóa)
- Tạo và phân công nhiệm vụ cho nhân viên
- Theo dõi tiến độ công việc (Chờ xử lý, Đang thực hiện, Hoàn thành)
- Xem thống kê tổng quan về tình trạng nhiệm vụ
- Quản lý nhiệm vụ quá hạn và nhiệm vụ cần hoàn thành trong ngày

### Dành cho Nhân viên
- Xem danh sách nhiệm vụ được giao
- Cập nhật trạng thái nhiệm vụ
- Xem thống kê các nhiệm vụ cá nhân
- Quản lý thông tin cá nhân

## Yêu cầu hệ thống

- PHP 7.0 trở lên
- MySQL 5.6 trở lên
- Máy chủ web (Apache/Nginx)
- Trình duyệt web hiện đại

## Hướng dẫn cài đặt

1. **Chuẩn bị cơ sở dữ liệu**
   - Tạo cơ sở dữ liệu MySQL có tên "task_management_db"
   - Nhập dữ liệu từ tập tin "task_management_db.sql" vào cơ sở dữ liệu

2. **Cấu hình kết nối**
   - Mở tập tin "DB_connection.php"
   - Cập nhật thông tin kết nối cơ sở dữ liệu (nếu cần)
   ```php
   $sName = "localhost";
   $uName = "root";
   $pass  = "";
   $db_name = "task_management_db";
   ```

3. **Triển khai mã nguồn**
   - Sao chép tất cả tập tin vào thư mục gốc của máy chủ web
   - Đảm bảo máy chủ web có quyền đọc/ghi đối với các tập tin và thư mục

## Cấu trúc thư mục

- **/app** - Chứa các lớp mô hình và logic xử lý
- **/css** - Chứa các tập tin CSS
- **/img** - Chứa hình ảnh và tài nguyên đồ họa
- **/inc** - Chứa các thành phần giao diện (header, navigation)

## Cách sử dụng

1. **Đăng nhập**
   - Truy cập "login.php"
   - Đăng nhập với tài khoản quản trị hoặc nhân viên

2. **Trang chủ**
   - Xem tổng quan về nhiệm vụ
   - Truy cập các chức năng thông qua menu điều hướng

3. **Quản lý nhiệm vụ**
   - Tạo nhiệm vụ mới (dành cho quản trị viên)
   - Xem, cập nhật, xóa nhiệm vụ
   - Xem tất cả nhiệm vụ hoặc nhiệm vụ của cá nhân

4. **Quản lý người dùng** (dành cho quản trị viên)
   - Thêm, sửa, xóa tài khoản người dùng
   - Quản lý quyền truy cập

## Tài khoản mặc định

- **Quản trị viên**:
  - Tên đăng nhập: admin
  - Mật khẩu: admin123

- **Nhân viên**:
  - Tên đăng nhập: nhanvien
  - Mật khẩu: 123456


