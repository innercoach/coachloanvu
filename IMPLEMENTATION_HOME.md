# Lộ Trình Triển Khai: Trang Chủ (Homepage Redesign)
> File: `IMPLEMENTATION_HOME.md` | Ngày lập: 2026-04-16

---

## 1. Mục tiêu & Định hướng thiết kế
- **Mục tiêu**: Nâng cấp trang chủ (`index.html`) thành một điểm chạm tổng hợp, nơi khách hàng / học viên có thể hiểu rõ nhất về triết lý, dịch vụ của Coach Loan Vũ, cũng như các kênh kết nối khác.
- **Phong cách thiết kế (Theme)**: 
  - Mix & match hài hòa giữa các tone màu từ 3 dịch vụ: Đỏ rượu (DV1), Xanh Navy/Cam (DV2) và Đen/Vàng đồng (DV3). HOẶC sử dụng một theme trung tính chuẩn mực sang trọng làm nền tảng chung kết nối cả 3.
  - Mang lại cảm giác cao cấp, chuyên nghiệp và có chiều sâu chiến lược.

---

## 2. Cấu trúc chi tiết (Layout)

### SECTION 1: Hero Banner Cốt Lõi
- **Bố cục**: Chia làm 2 cột hoặc Hero trải dài.
- **Hình ảnh**: Ảnh chuyên nghiệp của Coach Loan Vũ (Hero Image).
- **Text Title / Slogan**: Câu triết lý thể hiện bản sắc của Coach (ví dụ: *Từ Đam mê đến Lợi nhuận, Từ Lợi nhuận đến Tự do và Làm chủ sự nghiệp F&B*).
- **Giới thiệu ngắn gọn**: Tổng hợp tinh hoa từ 3 chương trình dịch vụ – "Đồng hành cùng chủ quán F&B trên mọi chặng đường phát triển".
- **CTA**: Nút điều hướng chung để khám phá (Kéo xuống phần Dịch vụ).

### SECTION 2: Hệ Sinh Thái Dịch Vụ
- **Bố cục**: Grid 3 Cột (cards/panels) đặt cạnh nhau để thể hiện rõ hành trình tiến cấp.
- **Nội dung**:
  1. **Passion to Profit**: Khoá học 2 ngày, xây nền móng kinh doanh từ 5 chữ P. (Màu Vàng nghệ/Đỏ).
  2. **Business to Freedom**: Chương trình nhóm 10 tuần, thoát khỏi vận hành 24/7. (Màu Navy/Cam).
  3. **Business Mastery**: Coaching 1:1 cao cấp, đồng hành chiến lược 6-12 tháng. (Màu Đen/Vàng đồng).
- **CTA**: Mỗi card có một nút "Tìm hiểu chi tiết" trỏ về link landing page `dich-vu-1/2/3.html`.

### SECTION 3: Sách & Câu Chuyện Chuyển Hoá
- **Bố cục**: Highlight banner đặc biệt, khác màu nền so với Section trên.
- **Hình ảnh**: Mockup bìa sách (nếu đã có cover) hoặc hình ảnh gợi nhớ đến chặng đường F&B.
- **Nội dung**: Vài dòng tóm tắt triết lý trong cuốn sách và câu chuyện chuyển hoá cá nhân của tác giả.
- **CTA**: Có hai nút bấm:
  - Nút chính (Primary): "Mua Sách Ngay" (Trỏ về link mua sách / shopee / tiki).
  - Nút phụ (Secondary / Outline): "Đọc thử câu chuyện" (Trỏ về link chia sẻ nội dung).

### SECTION 4: Testimonials (Cảm nhận)
- **Bố cục**: Carousel (slider) hoặc Grid lưới 3 cột hiển thị những trích dẫn ấn tượng nhất.
- **Nội dung**: Trích xuất những lời cảm ơn, chia sẻ thành quả từ học viên tiêu biểu của cả B2F và Passion to Profit.
- **Thiết kế**: Nên sử dụng hình chữ nhật bọc trích dẫn, góc bo tròn, màu thẻ (card bg) nổi bật trên nền xám tối hoặc màu nhạt tuỳ theme.

### SECTION 5: Kênh Kết Nối (Connect & Ecosystem)
- **Bố cục**: 4 Blocks / Cards lớn tập trung vào đa kênh chuyên gia.
- **Nội dung kênh**:
  1. **Facebook**: Cộng đồng hỗ trợ, theo dõi cập nhật.
  2. **YouTube**: Kênh video đào tạo, tư duy F&B.
  3. **Newsletter (Substack)**: Email chuyên sâu chia sẻ insight, nhận định thị trường.
  4. **S&L's Diner**: Cửa hàng thực chiến, nơi trải nghiệm trực tiếp mô hình mà Loan đã thành công.

---

## 3. Checklist Công Việc
- [ ] **A. Thu thập tài nguyên**: Các link mạng xã hội (Facebook, Youtube, Substack), Link sách, Ảnh sách.
- [ ] **B. Thiết kế Mockup/Wireframe logic** trong `index.html`.
- [ ] **C. Code - Section 1 & 2**.
- [ ] **D. Code - Section 3, 4, 5**.
- [ ] **E. Review & Responsive test** bằng Browser Subagent (Max 3 lần tự sửa).
- [ ] **F. Tổng kết TASK_LIST** cho trang chủ.
