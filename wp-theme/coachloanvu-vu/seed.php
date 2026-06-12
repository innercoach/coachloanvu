<?php
/**
 * One-off data seeder (run via: wp eval-file seed.php).
 * Imports bundled images into the Media Library and writes all custom-field
 * data (text + images) so the WP site matches the HTML mockups 1:1.
 * Idempotent: image import is de-duplicated; meta writes are upserts.
 */

if (!defined('WP_CLI')) { /* allow only via cli */ }

require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/media.php';
require_once ABSPATH . 'wp-admin/includes/image.php';

/* ── Image importer (dedup via option map) ── */
function clv_seed_img($rel) {
    $map  = get_option('clv_seed_media', []);
    $base = basename($rel);
    // Dedup by FULL relative path (dv1/dv2/dv3 share basenames like hero-coach.png)
    if (isset($map[$rel]) && get_post($map[$rel])) {
        return $map[$rel];
    }
    $src = get_template_directory() . '/assets/images/' . $rel;
    if (!file_exists($src)) { WP_CLI::warning("missing image: $rel"); return 0; }
    $tmp = wp_tempnam($base);
    copy($src, $tmp);
    $file = ['name' => $base, 'tmp_name' => $tmp];
    $id = media_handle_sideload($file, 0);
    if (is_wp_error($id)) { @unlink($tmp); WP_CLI::warning("import failed: $rel — " . $id->get_error_message()); return 0; }
    $map[$rel] = $id;
    update_option('clv_seed_media', $map);
    return $id;
}

function clv_pid($slug) {
    $p = get_page_by_path($slug);
    return $p ? $p->ID : 0;
}
function clv_set($pid, $fields) {
    foreach ($fields as $k => $v) { update_post_meta($pid, $k, $v); }
}

/* ════════════════════ GLOBAL SETTINGS ════════════════════ */
update_option('clv_global', [
    'global_logo_text'        => 'Coach <span>Loan Vu</span>',
    'global_nav_cta_label'    => 'Thảo luận chiến lược',
    'global_nav_cta_url'      => home_url('/lien-he/'),
    'global_footer_tagline'   => "Vũ Kiều Loan là F&B Startup Coach chuyên nghiệp (ICF PCC) với 16 năm kinh nghiệm tại Mỹ và Việt Nam. CEO S&L's Diner, đồng hành cùng chủ quán xây dựng kinh doanh bền vững.",
    'global_footer_copyright' => '© 2026 Coach Loan Vu. All rights reserved.',
    'global_social_facebook'  => 'https://www.facebook.com/loanvuk',
    'global_social_instagram' => 'https://www.instagram.com/loanvuk',
    'global_social_email'     => 'loanvuk@gmail.com',
]);

/* ════════════════════ HOME ════════════════════ */
$home = clv_pid('trang-chu');
if ($home) {
    clv_set($home, [
        'hero_eyebrow'             => 'F&B Startup Coach, ICF PCC',
        'hero_title'               => 'Từ Đam mê đến Lợi nhuận,<br>Và Làm Chủ Nền Móng Tự Do.',
        'hero_tagline'             => 'Hơn 15 năm kinh nghiệm. Đồng hành cùng chủ quán F&B trên mọi chặng đường phát triển: từ ý tưởng ban đầu đến tối ưu vận hành và mở rộng hệ thống.',
        'hero_cta_primary_label'   => 'Khám phá dịch vụ',
        'hero_cta_primary_url'     => '#services',
        'hero_cta_secondary_label' => 'Tư vấn 1:1 miễn phí',
        'hero_cta_secondary_url'   => home_url('/lien-he/'),
        'hero_image'               => clv_seed_img('dv3/hero-coach.png'),

        'services_title'    => 'Hệ Sinh Thái Dịch Vụ',
        'services_subtitle' => 'Lộ trình hoàn chỉnh được thiết kế để giải quyết chính xác bài toán của bạn ở từng giai đoạn phát triển mảng F&B.',
        'services' => [
            ['service_number' => '01', 'service_name' => 'Passion to Profit',   'service_description' => 'Dành cho người chuẩn bị khởi nghiệp hoặc mới mở quán muốn học cách hệ thống hoá và hiểu vai trò cốt lõi. Khoá học tập trung cấp tốc 2 ngày.', 'service_color_class' => 'c-p2p', 'service_url' => home_url('/passion-to-profit/')],
            ['service_number' => '02', 'service_name' => 'Business to Freedom', 'service_description' => 'Dành cho chủ quán muốn thoát khỏi vận hành 24/7. Chương trình nhóm thực chiến kéo dài 10 tuần với quy trình SOP, kế toán và nhân sự rõ ràng.', 'service_color_class' => 'c-b2f', 'service_url' => home_url('/business-to-freedom/')],
            ['service_number' => '03', 'service_name' => 'Business Mastery',     'service_description' => 'Coaching 1:1 cao cấp, giải quyết trực tiếp bài toán chiến lược mở rộng. Đồng hành từ 6-12 tháng, riêng biệt hoá theo mô hình của bạn.', 'service_color_class' => 'c-bm', 'service_url' => home_url('/business-mastery/')],
        ],

        'about_image'       => clv_seed_img('dv1/hero-coach.png'),
        'about_badge_image' => 'ICF PCC Coach',
        'about_name'        => 'Vũ Kiều Loan',
        'about_title'       => 'Người đồng hành chiến lược cho chủ quán F&B Việt',
        'about_bio'         => "Hơn 16 năm trong ngành F&B & Hospitality tại Mỹ và Việt Nam. 10 năm khởi nghiệp, đồng sáng lập & điều hành <strong>S&L's Diner</strong> – chuỗi nhà hàng Mỹ tại Hà Nội. ICF PCC Coach quốc tế, Top 80 người Việt đạt chứng nhận cao nhất của ICF (2025). Tác giả cuốn sách truyền cảm hứng <em>Ánh Sáng Của Ước Mơ</em>.",
        'about_badges' => [
            ['badge_text' => 'F&B Coach'], ['badge_text' => 'ICF PCC'],
            ['badge_text' => 'Tác giả sách'], ['badge_text' => 'Chủ nhà hàng'],
        ],
        'about_stats' => [
            ['stat_number' => '16+',   'stat_label' => 'Năm kinh nghiệm F&B'],
            ['stat_number' => '50+',   'stat_label' => 'Chủ quán đồng hành'],
            ['stat_number' => '1.000', 'stat_label' => 'Cuốn sách đã bán'],
            ['stat_number' => '3',     'stat_label' => 'Chương trình Coaching'],
        ],

        'book_image'         => clv_seed_img('home/book-mockup.png'),
        'book_eyebrow'       => 'Sách của Coach Loan Vũ',
        'book_title'         => 'Ánh Sáng Của Ước Mơ',
        'book_description'   => 'Cuốn sách truyền cảm hứng về hành trình chuyển hoá từ người đi làm thuê đến người làm chủ nhà hàng – ghi lại những vấp ngã, bài học và sức mạnh nội tâm giúp người trẻ bước vào con đường khởi nghiệp tự tin hơn.',
        'book_highlight'     => 'Đã truyền cảm hứng cho hơn <strong>1.000 người trẻ</strong> trong hành trình khởi nghiệp F&B.',
        'book_cta_buy_label' => 'Mua Sách Ngay',
        'book_cta_buy_url'   => '#',

        'testimonials_title' => 'Trải nghiệm chuyển hoá',
        'testimonials' => [
            ['testi_quote' => 'Mọi thứ không còn mơ hồ. Mình biết cái gì đang thiếu và cần thay đổi. Thay đổi đầu tiên là áp dụng các quy trình chuẩn cho quán.', 'testi_name' => 'Cao Lan', 'testi_role' => 'Chủ nhà hàng Việt ở Paris', 'testi_avatar' => clv_seed_img('dv2/t1-caolan.png')],
            ['testi_quote' => 'Bước tiến của em là vận hành được quán và để dành được lợi nhuận. Mọi thứ đang vận hành đúng như mong muốn và em rất tự hào.', 'testi_name' => 'Thanh Nga', 'testi_role' => 'Chủ quán trà tại Bảo Lộc', 'testi_avatar' => clv_seed_img('dv2/t1-thanhnga.png')],
            ['testi_quote' => 'Khoá học là bản đồ để dù mình đang làm gì cũng có thể đối chiếu. Dù kinh doanh bao lâu, mình vẫn cần soi lại để tìm hướng đi đúng.', 'testi_name' => 'Phạm Hiếu', 'testi_role' => 'Chủ cafe Việt ở Virginia, Mỹ', 'testi_avatar' => clv_seed_img('dv2/t1-phamhieu.png')],
        ],

        'channels' => [
            ['channel_icon' => '📘',  'channel_name' => 'Facebook',    'channel_url' => 'https://www.facebook.com/loanvuk', 'channel_description' => 'Cộng đồng hỗ trợ & chia sẻ'],
            ['channel_icon' => '📺',  'channel_name' => 'YouTube',     'channel_url' => 'https://www.youtube.com/@loanvuk',   'channel_description' => 'Nhận định & hướng dẫn thực chiến'],
            ['channel_icon' => '📧',  'channel_name' => 'Newsletter',  'channel_url' => '#',                                  'channel_description' => 'Insight kinh doanh qua Substack'],
            ['channel_icon' => '🍽️', 'channel_name' => "S&L's Diner", 'channel_url' => '#',                                  'channel_description' => 'Cửa hàng thực chiến của Loan team'],
        ],
    ]);
    WP_CLI::log("Seeded HOME (#$home)");
}

/* ════════════════════ DV1 — PASSION TO PROFIT ════════════════════ */
$dv1 = clv_pid('passion-to-profit');
if ($dv1) {
    clv_set($dv1, [
        'dv1_badge'            => 'Workshop F&B Online · 2 ngày',
        'dv1_hero_image'       => clv_seed_img('dv1/hero-coach.png'),
        'dv1_coach_label'      => 'Vũ Kiều Loan – F&B Coach',
        'dv1_title_line1'      => 'PASSION <span>TO</span>',
        'dv1_title_line2'      => 'PROFIT',
        'dv1_tagline'          => '"Bạn có phù hợp để kinh doanh nhà hàng không?"',
        'dv1_description'      => 'Workshop 2 ngày online cực kỳ thực chiến – nơi bạn hiểu ngành F&B từ A–Z, tự đánh giá tiềm năng bản thân và phác thảo kế hoạch kinh doanh đầu tiên.',
        'dv1_time'             => '9:00–11:00 AM',
        'dv1_date'             => '14–15/03/2026',
        'dv1_price'            => '499.000 VNĐ',
        'dv1_slots'            => '30',
        'dv1_countdown_target' => 'March 14, 2026 09:00:00',
        'dv1_cta_label'        => 'Đăng Ký Ngay – Chỉ 30 chỗ',
        'dv1_scholarship_note' => '* Có học bổng 50% cho học viên đặc biệt, liên hệ để biết thêm.',
        'dv1_cred_title'       => 'Từ Đam mê đến Lợi nhuận bền vững',
        'dv1_cred_image'       => clv_seed_img('dv1/instructor_1.png'),
        'dv1_instructor_image' => clv_seed_img('dv1/instructor_2.jpg'),
        'dv1_instructor_name'  => 'Vũ Kiều Loan',
        'dv1_instructor_title' => 'F&B Startup Coach · ICF PCC',
        'dv1_cta_quote'        => '"Mỗi ngày bạn trì hoãn là mỗi ngày đối thủ tiến về phía trước."',
        'dv1_cta_final_label'  => 'Đăng ký ngay hôm nay – Chỉ 30 chỗ cho Passion to Profit',

        'dv1_targets' => [
            ['target_number' => '01', 'target_text' => 'Bạn <strong>đang mơ mở quán</strong> nhưng chưa biết bắt đầu từ đâu'],
            ['target_number' => '02', 'target_text' => 'Bạn <strong>vừa mở quán</strong> và đang bị cuốn vào vận hành 24/7'],
            ['target_number' => '03', 'target_text' => 'Bạn đang <strong>thua lỗ hoặc không có lãi</strong> dù quán đông khách'],
            ['target_number' => '04', 'target_text' => 'Bạn muốn <strong>thoát khỏi công việc văn phòng</strong> và tự kinh doanh'],
            ['target_number' => '05', 'target_text' => 'Bạn có vốn nhưng <strong>chưa có kế hoạch rõ ràng</strong>'],
            ['target_number' => '06', 'target_text' => 'Bạn <strong>đã từng thất bại</strong> và muốn làm lại đúng cách'],
        ],
        'dv1_benefits' => [
            ['benefit_icon' => '🗺️', 'benefit_title' => 'Bản đồ ngành F&B',        'benefit_description' => 'Hiểu ngành từ A–Z: cấu trúc chi phí, mô hình doanh thu, điểm hoà vốn'],
            ['benefit_icon' => '🧭', 'benefit_title' => 'Tự đánh giá tiềm năng',    'benefit_description' => 'Bài kiểm tra thực tế để biết bạn đang ở đâu và cần gì để thành công'],
            ['benefit_icon' => '📋', 'benefit_title' => 'Kế hoạch kinh doanh mẫu',  'benefit_description' => 'Phác thảo được Business Plan cơ bản ngay trong buổi học'],
            ['benefit_icon' => '💰', 'benefit_title' => 'Nền tảng tài chính',        'benefit_description' => 'Hiểu P&L, cash flow và các con số cốt lõi một chủ quán phải biết'],
            ['benefit_icon' => '🤝', 'benefit_title' => 'Cộng đồng F&B',             'benefit_description' => 'Kết nối với 30+ học viên cùng chí hướng, có mentor theo dõi sau khoá'],
            ['benefit_icon' => '🎓', 'benefit_title' => 'Certificate & Tài liệu',    'benefit_description' => 'Trọn bộ tài liệu PDF, templates và chứng nhận hoàn thành'],
        ],
        'dv1_modules' => [
            ['module_label' => 'MODULE 1', 'module_title' => 'Ngày 1: Biết Mình – Biết Ngành', 'module_description' => 'Tự đánh giá năng lực, tìm hiểu cấu trúc ngành F&B, phân tích mô hình thành công và thất bại, xác định concept phù hợp với vốn và kỹ năng bản thân.'],
            ['module_label' => 'MODULE 2', 'module_title' => 'Ngày 2: Lập Bản Đồ Hành Động',   'module_description' => 'Xây dựng Business Plan cơ bản, tính toán chi phí đầu tư, dự báo doanh thu, thiết kế menu sơ bộ và lộ trình 90 ngày đầu tiên để mở quán.'],
        ],
        'dv1_credentials' => [
            ['cred_number' => '01', 'cred_text' => '16 năm trong ngành F&B & Hospitality tại Mỹ và Việt Nam'],
            ['cred_number' => '02', 'cred_text' => "10 năm khởi nghiệp: Đồng sáng lập & điều hành S&L's Diner – chuỗi nhà hàng Mỹ tại Hà Nội"],
            ['cred_number' => '03', 'cred_text' => 'ICF PCC Coach: Top 80 người Việt đạt chứng nhận quốc tế Coach chuyên nghiệp (2025)'],
            ['cred_number' => '04', 'cred_text' => 'Tác giả sách Ánh sáng của ước mơ, đã bán được hơn 1000 bản, chạm đến hơn 1000 người trẻ khởi nghiệp'],
            ['cred_number' => '05', 'cred_text' => 'Đồng hành cùng 50+ chủ quán từ con số 0 đến lợi nhuận bền vững'],
        ],
        'dv1_faqs' => [
            ['faq_question' => 'Workshop này dành cho ai?', 'faq_answer' => 'Dành cho người đang muốn mở quán F&B nhưng chưa biết bắt đầu từ đâu, hoặc đã mở quán nhưng đang gặp khó khăn về tài chính và vận hành.'],
            ['faq_question' => 'Học online có hiệu quả không?', 'faq_answer' => 'Hoàn toàn có. Workshop được thiết kế tương tác cao với bài tập thực hành trực tiếp, không phải chỉ nghe giảng. Bạn sẽ ra về với bản kế hoạch cụ thể.'],
            ['faq_question' => '499.000 có quá rẻ không?', 'faq_answer' => 'Đây là chương trình nhập môn được thiết kế để nhiều người tiếp cận được. Business to Freedom và Business Mastery là các chương trình chuyên sâu hơn với mức đầu tư phù hợp.'],
            ['faq_question' => 'Sau workshop tôi có thể làm gì?', 'faq_answer' => 'Bạn sẽ có: bản đánh giá tiềm năng bản thân, Business Plan sơ bộ, hiểu rõ ngành F&B và kết nối cộng đồng 30+ học viên cùng chí hướng.'],
            ['faq_question' => 'Có học lại được không?', 'faq_answer' => 'Có. Bạn có thể tham gia lại khoá tiếp theo miễn phí nếu cảm thấy cần ôn lại kiến thức.'],
        ],
    ]);
    WP_CLI::log("Seeded DV1 (#$dv1)");
}

/* ════════════════════ DV2 — BUSINESS TO FREEDOM ════════════════════ */
$dv2 = clv_pid('business-to-freedom');
if ($dv2) {
    clv_set($dv2, [
        'dv2_badge'            => 'Khoá học Chuyên sâu 10 tuần',
        'dv2_hero_image'       => clv_seed_img('dv2/hero-coach.png'),
        'dv2_title'            => "BUSINESS\nto FREEDOM",
        'dv2_tagline'          => 'Tự do khi quán vận hành không cần bạn 24/7',
        'dv2_description'      => '10 tuần thực chiến: Từ vận hành bằng cảm tính đến hệ thống SOP, quản lý tài chính và nhân sự bài bản. Bạn học cách để quán tự chạy.',
        'dv2_schedule'         => '10:00–12:00 Thứ 6',
        'dv2_cohort_label'     => 'Khai giảng (K3)',
        'dv2_start_date'       => '27/03/2026',
        'dv2_price'            => '15.000.000 VNĐ',
        'dv2_slots_note'       => '* Khoá học chỉ nhận tối đa 10 học viên để đảm bảo chất lượng',
        'dv2_countdown_target' => 'March 27, 2026 10:00:00',
        'dv2_cta_label'        => 'ĐĂNG KÍ NGAY',
        'dv2_compare_quote'    => 'Nếu coi Passion to Profit là tấm bản đồ giúp bạn nhìn rõ địa hình, thì Business to Freedom là hành trình thực sự – nơi bạn đi từng bước, được trang bị đủ công cụ và có người đồng hành bên cạnh.',
        'dv2_instructor_image' => clv_seed_img('dv1/instructor_2.jpg'),
        'dv2_cta_heading'      => 'Bắt đầu hành trình từ Đam mê đến Tự do',
        'dv2_cta_subtext'      => 'Khai giảng 27/03/2026 – Chỉ 10 chỗ/khoá',
        'dv2_cta_final_label'  => 'ĐĂNG KÝ GIỮ CHỖ',

        'dv2_pains' => [
            ['pain_icon' => '01', 'pain_title' => 'Quán đông nhưng không có lãi',        'pain_description' => 'Bạn bán cả ngày nhưng cuối tháng nhìn tài khoản vẫn trống. Không biết tiền đi đâu.'],
            ['pain_icon' => '02', 'pain_title' => 'Không có quy trình – không thể đi vắng', 'pain_description' => 'Nhân viên làm việc theo cảm tính. Vắng mặt 1 ngày là quán loạn. Bạn mắc kẹt.'],
            ['pain_icon' => '03', 'pain_title' => 'Nhân sự không ổn định',                'pain_description' => 'Tuyển mãi vẫn không giữ được người. Huấn luyện xong lại nghỉ. Bắt đầu lại từ đầu.'],
            ['pain_icon' => '04', 'pain_title' => 'Không biết mở rộng hay dừng lại',      'pain_description' => 'Không có số liệu rõ ràng để đưa ra quyết định. Cảm giác vừa làm vừa đoán.'],
        ],
        'dv2_faqs' => [
            ['faq_question' => 'Chưa từng kinh doanh F&B có học được không?', 'faq_answer' => 'Có. Bạn sẽ đi qua lộ trình 5P hệ thống để hiểu ngành, lập kế hoạch bài bản từ số 0, tránh các sai lầm đắt giá ngay từ đầu.'],
            ['faq_question' => 'Đã mở quán nhưng gặp khó khăn, tôi có cần học?', 'faq_answer' => 'Có. Bạn sẽ học cách rà soát lại toàn bộ, phân tích tài chính, tối ưu menu, quản lý nhân sự và xây dựng lại quy trình để quán tự vận hành được.'],
            ['faq_question' => 'Tôi bận, không theo kịp hết thì sao?', 'faq_answer' => 'Tất cả buổi học đều có tài liệu chi tiết, record và có thể xếp lịch coaching 1:1 với Loan để đảm bảo bạn không bị tụt lại.'],
            ['faq_question' => 'Khác gì khoá Passion to Profit?', 'faq_answer' => 'P2P là bước nền tảng (tổng quan định hướng). B2F là bước nâng cấp đi kèm thực hành làm bài tập, template, SOP chi tiết và coaching theo từng tuần để thực sự mở quán.'],
            ['faq_question' => 'Không giỏi "số má" có theo được không?', 'faq_answer' => 'Được. Các công cụ tài chính được thiết kế đơn giản, trực quan, phục vụ đúng góc nhìn của "người chủ quán" thay vì kế toán.'],
            ['faq_question' => 'Số lượng học viên thế nào?', 'faq_answer' => 'Chỉ tối đa 10 học viên mỗi khoá để đảm bảo chất lượng và Loan có thể theo sát từng mô hình kinh doanh.'],
            ['faq_question' => 'Học xong có thể mở quán ngay không?', 'faq_answer' => 'Có. Sân chơi B2F sẽ cung cấp cho bạn một bản thiết kế chi tiết: Kế hoạch kinh doanh, bản dự toán tài chính, menu định giá, sơ đồ nhân sự để bạn tự tin xúc tiến.'],
            ['faq_question' => 'Có cung cấp tài liệu, template không?', 'faq_answer' => 'Có. Trọn bộ template chuẩn bao gồm: Bảng báo cáo P&L, Menu Engineering, SOP, Checklist mở quán, Lean Canvas đã được Việt hoá và tuỳ chỉnh cho F&B.'],
        ],
    ]);
    WP_CLI::log("Seeded DV2 (#$dv2)");
}

/* ════════════════════ DV3 — BUSINESS MASTERY ════════════════════ */
$dv3 = clv_pid('business-mastery');
if ($dv3) {
    clv_set($dv3, [
        'dv3_badge'       => 'COACHING 1:1 CHIẾN LƯỢC DÀI HẠN',
        'dv3_hero_image'  => clv_seed_img('dv3/hero-coach.png'),
        'dv3_title'       => 'BUSINESS MASTERY',
        'dv3_tagline'     => 'Làm chủ mô hình của bạn ở cấp độ chiến lược',
        'dv3_description' => 'Chương trình Coaching 1:1 dài hạn 6–12 tháng, được thiết kế riêng cho từng doanh nghiệp F&B. Không template. Không giáo trình cứng. Chỉ có chiến lược phù hợp với MÔ HÌNH CỦA BẠN.',
        'dv3_gift_text'   => 'Ưu đãi: Buổi tư vấn 1:1 cùng Loan miễn phí trị giá $200',
        'dv3_cta_label'   => 'ĐĂNG KÍ NGAY',

        'dv3_targets' => [
            ['target_icon' => '🏆', 'target_title' => 'Chủ quán có doanh thu nhưng chưa có lợi nhuận', 'target_description' => 'Bạn đang bán được nhưng cuối tháng vẫn không có tiền để dành. Cần ai đó nhìn vào số liệu và tìm ra vấn đề cốt lõi.'],
            ['target_icon' => '📈', 'target_title' => 'Đang muốn nhân rộng mô hình',                  'target_description' => 'Bạn có 1 quán ổn định và muốn mở thêm chi nhánh hoặc nhượng quyền, nhưng chưa biết xây hệ thống.'],
            ['target_icon' => '🔄', 'target_title' => 'Đang tái cơ cấu hoặc pivot',                   'target_description' => 'Mô hình cũ không còn phù hợp. Bạn cần chiến lược để thay đổi mà không mất đi những gì đã xây dựng.'],
            ['target_icon' => '💼', 'target_title' => 'Chủ quán từ 2 năm trở lên',                    'target_description' => 'Bạn đã có kinh nghiệm nhưng cảm thấy đang làm việc trong vòng lặp. Cần góc nhìn từ ngoài để bứt phá.'],
        ],
        'dv3_plans' => [
            ['plan_duration' => '6 tháng',  'plan_subtitle' => 'Khởi động & định hướng chiến lược', 'plan_price' => '35,000,000 VNĐ', 'plan_featured' => ''],
            ['plan_duration' => '9 tháng',  'plan_subtitle' => 'Xây hệ thống & vận hành tự động',   'plan_price' => '50,000,000 VNĐ', 'plan_featured' => '1'],
            ['plan_duration' => '12 tháng', 'plan_subtitle' => 'Mở rộng & nhân rộng mô hình',       'plan_price' => '65,000,000 VNĐ', 'plan_featured' => ''],
        ],
    ]);
    WP_CLI::log("Seeded DV3 (#$dv3)");
}

/* ════════════════════ CONTACT ════════════════════ */
$con = clv_pid('lien-he');
if ($con) {
    clv_set($con, [
        'contact_title'        => 'Hãy kết nối cùng tôi',
        'contact_subtitle'     => 'Buổi tư vấn đầu tiên hoàn toàn miễn phí — không có cam kết.',
        'contact_intro'        => 'Đừng ngần ngại liên hệ qua bất kỳ kênh nào bạn thấy tiện nhất. Tôi sẽ phản hồi trong vòng 24 giờ.',
        'contact_email'        => 'loanvuk@gmail.com',
        'contact_facebook_url' => 'https://www.facebook.com/loanvuk',
        'contact_form_title'   => 'Gửi tin nhắn cho tôi',
    ]);
    WP_CLI::log("Seeded CONTACT (#$con)");
}

WP_CLI::success('Seeding complete.');
