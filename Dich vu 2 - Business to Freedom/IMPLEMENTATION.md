# IMPLEMENTATION PLAN – Dịch vụ 2: Business to Freedom
> Trang: `dich-vu-2.html` | Phiên bản: 1.0 | Ngày tạo: 2026-04-16
>
> ⚠️ **Quy tắc vòng lặp kiểm tra:** Ở bước VERIFY cuối cùng, agent được phép tự sửa lỗi **tối đa 3 lần**. Sau lần thứ 3, dù còn lỗi vẫn phải dừng lại, tạo file `TASK_LIST.md` ghi rõ lỗi còn lại, và thoát.

---

## 1. Tổng quan

**Business to Freedom** là khoá coaching chuyên sâu dành cho chủ quán F&B muốn xây dựng hệ thống vận hành, thoát khỏi bán sức lao động và sống tự do. Đây là chương trình flagship của Coach Vũ Kiều Loan, giá trị cao hơn Passion to Profit.

**Theme màu sắc đề xuất:** Khác biệt với cả trang chủ (đỏ sáng/vàng) và Dịch vụ 1 (đen tối/đỏ tươi).
- Background: `#0f1f35` (xanh navy đậm) – cảm giác premium, freedom, tầm nhìn
- Heading: `#F5C842` (vàng ánh kim) – authority & wealth
- Accent/CTA: `#E87722` (cam cháy) – energy & action
- Text: `#FFFFFF` / `#CBD5E1`
- Card: `rgba(255,255,255,0.05)`

---

## 2. Chuẩn bị nội dung (cần bạn cung cấp)

Trước khi bắt đầu code, cần có:

```
Dich vu 2 - Business to Freedom/
├── CONTENT.txt        ← Nội dung theo format đã thống nhất
├── 1.png              ← Slide Hero / Cover
├── 2.png              ← Slide Credibility / Intro
├── ... (tối đa 20 slides)
└── IMPLEMENTATION.md  ← File này
```

**Format CONTENT.txt cần có:**
- Tên chương trình, giá, ngày/giờ
- Màu theme (hoặc để AI chọn)
- Danh sách section theo thứ tự
- Từng section: tiêu đề, text đầy đủ, mô tả ảnh, link button

---

## 3. Quy trình thực hiện chi tiết

### BƯỚC 0 – Đọc và phân tích nội dung

```
[ ] 0.1 Đọc toàn bộ file CONTENT.txt
[ ] 0.2 Xem từng ảnh slide (1.png → N.png)
[ ] 0.3 Ghi chú:
        - Số lượng section
        - Loại layout từng section (hero/grid/accordion/timeline...)
        - Màu sắc trên Canva slide (để đề xuất theme)
        - Ảnh nào dùng làm background, ảnh nào crop người/vật
[ ] 0.4 Xác nhận theme màu sắc với người dùng nếu cần
```

---

### BƯỚC 1 – Chuẩn bị tài nguyên ảnh

```
[ ] 1.1 Xác định kích thước từng slide (python -c "from PIL import Image; ...")
[ ] 1.2 Viết/cập nhật crop_images.py với toạ độ chính xác
[ ] 1.3 Chạy crop_images.py → xuất file vào assets/dv2/
[ ] 1.4 Kiểm tra xem output: xem từng ảnh cropped, đảm bảo không có góc tối
        - Nếu góc tối: điều chỉnh toạ độ (tăng x_start, y_start thêm 5-10px)
        - Chạy lại cho đến khi ảnh sạch
[ ] 1.5 Kiểm tra ảnh hero/instructor – cần rõ mặt, không bị crop cổ
```

**Lưu ý toạ độ crop:**
- Ảnh học viên portrait: crop ở TRUNG TÂM của bounding box, không crop tới sát cạnh
- Luôn kiểm tra ảnh crop bằng `view_file` trước khi dùng

---

### BƯỚC 2 – Tạo cấu trúc trang

```
[ ] 2.1 Tạo thư mục assets/dv2/ (nếu chưa có)
[ ] 2.2 Copy cấu trúc header/footer từ dich-vu-1.html làm skeleton
[ ] 2.3 Xoá toàn bộ nội dung main, giữ lại: <head>, header, footer, <script>
[ ] 2.4 Cập nhật:
        - <title>: "Business to Freedom – Coaching F&B | Coach Loan Vũ"
        - <meta name="description">: mô tả ngắn gọn
        - nav active link → dich-vu-2.html
        - footer links đúng
```

---

### BƯỚC 3 – Thiết lập dark theme CSS riêng

```
[ ] 3.1 Khai báo CSS variables màu B2F trong <style> của dich-vu-2.html:
        --b2f-navy:   #0f1f35
        --b2f-gold:   #F5C842
        --b2f-orange: #E87722
        --b2f-card:   rgba(255,255,255,0.05)
        --b2f-border: rgba(255,255,255,0.1)
[ ] 3.2 Override body background, h1/h2/h3 color, p color
[ ] 3.3 Override .site-header màu nền, nav links màu
[ ] 3.4 Override .badge màu
[ ] 3.5 Thêm .b2f-section { padding-block: var(--space-20); overflow: hidden; }
[ ] 3.6 Thêm .b2f-section.alt { background: #0a1828; } (tông xen kẽ sáng hơn 1 chút)
[ ] 3.7 Thêm sticky CTA bar (như dich-vu-1.html) với màu --b2f-orange
```

---

### BƯỚC 4 – Code từng section (theo CONTENT.txt)

Thực hiện theo thứ tự section trong CONTENT.txt. Với mỗi section:

```
[ ] 4.X.1 Xem lại ảnh slide tương ứng
[ ] 4.X.2 Chọn layout phù hợp:
          - Hero:       2-column (ảnh trái + text phải) hoặc full-width overlay
          - Stats:      grid 4 cols
          - Cards:      grid 2×3 hoặc 3×2
          - Timeline:   flex column với connector line
          - Accordion:  FAQ như dich-vu-1.html
          - Testimonials: grid 3 cols + img-wrap aspect-ratio
          - Pricing:    1-3 cols tùy số gói
          - CTA:        full-width bg-image + overlay
[ ] 4.X.3 Viết HTML section
[ ] 4.X.4 Viết CSS inline <style> block (không thêm vào shared style.css)
[ ] 4.X.5 Kiểm tra text đã match chính xác với CONTENT.txt
```

**Thứ tự section dự kiến (cập nhật sau khi đọc CONTENT.txt):**
1. Hero / Cover
2. Intro / Credibility
3. Đối tượng (Who is this for)
4. Chương trình học (Curriculum)
5. Lợi ích / Outcomes
6. Testimonials học viên B2F
7. Giảng viên
8. Giá & Lộ trình đăng ký
9. FAQ
10. CTA cuối trang

---

### BƯỚC 5 – Tích hợp JavaScript

```
[ ] 5.1 Link <script src="js/main.js"></script> ở cuối body (đã có trong skeleton)
[ ] 5.2 Thêm inline script cho FAQ accordion:
        document.querySelectorAll('.faq-q').forEach(btn => {
          btn.addEventListener('click', () => {
            const item = btn.closest('.faq-item');
            item.classList.toggle('open');
            btn.setAttribute('aria-expanded', item.classList.contains('open'));
          });
        });
[ ] 5.3 Nếu có pricing toggle (monthly/annual): thêm JS toggle
[ ] 5.4 Nếu có countdown timer: thêm JS countdown
```

---

### BƯỚC 6 – KIỂM TRA & SỬA LỖI (Tối đa 3 vòng)

> **⚠️ QUY TẮC QUAN TRỌNG:**
> - Mỗi lần kiểm tra = 1 lần chụp ảnh browser + đọc kết quả
> - Nếu còn lỗi → sửa → kiểm tra lại (đếm lần: Lần 1 / Lần 2 / Lần 3)
> - **Sau lần 3:** Dừng lại, tạo `TASK_LIST.md`, ghi rõ lỗi còn lại, thoát

#### Lần kiểm tra 1

```
[ ] 6.1.1 Mở dich-vu-2.html trong browser
[ ] 6.1.2 Screenshot toàn trang (scroll từ Hero → CTA)
[ ] 6.1.3 Kiểm tra checklist:
          □ Hero section: layout 2-col đúng chưa?
          □ Ảnh hiển thị đúng, không bị broken?
          □ Font màu vàng/cam đúng chưa?
          □ Sticky CTA bar hiển thị?
          □ Ít nhất 1 FAQ item mở được?
[ ] 6.1.4 Liệt kê lỗi phát hiện → sửa trong 1 lần edit
```

#### Lần kiểm tra 2 (nếu cần)

```
[ ] 6.2.1 Reload trang, screenshot lại
[ ] 6.2.2 Kiểm tra lỗi từ lần 1 đã sửa chưa
[ ] 6.2.3 Kiểm tra thêm:
          □ Mobile 375px: hero không vỡ layout?
          □ Testimonial ảnh hiển thị đúng tỉ lệ?
          □ Footer links đúng?
[ ] 6.2.4 Sửa lỗi còn lại
```

#### Lần kiểm tra 3 (cuối cùng)

```
[ ] 6.3.1 Reload, screenshot lần cuối
[ ] 6.3.2 Xác nhận các lỗi chính đã được xử lý
[ ] 6.3.3 Ghi nhận lỗi còn lại (nếu có) → chuyển vào TASK_LIST.md
[ ] 6.3.4 DỪNG vòng lặp kiểm tra
```

---

### BƯỚC 7 – Tạo TASK_LIST.md

```
[ ] 7.1 Tạo file Dich vu 2 - Business to Freedom/TASK_LIST.md
[ ] 7.2 Ghi vào file:
        - Danh sách lỗi còn lại chưa sửa được (nếu có)
        - Danh sách việc cần làm tiếp theo:
          * Thay ảnh thật
          * Điền link đăng ký thật
          * Cập nhật ngày/giá
          * Tối ưu ảnh
          * Kiểm tra mobile
          * Tracking pixel (nếu cần)
[ ] 7.3 Đánh dấu các mục đã hoàn thành [x]
```

---

## 4. Lưu ý kỹ thuật quan trọng

### Về crop ảnh
- Luôn đọc kích thước slide trước khi crop: `Image.open(src).size`
- Photo box trên slide thường có dark rounded-corner padding ~10-15px mỗi cạnh → offset thêm vào
- Sau khi crop, `view_file` để xem preview trực tiếp trước khi dùng

### Về CSS
- **KHÔNG** thêm style vào `css/style.css` chung → chỉ dùng `<style>` trong `<head>` của `dich-vu-2.html`
- Dùng `overflow: hidden` cho tất cả `.b2f-section` để tránh heading text bleed sang section khác
- `section-header` luôn đặt `margin-bottom: var(--space-12)` trước content grid

### Về testimonials
- Tất cả ảnh học viên dùng `.testi-img-wrap { aspect-ratio: 4/5; overflow: hidden; }`
  và `.testi-img { width:100%; height:100%; object-fit:cover; object-position:top center; }`
- KHÔNG set `height` cố định trên `.testi-img` → dùng aspect-ratio container thay thế

### Về section heading overflow
- Đây là bug đã gặp ở dich-vu-1.html: h2 text lớn bleeding vào card bên dưới
- Fix: thêm `overflow: hidden` vào `.b2f-section`
- Nếu vẫn còn bleed: thêm `position: relative; z-index: 1` vào `.section-header`

---

## 5. File cần tạo/chỉnh sửa

| File | Action | Ghi chú |
|------|--------|---------|
| `dich-vu-2.html` | TẠO MỚI | Toàn bộ landing page |
| `assets/dv2/*.png` | TẠO MỚI | Ảnh cropped từ slides |
| `crop_images_dv2.py` | TẠO MỚI | Script crop riêng cho dich vu 2 |
| `Dich vu 2 - Business to Freedom/TASK_LIST.md` | TẠO SAU | Sau bước 7 |
| `css/style.css` | KHÔNG CHỈNH | Giữ nguyên shared CSS |
| `js/main.js` | KHÔNG CHỈNH | Giữ nguyên shared JS |
