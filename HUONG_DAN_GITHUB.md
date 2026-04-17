# Hướng dẫn Đưa Website lên GitHub

Tôi đã giúp bạn chuẩn bị sẵn các tệp cần thiết (`.gitignore`, `README.md`) và khởi tạo Git trong thư mục này. Bạn chỉ cần thực hiện các bước sau để đưa lên GitHub:

### Bước 1: Cấu hình danh tính (Nếu bạn chưa từng dùng Git)
Mở terminal tại thư mục dự án và chạy:
```bash
git config --global user.email "email-cua-ban@example.com"
git config --global user.name "Tên Của Bạn"
```

### Bước 2: Commit mã nguồn
Chạy lệnh sau để lưu lại trạng thái hiện tại:
```bash
git add .
git commit -m "Initial commit: Coach Loan Vu website"
```

### Bước 3: Đưa lên GitHub (Publish)
Giờ đây repo địa phương đã được kết nối với: `https://github.com/innercoach/coachloanvu.git`

Bạn chạy các lệnh này để đẩy mã nguồn lên:
```bash
git add .
git commit -m "Initial commit: Coach Loan Vu website"
git push -u origin main --force
```
*(Lưu ý: Thêm `--force` ở cuối nếu bạn gặp lỗi "failed to push some refs", điều này thường xảy ra nếu trên GitHub bạn đã lỡ tạo sẵn file README hoặc License).*

### Bước 4: Công khai website (GitHub Pages)
Để mọi người có thể xem web qua link (ví dụ: `yourname.github.io/coach-loan-vu`):
1. Vào trang Repository trên GitHub.
2. Chọn **Settings** > **Pages** (cột bên trái).
3. Tại phần **Build and deployment** > **Branch**, chọn `main` và nhấn **Save**.
4. Chờ 1-2 phút, GitHub sẽ cung cấp link truy cập website của bạn!

---
Nếu gặp lỗi trong quá trình thực hiện, hãy cho tôi biết nhé!
