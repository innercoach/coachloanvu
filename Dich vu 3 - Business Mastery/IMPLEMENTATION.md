# IMPLEMENTATION PLAN – Dịch vụ 3: Business Mastery
> Trang: `dich-vu-3.html` | Phiên bản: 1.0 | Ngày tạo: 2026-04-16
>
> ⚠️ **Quy tắc vòng lặp kiểm tra:** Ở bước VERIFY cuối cùng, agent được phép tự sửa lỗi **tối đa 3 lần**. Sau lần thứ 3, dù còn lỗi vẫn phải dừng lại, tạo file `TASK_LIST.md` ghi rõ lỗi còn lại, và thoát.

---

## 1. Tổng quan

**Business Mastery** là chương trình coaching cao cấp nhất (tier 3) dành cho chủ quán F&B đã có nền tảng, muốn tối ưu hệ thống, scale và đạt mastery. Đây là chương trình flagship số 3 — premium hơn cả B2F.

**Định vị:** Cao cấp · Cá nhân hoá · Dài hạn · Kết quả đo lường được

**Theme màu sắc đề xuất:** Khác biệt với cả trang chủ, Dịch vụ 1 (đen/đỏ) và Dịch vụ 2 (navy/vàng/cam).
- Background: `#0e0e0e` (đen thuần, tối giản, luxury)
- Heading: `#C9A84C` (vàng đồng antique) – mastery & prestige
- Accent/CTA: `#2E7D32` hoặc `#1565C0` (xanh lá đậm hoặc xanh sapphire) – growth & trust
- Divider/line: `rgba(201,168,76,0.4)` (vàng đồng mờ)
- Card: `rgba(255,255,255,0.04)`
- Text: `#FFFFFF` / `#B0BEC5`

> ✏️ **Ghi chú:** Xác nhận lại màu sắc sau khi đọc CONTENT.txt và xem slide của chương trình.

---

## 2. Chuẩn bị nội dung (cần bạn cung cấp)

Trước khi bắt đầu code, cần có đủ:

```
Dich vu 3 - Business Mastery/
├── CONTENT.txt        ← Nội dung theo format đã thống nhất
├── 1.png              ← Slide Hero / Cover
├── 2.png              ← Slide tiếp theo
├── ... (tối đa 20 slides)
└── IMPLEMENTATION.md  ← File này
```

**Format CONTENT.txt cần có:**
- Tên chương trình, giá, hình thức (1-1 hay nhóm?), thời lượng
- Màu theme (hoặc để AI chọn)
- Danh sách section theo thứ tự
- Từng section: tiêu đề, nội dung đầy đủ, mô tả ảnh, text nút CTA

---

## 3. Quy trình thực hiện chi tiết

### BƯỚC 0 – Đọc và phân tích nội dung

```
[ ] 0.1 Đọc toàn bộ file CONTENT.txt, ghi lại:
        - Số lượng section
        - Giá và hình thức (coaching 1-1 / nhóm / tự học)
        - Thông tin nổi bật (testimonial số lượng, kết quả cụ thể)
[ ] 0.2 Xem lần lượt từng file ảnh (1.png → N.png) bằng view_file
        - Ghi lại: loại ảnh (portrait, screenshot, infographic, photo)
        - Ghi lại: toạ độ ảnh người (nếu cần crop)
[ ] 0.3 Xác định layout phù hợp cho từng section
[ ] 0.4 Đề xuất hoặc xác nhận theme màu với người dùng
[ ] 0.5 Ghi lại kích thước slide: python -c "from PIL import Image; img=Image.open('1.png'); print(img.size)"
```

---

### BƯỚC 1 – Chuẩn bị tài nguyên ảnh

```
[ ] 1.1 Xác định kích thước slide (1920x1080 hay khác?)
[ ] 1.2 Viết file crop_images_dv3.py riêng:
        - SRC = "Dich vu 3 - Business Mastery"
        - DST = "assets/dv3"
        - os.makedirs(DST, exist_ok=True)
[ ] 1.3 Với mỗi ảnh cần crop:
        - view_file để xem slide
        - Đo toạ độ bounding box bằng mắt (x1,y1,x2,y2)
        - Photo box thường có dark padding ~10-15px → offset vào thêm
        - Ghi vào crop_images_dv3.py
[ ] 1.4 Chạy script: python crop_images_dv3.py
[ ] 1.5 Kiểm tra từng ảnh output bằng view_file:
        - Ảnh người: phải thấy rõ mặt, không bị dark corner
        - Nếu có dark corner: tăng x_start, y_start thêm 8-12px → chạy lại
        - Tối đa 3 lần điều chỉnh toạ độ, sau đó dừng
[ ] 1.6 Nếu ảnh không crop được sạch: giữ crop hiện tại,
        ghi vào TASK_LIST.md để thay ảnh thủ công sau
```

---

### BƯỚC 2 – Tạo skeleton trang

```
[ ] 2.1 Tạo thư mục assets/dv3/
[ ] 2.2 Mở dich-vu-2.html làm tham chiếu cấu trúc (không copy toàn bộ)
[ ] 2.3 Xoá toàn bộ nội dung <main> của dich-vu-3.html (placeholder cũ)
[ ] 2.4 Giữ lại và cập nhật:
        - <head>: title, meta description, link style.css, inline <style>
        - <header>: nav với active link = dich-vu-3.html
        - <footer>: giữ nguyên
        - <script src="js/main.js">
[ ] 2.5 Cập nhật:
        - <title>: "Business Mastery – Coaching F&B | Coach Loan Vũ"
        - <meta name="description">: mô tả ngắn về chương trình
        - Nav logo href = "index.html"
        - Nav active class đúng trang dich-vu-3.html
```

---

### BƯỚC 3 – Thiết lập dark premium CSS

```
[ ] 3.1 Khai báo :root variables trong <style> của dich-vu-3.html:
        --bm-black:  #0e0e0e
        --bm-dark2:  #1a1a1a
        --bm-gold:   #C9A84C
        --bm-accent: #2E7D32   (xanh growth, hoặc màu khác sau khi xem slide)
        --bm-card:   rgba(255,255,255,0.04)
        --bm-border: rgba(201,168,76,0.15)
[ ] 3.2 Override body: background, color
[ ] 3.3 Override h1,h2,h3: color = var(--bm-gold)
[ ] 3.4 Override p: color = rgba(255,255,255,0.80)
[ ] 3.5 Override .site-header: background = #050505, border = rgba(255,255,255,0.06)
[ ] 3.6 Override .nav-logo, nav links, active state
[ ] 3.7 Override .badge: màu vàng đồng
[ ] 3.8 .bm-section { padding-block: var(--space-20); overflow: hidden; }
[ ] 3.9 .bm-section.alt { background: var(--bm-dark2); }
[ ] 3.10 Sticky CTA bar màu --bm-accent (hoặc --bm-gold nếu phù hợp)
```

---

### BƯỚC 4 – Code từng section

Thực hiện tuần tự từng section trong CONTENT.txt. Checklist mỗi section:

```
[ ] 4.X.1 Xem lại ảnh slide tương ứng (view_file)
[ ] 4.X.2 Chọn layout phù hợp với nội dung:
          - HERO:         2-col ảnh+text hoặc full overlay
          - PROBLEM/PAIN: 2-col text+icon list
          - CURRICULUM:   accordion hoặc timeline vertical
          - RESULTS:      grid số liệu nổi bật + testimonial mini
          - CASE STUDIES: card 2-col với ảnh + text
          - TESTIMONIALS: grid 3-col + img-wrap aspect-ratio
          - PRICING:      1-3 cols, featured col nổi
          - GUARANTEE:    banner ngang có icon shield
          - FAQ:          accordion
          - CTA:          full-width overlay + nút lớn
[ ] 4.X.3 Viết HTML section với aria-label phù hợp
[ ] 4.X.4 Viết CSS trong <style> (không dùng shared style.css)
[ ] 4.X.5 Đảm bảo responsive: thêm @media(max-width:768px) cho mỗi grid
[ ] 4.X.6 Đảm bảo text khớp chính xác với CONTENT.txt (không tự bịa thêm)
[ ] 4.X.7 Ảnh: dùng <img loading="lazy" alt="mô tả"> với đường dẫn assets/dv3/
```

**Thứ tự section dự kiến (cập nhật sau khi đọc CONTENT.txt):**
1. Hero / Cover
2. Vấn đề / Nỗi đau (Pain points)
3. Chương trình là gì? (What)
4. Chương trình dành cho ai? (Who)
5. Nội dung / Lộ trình (Curriculum)
6. Kết quả thực tế / Case Studies
7. Testimonials học viên Business Mastery
8. Giảng viên
9. Giá & Gói đăng ký
10. Cam kết / Guarantee (nếu có)
11. FAQ
12. CTA cuối trang

---

### BƯỚC 5 – Tích hợp JavaScript

```
[ ] 5.1 FAQ Accordion:
        document.querySelectorAll('.faq-q').forEach(btn => {
          btn.addEventListener('click', () => {
            const item = btn.closest('.faq-item');
            item.classList.toggle('open');
            btn.setAttribute('aria-expanded', item.classList.contains('open'));
          });
        });

[ ] 5.2 Nếu có tab/panel cho curriculum hoặc pricing tiers:
        document.querySelectorAll('[data-tab]').forEach(tab => {
          tab.addEventListener('click', () => {
            const target = tab.dataset.tab;
            document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
            document.getElementById(target).classList.add('active');
            document.querySelectorAll('[data-tab]').forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
          });
        });

[ ] 5.3 Nếu có countdown timer, thêm:
        function updateCountdown(targetDateStr) { ... }
        setInterval(updateCountdown, 1000);

[ ] 5.4 Scroll reveal (đã có trong main.js, chỉ cần thêm data-reveal vào elements)
```

---

### BƯỚC 6 – KIỂM TRA & SỬA LỖI (Tối đa 3 vòng)

> **⚠️ QUY TẮC BẮT BUỘC:**
> - Mỗi vòng = 1 lần browser_subagent kiểm tra
> - Sửa xong → kiểm tra tiếp (đếm: 1/2/3)
> - **Sau vòng 3:** DỪNG HOÀN TOÀN dù còn lỗi
> - Chuyển tất cả lỗi còn lại vào `TASK_LIST.md` và thoát

#### Vòng 1 – Kiểm tra cơ bản

```
[ ] 6.1.1 Mở file:///...dich-vu-3.html trong browser
[ ] 6.1.2 Scroll từ đầu đến cuối, chụp ảnh tại mỗi section chính
[ ] 6.1.3 Checklist cơ bản:
          □ Trang load được, không có lỗi trắng màn hình?
          □ Dark theme màu đen + vàng đồng đúng theme?
          □ Header nav hiển thị, active đúng trang?
          □ Sticky CTA bar hiển thị ở phía dưới?
          □ Ít nhất 1 ảnh hiển thị đúng?
          □ FAQ accordion mở được khi click?
          □ Footer đúng không?
[ ] 6.1.4 Liệt kê tất cả lỗi → sửa trong 1 lần duy nhất
```

#### Vòng 2 – Kiểm tra chi tiết

```
[ ] 6.2.1 Reload trang (hard refresh)
[ ] 6.2.2 Xác nhận lỗi vòng 1 đã fix chưa
[ ] 6.2.3 Kiểm tra thêm:
          □ Ảnh học viên portrait hiển thị đúng (không bị squished)?
          □ Section headings không bị bleed vào card phía dưới?
          □ Grid responsive trên viewport 768px?
          □ Tất cả nút CTA trỏ đúng link (không link chết)?
[ ] 6.2.4 Sửa lỗi còn lại
```

#### Vòng 3 – Kiểm tra final

```
[ ] 6.3.1 Reload lần cuối
[ ] 6.3.2 Kiểm tra mobile 375px (dùng browser DevTools)
[ ] 6.3.3 Xác nhận các vấn đề nghiêm trọng đã được xử lý
[ ] 6.3.4 Ghi nhận lỗi còn lại (nếu có) để đưa vào TASK_LIST.md
[ ] 6.3.5 → DỪNG VÒNG LẶP
```

---

### BƯỚC 7 – Tạo TASK_LIST.md trong thư mục Dich vu 3

```
[ ] 7.1 Tạo file: Dich vu 3 - Business Mastery/TASK_LIST.md
[ ] 7.2 Nội dung file gồm 3 nhóm:
```

**Mẫu TASK_LIST.md sẽ tạo:**

```markdown
# TASK LIST – Dịch vụ 3: Business Mastery

## 🔴 Lỗi chưa sửa được (từ vòng kiểm tra)
- [ ] [Ghi rõ từng lỗi còn tồn tại]

## 🔴 Cần làm trước khi ra mắt
- [ ] Thay ảnh học viên bằng ảnh thật (nếu crop từ slide)
- [ ] Điền link đăng ký thật vào tất cả nút CTA
- [ ] Cập nhật thông tin liên hệ footer (email, phone, Facebook)
- [ ] Xác nhận ngày/giá chương trình đúng

## 🟡 Nên làm
- [ ] Kiểm tra mobile 375px toàn trang
- [ ] Tối ưu ảnh (compress < 150KB/ảnh)
- [ ] Kiểm tra tốc độ load trang (< 3s)

## 🟢 Nice-to-have
- [ ] Google Analytics / Facebook Pixel
- [ ] Countdown timer đến ngày khai giảng
- [ ] Form đăng ký inline

## ✅ Đã hoàn thành
- [x] Cấu trúc HTML đầy đủ N sections
- [x] Dark premium theme (#0e0e0e + vàng đồng)
- [x] FAQ accordion
- [x] Sticky CTA bar
- [x] Responsive grid cơ bản
```

---

## 4. Lưu ý kỹ thuật (rút ra từ Dịch vụ 1)

### ✅ Testimonial images – Tránh lỗi cũ
```css
/* ĐÚNG: luôn wrap ảnh trong div có aspect-ratio */
.testi-img-wrap {
  width: 100%;
  aspect-ratio: 4/5;
  overflow: hidden;
}
.testi-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: top center;
  display: block;
}
/* SAI: không set height cố định trên img */
```

### ✅ Section heading overflow – Tránh lỗi cũ
```css
/* Thêm vào mọi .bm-section để tránh heading text bleed */
.bm-section { overflow: hidden; }

/* Nếu vẫn bị bleed, thêm z-index cho section-header */
.section-header { position: relative; z-index: 1; }
```

### ✅ Crop ảnh – Tránh dark corner
- Luôn xem slide trước khi đo toạ độ
- Photo box thường có ~10-15px padding từ nền tối
- Offset x_start += 10, y_start += 12 so với cạnh bounding box
- Sau khi crop: `view_file` để xem preview inline, sửa nếu thấy góc tối

### ✅ CSS scope – Không pollute shared styles
- **KHÔNG** chỉnh `css/style.css`
- **KHÔNG** chỉnh `js/main.js`
- Tất cả style cho dich-vu-3.html → trong `<style>` block của file đó

### ✅ Responsive grid – Mẫu chuẩn
```css
.bm-grid-3 { display: grid; grid-template-columns: repeat(3,1fr); gap: var(--space-6); }
@media(max-width:1024px) { .bm-grid-3 { grid-template-columns: repeat(2,1fr); } }
@media(max-width:600px)  { .bm-grid-3 { grid-template-columns: 1fr; } }
```

---

## 5. Checklist file cần tạo/chỉnh sửa

| File | Action | Ghi chú |
|------|--------|---------|
| `dich-vu-3.html` | CHỈNH SỬA (xoá placeholder, viết lại main) | Trang landing page chính |
| `assets/dv3/*.png` | TẠO MỚI | Ảnh cropped từ slides |
| `crop_images_dv3.py` | TẠO MỚI | Script crop riêng |
| `Dich vu 3 - Business Mastery/TASK_LIST.md` | TẠO SAU BƯỚC 7 | Ghi lỗi còn lại |
| `css/style.css` | KHÔNG CHỈNH | Giữ nguyên |
| `js/main.js` | KHÔNG CHỈNH | Giữ nguyên |
