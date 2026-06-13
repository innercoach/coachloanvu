<?php
/**
 * Field definitions (zero plugin) — drives the native meta boxes & seeding.
 * Field/subfield names match exactly what the page templates read via
 * get_field()/have_rows()/clv_sub(), so seeded data renders 1:1 with the HTML.
 *
 * Structure:
 *   group_key => [
 *     'title'    => admin label,
 *     'match'    => ['front_page'=>true] | ['template'=>'page-xxx.php'],
 *     'sections' => [ ['title'=>..., 'fields'=>[ name => def ]] ],
 *   ]
 * Field def: ['label'=>, 'type'=>text|textarea|wysiwyg|url|image|select|repeater,
 *             'options'=>[], 'subfields'=>[ name => subdef ]]
 */

defined('ABSPATH') || exit;

function clv_field_groups(): array {
    $groups = [];

    /* ══════════════════════════ FRONT PAGE ══════════════════════════ */
    $groups['front'] = [
        'title' => 'Trang chủ',
        'match' => ['front_page' => true],
        'sections' => [
            ['title' => 'S1 · Hero', 'fields' => [
                'hero_eyebrow'              => ['label' => 'Eyebrow', 'type' => 'text'],
                'hero_title'                => ['label' => 'Tiêu đề chính (cho phép <br>)', 'type' => 'textarea'],
                'hero_tagline'              => ['label' => 'Tagline', 'type' => 'textarea'],
                'hero_cta_primary_label'    => ['label' => 'Nút chính · nhãn', 'type' => 'text'],
                'hero_cta_primary_url'      => ['label' => 'Nút chính · link', 'type' => 'text'],
                'hero_cta_secondary_label'  => ['label' => 'Nút phụ · nhãn', 'type' => 'text'],
                'hero_cta_secondary_url'    => ['label' => 'Nút phụ · link', 'type' => 'url'],
                'hero_image'                => ['label' => 'Ảnh hero', 'type' => 'image'],
            ]],
            ['title' => 'S2 · Hệ sinh thái dịch vụ', 'fields' => [
                'services_title'    => ['label' => 'Tiêu đề section', 'type' => 'text'],
                'services_subtitle' => ['label' => 'Mô tả section', 'type' => 'textarea'],
                'services' => ['label' => 'Danh sách dịch vụ', 'type' => 'repeater', 'subfields' => [
                    'service_number'      => ['label' => 'Số', 'type' => 'text'],
                    'service_name'        => ['label' => 'Tên', 'type' => 'text'],
                    'service_description' => ['label' => 'Mô tả', 'type' => 'textarea'],
                    'service_color_class' => ['label' => 'Màu', 'type' => 'select', 'options' => ['c-p2p' => 'Đỏ (P2P)', 'c-b2f' => 'Cam (B2F)', 'c-bm' => 'Vàng (BM)']],
                    'service_url'         => ['label' => 'Link', 'type' => 'text'],
                ]],
            ]],
            ['title' => 'S3 · Về Coach', 'fields' => [
                'about_image'        => ['label' => 'Ảnh', 'type' => 'image'],
                'about_badge_image'  => ['label' => 'Nhãn trên ảnh', 'type' => 'text'],
                'about_name'         => ['label' => 'Tên', 'type' => 'text'],
                'about_title'        => ['label' => 'Chức danh', 'type' => 'text'],
                'about_bio'          => ['label' => 'Tiểu sử', 'type' => 'wysiwyg'],
                'about_badges' => ['label' => 'Badges', 'type' => 'repeater', 'subfields' => [
                    'badge_text' => ['label' => 'Nội dung', 'type' => 'text'],
                ]],
                'about_stats' => ['label' => 'Chỉ số', 'type' => 'repeater', 'subfields' => [
                    'stat_number' => ['label' => 'Số', 'type' => 'text'],
                    'stat_label'  => ['label' => 'Nhãn', 'type' => 'text'],
                ]],
            ]],
            ['title' => 'S4 · Sách', 'fields' => [
                'book_image'         => ['label' => 'Ảnh bìa', 'type' => 'image'],
                'book_eyebrow'       => ['label' => 'Eyebrow', 'type' => 'text'],
                'book_title'         => ['label' => 'Tên sách', 'type' => 'text'],
                'book_description'   => ['label' => 'Mô tả', 'type' => 'wysiwyg'],
                'book_highlight'     => ['label' => 'Dòng nhấn mạnh', 'type' => 'text'],
                'book_cta_buy_label' => ['label' => 'Nút mua · nhãn', 'type' => 'text'],
                'book_cta_buy_url'   => ['label' => 'Nút mua · link', 'type' => 'url'],
            ]],
            ['title' => 'S5 · Testimonials', 'fields' => [
                'testimonials_title' => ['label' => 'Tiêu đề section', 'type' => 'text'],
                'testimonials' => ['label' => 'Danh sách', 'type' => 'repeater', 'subfields' => [
                    'testi_quote'  => ['label' => 'Trích dẫn', 'type' => 'textarea'],
                    'testi_name'   => ['label' => 'Tên', 'type' => 'text'],
                    'testi_role'   => ['label' => 'Vai trò', 'type' => 'text'],
                    'testi_avatar' => ['label' => 'Ảnh', 'type' => 'image'],
                ]],
            ]],
            ['title' => 'S6 · Kênh kết nối', 'fields' => [
                'channels' => ['label' => 'Danh sách kênh', 'type' => 'repeater', 'subfields' => [
                    'channel_icon'        => ['label' => 'Icon (emoji)', 'type' => 'text'],
                    'channel_name'        => ['label' => 'Tên', 'type' => 'text'],
                    'channel_url'         => ['label' => 'Link', 'type' => 'url'],
                    'channel_description' => ['label' => 'Mô tả', 'type' => 'text'],
                ]],
            ]],
        ],
    ];

    /* ══════════════════ PASSION TO PROFIT (DV1) ══════════════════ */
    $groups['dv1'] = [
        'title' => 'Passion to Profit',
        'match' => ['template' => 'page-passion-to-profit.php'],
        'sections' => [
            ['title' => 'DV1 · Hero', 'fields' => [
                'dv1_badge'            => ['label' => 'Badge', 'type' => 'text'],
                'dv1_hero_image'       => ['label' => 'Ảnh hero', 'type' => 'image'],
                'dv1_coach_label'      => ['label' => 'Nhãn ảnh coach', 'type' => 'text'],
                'dv1_title_line1'      => ['label' => 'Tiêu đề dòng 1 (cho phép <span>)', 'type' => 'text'],
                'dv1_title_line2'      => ['label' => 'Tiêu đề dòng 2', 'type' => 'text'],
                'dv1_tagline'          => ['label' => 'Tagline', 'type' => 'textarea'],
                'dv1_description'      => ['label' => 'Mô tả', 'type' => 'textarea'],
                'dv1_time'             => ['label' => 'Giờ học', 'type' => 'text'],
                'dv1_date'             => ['label' => 'Ngày học', 'type' => 'text'],
                'dv1_price'            => ['label' => 'Học phí', 'type' => 'text'],
                'dv1_slots'            => ['label' => 'Số chỗ', 'type' => 'text'],
                'dv1_countdown_target' => ['label' => 'Mốc đếm ngược (March 14, 2026 09:00:00)', 'type' => 'text'],
                'dv1_cta_label'        => ['label' => 'Nút CTA hero', 'type' => 'text'],
                'dv1_scholarship_note' => ['label' => 'Ghi chú học bổng', 'type' => 'textarea'],
            ]],
            ['title' => 'DV1 · Sticky CTA', 'fields' => [
                'dv1_sticky_title' => ['label' => 'Tiêu đề', 'type' => 'text'],
                'dv1_sticky_meta'  => ['label' => 'Dòng phụ', 'type' => 'text'],
            ]],
            ['title' => 'DV1 · Đối tượng', 'fields' => [
                'dv1_target_title' => ['label' => 'Tiêu đề section', 'type' => 'text'],
                'dv1_targets' => ['label' => 'Đối tượng', 'type' => 'repeater', 'subfields' => [
                    'target_number' => ['label' => 'Số', 'type' => 'text'],
                    'target_text'   => ['label' => 'Nội dung (cho phép <strong>)', 'type' => 'textarea'],
                ]],
            ]],
            ['title' => 'DV1 · Lợi ích', 'fields' => [
                'dv1_benefits_title' => ['label' => 'Tiêu đề section', 'type' => 'text'],
                'dv1_benefits' => ['label' => 'Lợi ích', 'type' => 'repeater', 'subfields' => [
                    'benefit_icon'        => ['label' => 'Icon', 'type' => 'text'],
                    'benefit_title'       => ['label' => 'Tiêu đề', 'type' => 'text'],
                    'benefit_description' => ['label' => 'Mô tả', 'type' => 'textarea'],
                ]],
            ]],
            ['title' => 'DV1 · Modules', 'fields' => [
                'dv1_modules_title' => ['label' => 'Tiêu đề section', 'type' => 'text'],
                'dv1_modules' => ['label' => 'Modules', 'type' => 'repeater', 'subfields' => [
                    'module_label'       => ['label' => 'Nhãn', 'type' => 'text'],
                    'module_title'       => ['label' => 'Tiêu đề', 'type' => 'text'],
                    'module_description' => ['label' => 'Mô tả', 'type' => 'textarea'],
                ]],
            ]],
            ['title' => 'DV1 · Giảng viên', 'fields' => [
                'dv1_cred_title'        => ['label' => 'Tiêu đề credibility', 'type' => 'text'],
                'dv1_cred_image'        => ['label' => 'Ảnh credibility', 'type' => 'image'],
                'dv1_instructor_image'  => ['label' => 'Ảnh giảng viên', 'type' => 'image'],
                'dv1_instructor_name'   => ['label' => 'Tên giảng viên', 'type' => 'text'],
                'dv1_instructor_title'  => ['label' => 'Chức danh', 'type' => 'text'],
                'dv1_credentials' => ['label' => 'Credentials', 'type' => 'repeater', 'subfields' => [
                    'cred_number' => ['label' => 'Số', 'type' => 'text'],
                    'cred_text'   => ['label' => 'Nội dung', 'type' => 'textarea'],
                ]],
            ]],
            ['title' => 'DV1 · FAQ', 'fields' => [
                'dv1_faqs' => ['label' => 'FAQ', 'type' => 'repeater', 'subfields' => [
                    'faq_question' => ['label' => 'Câu hỏi', 'type' => 'text'],
                    'faq_answer'   => ['label' => 'Trả lời', 'type' => 'textarea'],
                ]],
            ]],
            ['title' => 'DV1 · CTA cuối', 'fields' => [
                'dv1_cta_quote'       => ['label' => 'Quote', 'type' => 'textarea'],
                'dv1_cta_final_label' => ['label' => 'Nút CTA cuối', 'type' => 'text'],
            ]],
        ],
    ];

    /* ══════════════════ BUSINESS TO FREEDOM (DV2) ══════════════════ */
    $groups['dv2'] = [
        'title' => 'Business to Freedom',
        'match' => ['template' => 'page-business-to-freedom.php'],
        'sections' => [
            ['title' => 'DV2 · Hero', 'fields' => [
                'dv2_badge'            => ['label' => 'Badge', 'type' => 'text'],
                'dv2_hero_image'       => ['label' => 'Ảnh hero', 'type' => 'image'],
                'dv2_title'            => ['label' => 'Tiêu đề (2 dòng, Enter để xuống dòng)', 'type' => 'textarea'],
                'dv2_tagline'          => ['label' => 'Tagline', 'type' => 'text'],
                'dv2_description'      => ['label' => 'Mô tả', 'type' => 'textarea'],
                'dv2_schedule'         => ['label' => 'Lịch học', 'type' => 'text'],
                'dv2_cohort_label'     => ['label' => 'Nhãn khai giảng', 'type' => 'text'],
                'dv2_start_date'       => ['label' => 'Ngày khai giảng', 'type' => 'text'],
                'dv2_price'            => ['label' => 'Học phí', 'type' => 'text'],
                'dv2_slots_note'       => ['label' => 'Ghi chú số chỗ', 'type' => 'textarea'],
                'dv2_countdown_target' => ['label' => 'Mốc đếm ngược', 'type' => 'text'],
                'dv2_cta_label'        => ['label' => 'Nút CTA hero', 'type' => 'text'],
            ]],
            ['title' => 'DV2 · Sticky CTA', 'fields' => [
                'dv2_sticky_title' => ['label' => 'Tiêu đề', 'type' => 'text'],
                'dv2_sticky_meta'  => ['label' => 'Dòng phụ', 'type' => 'text'],
            ]],
            ['title' => 'DV2 · Pain points', 'fields' => [
                'dv2_pains' => ['label' => 'Nỗi đau', 'type' => 'repeater', 'subfields' => [
                    'pain_icon'        => ['label' => 'Số/Icon', 'type' => 'text'],
                    'pain_title'       => ['label' => 'Tiêu đề', 'type' => 'text'],
                    'pain_description' => ['label' => 'Mô tả', 'type' => 'textarea'],
                ]],
            ]],
            ['title' => 'DV2 · So sánh', 'fields' => [
                'dv2_compare_quote' => ['label' => 'Quote cuối bảng so sánh', 'type' => 'textarea'],
            ]],
            ['title' => 'DV2 · Người đồng hành', 'fields' => [
                'dv2_instructor_image' => ['label' => 'Ảnh giảng viên', 'type' => 'image'],
            ]],
            ['title' => 'DV2 · Đối tượng', 'fields' => [
                'dv2_targets' => ['label' => 'Đối tượng', 'type' => 'repeater', 'subfields' => [
                    'target_title'       => ['label' => 'Tiêu đề', 'type' => 'text'],
                    'target_description' => ['label' => 'Mô tả (cho phép <strong>)', 'type' => 'textarea'],
                ]],
            ]],
            ['title' => 'DV2 · 3 giá trị', 'fields' => [
                'dv2_benefits' => ['label' => 'Giá trị (M/M/F)', 'type' => 'repeater', 'subfields' => [
                    'benefit_letter'      => ['label' => 'Chữ cái', 'type' => 'text'],
                    'benefit_title'       => ['label' => 'Tiêu đề', 'type' => 'text'],
                    'benefit_description' => ['label' => 'Mô tả', 'type' => 'textarea'],
                ]],
            ]],
            ['title' => 'DV2 · Khác biệt & So sánh', 'fields' => [
                'dv2_differentiators' => ['label' => 'Điểm khác biệt', 'type' => 'repeater', 'subfields' => [
                    'diff_title'       => ['label' => 'Tiêu đề', 'type' => 'text'],
                    'diff_description' => ['label' => 'Mô tả', 'type' => 'textarea'],
                ]],
                'dv2_compare_rows' => ['label' => 'Bảng so sánh (vs P2P)', 'type' => 'repeater', 'subfields' => [
                    'row_label' => ['label' => 'Tiêu chí', 'type' => 'text'],
                    'row_p2p'   => ['label' => 'P2P (2 ngày)', 'type' => 'textarea'],
                    'row_b2f'   => ['label' => 'Business to Freedom', 'type' => 'textarea'],
                ]],
            ]],
            ['title' => 'DV2 · Kết quả sau 10 tuần', 'fields' => [
                'dv2_outcomes' => ['label' => 'Outcomes', 'type' => 'repeater', 'subfields' => [
                    'outcome_icon'        => ['label' => 'Số/Icon', 'type' => 'text'],
                    'outcome_title'       => ['label' => 'Tiêu đề', 'type' => 'text'],
                    'outcome_description' => ['label' => 'Mô tả', 'type' => 'textarea'],
                ]],
            ]],
            ['title' => 'DV2 · Lộ trình 10 tuần', 'fields' => [
                'dv2_modules' => ['label' => 'Tuần học', 'type' => 'repeater', 'subfields' => [
                    'module_week'        => ['label' => 'Tuần', 'type' => 'text'],
                    'module_title'       => ['label' => 'Chữ P / tiêu đề', 'type' => 'text'],
                    'module_description' => ['label' => 'Mô tả', 'type' => 'textarea'],
                ]],
            ]],
            ['title' => 'DV2 · FAQ', 'fields' => [
                'dv2_faqs' => ['label' => 'FAQ', 'type' => 'repeater', 'subfields' => [
                    'faq_question' => ['label' => 'Câu hỏi', 'type' => 'text'],
                    'faq_answer'   => ['label' => 'Trả lời', 'type' => 'textarea'],
                ]],
            ]],
            ['title' => 'DV2 · CTA cuối', 'fields' => [
                'dv2_cta_heading'     => ['label' => 'Tiêu đề', 'type' => 'text'],
                'dv2_cta_subtext'     => ['label' => 'Dòng phụ', 'type' => 'text'],
                'dv2_cta_final_label' => ['label' => 'Nút CTA cuối', 'type' => 'text'],
            ]],
        ],
    ];

    /* ══════════════════ BUSINESS MASTERY (DV3) ══════════════════ */
    $groups['dv3'] = [
        'title' => 'Business Mastery',
        'match' => ['template' => 'page-business-mastery.php'],
        'sections' => [
            ['title' => 'DV3 · Hero', 'fields' => [
                'dv3_badge'       => ['label' => 'Badge', 'type' => 'text'],
                'dv3_hero_image'  => ['label' => 'Ảnh hero', 'type' => 'image'],
                'dv3_title'       => ['label' => 'Tiêu đề', 'type' => 'text'],
                'dv3_tagline'     => ['label' => 'Tagline', 'type' => 'text'],
                'dv3_description' => ['label' => 'Mô tả', 'type' => 'textarea'],
                'dv3_gift_text'   => ['label' => 'Dòng ưu đãi', 'type' => 'text'],
                'dv3_cta_label'   => ['label' => 'Nút CTA hero', 'type' => 'text'],
            ]],
            ['title' => 'DV3 · Sticky CTA', 'fields' => [
                'dv3_sticky_title' => ['label' => 'Tiêu đề', 'type' => 'text'],
                'dv3_sticky_meta'  => ['label' => 'Dòng phụ', 'type' => 'text'],
            ]],
            ['title' => 'DV3 · Pain points', 'fields' => [
                'dv3_pains' => ['label' => 'Vấn đề', 'type' => 'repeater', 'subfields' => [
                    'pain_number'      => ['label' => 'Số', 'type' => 'text'],
                    'pain_title'       => ['label' => 'Tiêu đề', 'type' => 'text'],
                    'pain_description' => ['label' => 'Mô tả', 'type' => 'textarea'],
                    'pain_full_width'  => ['label' => 'Rộng toàn hàng', 'type' => 'select', 'options' => ['' => 'Không', '1' => 'Có']],
                ]],
            ]],
            ['title' => 'DV3 · Đối tượng', 'fields' => [
                'dv3_targets' => ['label' => 'Đối tượng', 'type' => 'repeater', 'subfields' => [
                    'target_icon'        => ['label' => 'Icon', 'type' => 'text'],
                    'target_title'       => ['label' => 'Tiêu đề', 'type' => 'text'],
                    'target_description' => ['label' => 'Mô tả', 'type' => 'textarea'],
                ]],
            ]],
            ['title' => 'DV3 · Cách hoạt động', 'fields' => [
                'dv3_not_like' => ['label' => 'Không giống khoá thông thường', 'type' => 'repeater', 'subfields' => [
                    'not_text' => ['label' => 'Nội dung', 'type' => 'text'],
                ]],
                'dv3_you_get' => ['label' => 'Thay vào đó bạn nhận được', 'type' => 'repeater', 'subfields' => [
                    'get_text' => ['label' => 'Nội dung', 'type' => 'text'],
                ]],
                'dv3_focus_badges' => ['label' => 'Tập trung vào (badges)', 'type' => 'repeater', 'subfields' => [
                    'badge_label' => ['label' => 'Nhãn', 'type' => 'text'],
                ]],
                'dv3_focus_note' => ['label' => 'Ghi chú mục tiêu', 'type' => 'textarea'],
            ]],
            ['title' => 'DV3 · 3 giá trị', 'fields' => [
                'dv3_values' => ['label' => 'Giá trị', 'type' => 'repeater', 'subfields' => [
                    'value_number'      => ['label' => 'Số', 'type' => 'text'],
                    'value_title'       => ['label' => 'Tiêu đề', 'type' => 'text'],
                    'value_description' => ['label' => 'Mô tả', 'type' => 'textarea'],
                ]],
            ]],
            ['title' => 'DV3 · Bạn nhận được gì', 'fields' => [
                'dv3_deliverables' => ['label' => 'Deliverables', 'type' => 'repeater', 'subfields' => [
                    'deliverable_title'       => ['label' => 'Tiêu đề (in đậm)', 'type' => 'text'],
                    'deliverable_description' => ['label' => 'Mô tả', 'type' => 'text'],
                ]],
                'dv3_deliverables_note' => ['label' => 'Ghi chú', 'type' => 'textarea'],
            ]],
            ['title' => 'DV3 · So sánh với B2F', 'fields' => [
                'dv3_compare_rows' => ['label' => 'Bảng so sánh', 'type' => 'repeater', 'subfields' => [
                    'row_label' => ['label' => 'Tiêu chí', 'type' => 'text'],
                    'row_btf'   => ['label' => 'Business to Freedom', 'type' => 'textarea'],
                    'row_bm'    => ['label' => 'Business Mastery', 'type' => 'textarea'],
                ]],
            ]],
            ['title' => 'DV3 · Gói dịch vụ', 'fields' => [
                'dv3_plans' => ['label' => 'Pricing plans', 'type' => 'repeater', 'subfields' => [
                    'plan_duration' => ['label' => 'Thời lượng', 'type' => 'text'],
                    'plan_subtitle' => ['label' => 'Mô tả ngắn', 'type' => 'text'],
                    'plan_price'    => ['label' => 'Giá', 'type' => 'text'],
                    'plan_featured' => ['label' => 'Nổi bật', 'type' => 'select', 'options' => ['' => 'Không', '1' => 'Có']],
                ]],
            ]],
        ],
    ];

    /* ══════════════════════════ LIÊN HỆ ══════════════════════════ */
    $groups['contact'] = [
        'title' => 'Liên hệ',
        'match' => ['template' => 'page-lien-he.php'],
        'sections' => [
            ['title' => 'Liên hệ · Nội dung', 'fields' => [
                'contact_title'      => ['label' => 'Tiêu đề', 'type' => 'text'],
                'contact_subtitle'   => ['label' => 'Phụ đề', 'type' => 'textarea'],
                'contact_intro'      => ['label' => 'Đoạn giới thiệu', 'type' => 'wysiwyg'],
                'contact_email'      => ['label' => 'Email', 'type' => 'text'],
                'contact_phone'      => ['label' => 'Điện thoại', 'type' => 'text'],
                'contact_hours'      => ['label' => 'Giờ làm việc', 'type' => 'text'],
                'contact_facebook_url' => ['label' => 'Facebook URL', 'type' => 'url'],
                'contact_form_title' => ['label' => 'Tiêu đề form', 'type' => 'text'],
            ]],
        ],
    ];

    return $groups;
}
