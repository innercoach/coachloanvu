<?php
/**
 * Template Name: Dich Vu 2 – Business to Freedom
 *
 * page-business-to-freedom.php
 * Create a Page in WP Admin → assign this template.
 * All content managed via ACF field group "Service 2 – Business to Freedom".
 */
get_header();
$pid = get_the_ID();
?>

<style>
html, body { overflow-x: hidden; max-width: 100%; }
:root {
    --b2f-navy:   #0f1f35;
    --b2f-gold:   #F5C842;
    --b2f-orange: #E87722;
    --b2f-card:   rgba(255,255,255,0.05);
    --b2f-border: rgba(255,255,255,0.08);
    --b2f-glow:   rgba(232,119,34,0.15);
    --b2f-easing: cubic-bezier(0.25,1,0.5,1);
}
body   { background: var(--b2f-navy); color: #CBD5E1; }
h1, h2, h3, h4 { color: var(--b2f-gold); }
p      { color: #CBD5E1; }
.site-header { background: #0a1828; border-bottom: 1px solid var(--b2f-border); }
.nav-logo, .nav-logo span { color: var(--b2f-gold); }
.nav-links a { color: #CBD5E1; }
.nav-links a.active, .nav-links a:hover { color: var(--b2f-gold); }
.nav-links a::after { background: var(--b2f-gold); }
.badge { background: rgba(245,200,66,0.15); color: var(--b2f-gold); border: 1px solid rgba(245,200,66,0.3); }
.btn-primary { background: linear-gradient(135deg,var(--b2f-orange),#d06a1a); color:#fff; box-shadow:0 4px 15px rgba(232,119,34,0.3); }
.btn-primary:hover { background: linear-gradient(135deg,#d06a1a,var(--b2f-orange)); box-shadow:0 6px 25px rgba(232,119,34,0.45); transform:translateY(-2px); }

.b2f-section { padding-block: var(--space-20); overflow: hidden; }
.b2f-section.alt { background: #0a1828; }
.section-header p { color: #94A3B8; }
.b2f-divider { width:60px; height:3px; background:linear-gradient(90deg,var(--b2f-orange),var(--b2f-gold)); margin-block:var(--space-4); border-radius:var(--radius-full); }
.section-header .b2f-divider { margin-inline: auto; }

/* Card */
.b2f-card { background:var(--b2f-card); border:1px solid var(--b2f-border); border-radius:var(--radius-lg); padding:var(--space-8); transition:all 0.35s var(--b2f-easing); position:relative; overflow:hidden; }
.b2f-card::before { content:''; position:absolute; top:0; left:0; right:0; height:3px; background:linear-gradient(90deg,var(--b2f-orange),var(--b2f-gold)); opacity:0; transition:opacity 0.35s; }
.b2f-card:hover { border-color:rgba(245,200,66,0.25); transform:translateY(-4px); box-shadow:0 12px 35px rgba(0,0,0,0.3),0 0 20px var(--b2f-glow); }
.b2f-card:hover::before { opacity:1; }
.b2f-card-icon { font-size:2rem; color:var(--b2f-gold); margin-bottom:var(--space-4); }

/* Hero */
.hero { display:grid; grid-template-columns:2fr 1fr; gap:var(--space-8); align-items:center; }
.hero-section-bg { background: radial-gradient(ellipse at 10% 80%,rgba(232,119,34,0.30) 0%,transparent 50%), radial-gradient(ellipse at 80% 15%,rgba(15,60,100,0.60) 0%,transparent 55%), #0a1828; min-height:90vh; display:flex; align-items:center; padding-block:0; }
.hero-content h1 { line-height:1.1; margin-bottom:var(--space-4); font-size:clamp(2.5rem,5vw,4.5rem); }
.hero-tagline { font-size:var(--text-2xl); color:var(--b2f-orange); font-style:italic; margin-bottom:var(--space-4); }
.hero-info { display:flex; gap:var(--space-8); flex-wrap:wrap; margin-block:var(--space-6); background:rgba(0,0,0,0.2); padding:var(--space-4); border-radius:var(--radius-md); border-left:4px solid var(--b2f-gold); }
.hero-info-item span:first-child { display:block; font-size:var(--text-sm); color:#94A3B8; text-transform:uppercase; letter-spacing:1px; }
.hero-info-item span:last-child { font-weight:700; color:#fff; }
.hero-img-wrap { text-align:center; position:relative; }
.hero-img-wrap::after { content:''; position:absolute; bottom:0; left:0; right:0; height:35%; background:linear-gradient(to top,#0a1828 0%,transparent 100%); pointer-events:none; }
.hero-img { border-radius:var(--radius-lg); max-height:600px; object-fit:contain; }

/* Pain / Target grids */
.pain-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(300px,1fr)); gap:var(--space-6); }
.target-grid { display:grid; grid-template-columns:repeat(2,1fr); gap:var(--space-6); }
.timeline { display:flex; flex-direction:column; gap:var(--space-4); }
.timeline-item { display:flex; gap:var(--space-4); background:var(--b2f-card); padding:var(--space-4); border-radius:var(--radius-md); border-left:3px solid var(--b2f-gold); transition:all 0.35s var(--b2f-easing); }
.timeline-item:hover { border-left-color:var(--b2f-orange); box-shadow:0 8px 25px rgba(0,0,0,0.25),0 0 15px var(--b2f-glow); transform:translateX(4px); }
.timeline-week { font-weight:700; color:var(--b2f-gold); min-width:80px; text-transform:uppercase; font-size:var(--text-sm); }

/* Testi */
.testi-img-wrap { width:100%; aspect-ratio:4/5; overflow:hidden; border-radius:var(--radius-md); margin-bottom:var(--space-4); }
.testi-img { width:100%; height:100%; object-fit:cover; object-position:center; display:block; }
.testi-quote { font-style:italic; color:#fff; }

/* FAQ */
.faq-item { background:var(--b2f-card); border:1px solid var(--b2f-border); border-radius:var(--radius-md); margin-bottom:var(--space-4); overflow:hidden; }
.faq-q { width:100%; text-align:left; padding:var(--space-4) var(--space-6); background:transparent; border:none; color:#fff; font-size:var(--text-lg); font-weight:600; font-family:var(--font-heading); cursor:pointer; display:flex; justify-content:space-between; align-items:center; }
.faq-q::after { content:'+'; font-size:1.5rem; color:var(--b2f-gold); transition:transform var(--transition); }
.faq-item.open .faq-q::after { transform:rotate(45deg); }
.faq-a { padding:0 var(--space-6); max-height:0; overflow:hidden; transition:all 0.3s ease; }
.faq-item.open .faq-a { padding-bottom:var(--space-4); max-height:500px; }
.faq-a p { color:#CBD5E1; }

/* Sticky CTA */
.sticky-cta { position:fixed; bottom:0; left:0; right:0; background:var(--b2f-orange); color:#fff; padding:var(--space-2) var(--space-6); display:flex; justify-content:space-between; align-items:center; gap:var(--space-4); z-index:100; box-shadow:0 -4px 12px rgba(0,0,0,0.3); }
.sticky-cta-info { display:flex; flex-direction:column; }
.sticky-cta-title { color:#fff; font-weight:700; font-size:var(--text-base); }
.sticky-cta-meta { color:rgba(255,255,255,0.85); font-size:var(--text-sm); margin-top:2px; }
.sticky-cta .btn { background:#fff; color:var(--b2f-orange); padding:var(--space-2) var(--space-6); font-size:var(--text-sm); white-space:nowrap; flex-shrink:0; font-weight:700; }

@media(max-width:768px) {
    .hero { grid-template-columns:1fr; }
    .target-grid { grid-template-columns:1fr; }
    .hero-info { flex-direction:column; gap:var(--space-4); }
    body { padding-bottom:70px; }
}
@media(max-width:600px) { .b2f-section { padding-inline:var(--space-4); } .container { padding-inline:var(--space-4); } }
</style>

<?php
$lien_he_url  = esc_url(home_url('/lien-he/'));
$sticky_title = clv_field('dv2_sticky_title', $pid, '🎯 Business to Freedom – Khoá học 10 tuần');
$sticky_meta  = clv_field('dv2_sticky_meta', $pid, 'Khai giảng K3: 27/03/2026 · 15.000.000 VNĐ · Chỉ 10 học viên');
$hero_img     = clv_field('dv2_hero_image', $pid);
$badge        = clv_field('dv2_badge', $pid, 'Khoá học Chuyên sâu 10 tuần');
$title        = clv_field('dv2_title', $pid, "BUSINESS\nto FREEDOM");
$tagline      = clv_field('dv2_tagline', $pid, 'Tự do khi quán vận hành không cần bạn 24/7');
$description  = clv_field('dv2_description', $pid, 'Đam mê và Lợi nhuận là nền tảng, nhưng Tự do mới là đích đến.');
$schedule     = clv_field('dv2_schedule', $pid, '10:00–12:00 Thứ 6');
$cohort       = clv_field('dv2_cohort_label', $pid, 'Khai giảng (K3)');
$start_date   = clv_field('dv2_start_date', $pid, '27/03/2026');
$price        = clv_field('dv2_price', $pid, '15.000.000 VNĐ');
$slots_note   = clv_field('dv2_slots_note', $pid, '* Khoá học chỉ nhận tối đa 10 học viên để đảm bảo chất lượng');
$countdown    = clv_field('dv2_countdown_target', $pid, 'March 27, 2026 10:00:00');
$cta_label    = clv_field('dv2_cta_label', $pid, 'ĐĂNG KÍ NGAY');
?>

<!-- Sticky CTA -->
<div class="sticky-cta" role="banner" aria-label="Đăng ký khoá học">
    <div class="sticky-cta-info">
        <span class="sticky-cta-title"><?php echo esc_html($sticky_title); ?></span>
        <span class="sticky-cta-meta"><?php echo esc_html($sticky_meta); ?></span>
    </div>
    <a href="<?php echo $lien_he_url; ?>" class="btn">Đăng ký ngay</a>
</div>

<main id="main" role="main">

    <!-- S1: HERO -->
    <section class="b2f-section hero-section-bg">
        <div class="container">
            <div class="hero">
                <div class="hero-content">
                    <span class="badge"><?php echo esc_html($badge); ?></span>
                    <h1><?php echo nl2br(esc_html($title)); ?></h1>
                    <p class="hero-tagline"><?php echo esc_html($tagline); ?></p>
                    <p style="font-size:var(--text-lg)"><?php echo esc_html($description); ?></p>

                    <div class="hero-info">
                        <div class="hero-info-item">
                            <span>Lịch học</span>
                            <span><?php echo esc_html($schedule); ?></span>
                        </div>
                        <div class="hero-info-item">
                            <span><?php echo esc_html($cohort); ?></span>
                            <span><?php echo esc_html($start_date); ?></span>
                        </div>
                        <div class="hero-info-item">
                            <span>Chi phí</span>
                            <span style="color:var(--b2f-gold)"><?php echo esc_html($price); ?></span>
                        </div>
                    </div>

                    <p style="font-size:var(--text-sm);font-style:italic;color:var(--b2f-gold)">
                        <?php echo esc_html($slots_note); ?>
                    </p>

                    <!-- Countdown -->
                    <?php if ($countdown): ?>
                    <div id="countdown-timer" data-target="<?php echo esc_attr($countdown); ?>"
                         style="margin-top:var(--space-4);margin-bottom:var(--space-4);display:flex;gap:10px;text-align:center;">
                        <?php
                        $units = [['cd-days','Ngày'],['cd-hours','Giờ'],['cd-mins','Phút'],['cd-secs','Giây']];
                        foreach ($units as [$id,$label]):
                            $color = ($id === 'cd-secs') ? 'var(--b2f-orange)' : 'var(--b2f-gold)';
                        ?>
                        <div style="background:rgba(255,255,255,0.1);padding:10px 15px;border-radius:8px;">
                            <div id="<?php echo $id; ?>" style="font-family:var(--font-heading);font-size:2rem;color:<?php echo $color; ?>;line-height:1;">00</div>
                            <div style="font-size:0.75rem;text-transform:uppercase;color:rgba(255,255,255,0.7);"><?php echo $label; ?></div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>

                    <a href="<?php echo $lien_he_url; ?>" class="btn btn-primary" style="margin-top:var(--space-4)">
                        <?php echo esc_html($cta_label); ?>
                    </a>
                </div>

                <div class="hero-img-wrap">
                    <?php clv_img_f('dv2_hero_image', $pid, 'dv2/hero-coach.png', 'Coach Loan Vũ', 'hero-img', 'loading="eager"'); ?>
                </div>
            </div>
        </div>
    </section>


    <!-- S2: PAIN POINTS -->
    <section class="b2f-section alt">
        <div class="container">
            <div class="section-header">
                <h2>Bạn có đang đối diện với những vấn đề này?</h2>
                <div class="b2f-divider"></div>
            </div>
            <div class="pain-grid">
                <?php if (have_rows('dv2_pains', $pid)):
                    while (have_rows('dv2_pains', $pid)): the_row(); ?>
                <div class="b2f-card" data-reveal>
                    <div class="b2f-card-icon"><?php echo esc_html(clv_sub('pain_icon')); ?></div>
                    <h4><?php echo esc_html(clv_sub('pain_title')); ?></h4>
                    <p><?php echo esc_html(clv_sub('pain_description')); ?></p>
                </div>
                <?php endwhile; endif; ?>
            </div>
        </div>
    </section>


    <!-- S3: TARGET AUDIENCE -->
    <section class="b2f-section">
        <div class="container">
            <div class="section-header">
                <h2>Chương trình này dành cho bạn nếu</h2>
                <div class="b2f-divider"></div>
            </div>
            <div class="target-grid">
                <?php if (have_rows('dv2_targets', $pid)):
                    while (have_rows('dv2_targets', $pid)): the_row(); ?>
                <div class="timeline-item" data-reveal>
                    <div>
                        <h4 style="color:#fff;margin-bottom:8px;"><?php echo esc_html(clv_sub('target_title')); ?></h4>
                        <p><?php echo wp_kses_post(clv_sub('target_description')); ?></p>
                    </div>
                </div>
                <?php endwhile; endif; ?>
            </div>
        </div>
    </section>


    <!-- S4: BENEFITS (Money, Meaning, Freedom) -->
    <section class="b2f-section alt">
        <div class="container">
            <div class="section-header">
                <h2>3 giá trị bạn sẽ nhận được</h2>
                <div class="b2f-divider"></div>
            </div>
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:var(--space-6);">
                <?php if (have_rows('dv2_benefits', $pid)):
                    while (have_rows('dv2_benefits', $pid)): the_row(); ?>
                <div class="b2f-card" data-reveal style="text-align:center;">
                    <h3 style="color:var(--b2f-orange);font-size:3rem;margin-bottom:var(--space-4)">
                        <?php echo esc_html(clv_sub('benefit_letter')); ?>
                    </h3>
                    <h4 style="color:#fff"><?php echo esc_html(clv_sub('benefit_title')); ?></h4>
                    <p><?php echo esc_html(clv_sub('benefit_description')); ?></p>
                </div>
                <?php endwhile; endif; ?>
            </div>
        </div>
    </section>


    <!-- S5-6: WHY DIFFERENT + COMPARISON -->
    <section class="b2f-section">
        <div class="container">
            <div class="target-grid" style="align-items:start;">
                <div>
                    <div class="section-header" style="text-align:left;">
                        <h2>Vì sao chương trình này khác biệt?</h2>
                        <div class="b2f-divider" style="margin-left:0;"></div>
                    </div>
                    <ul style="display:flex;flex-direction:column;gap:var(--space-6);">
                        <?php if (have_rows('dv2_differentiators', $pid)):
                            while (have_rows('dv2_differentiators', $pid)): the_row(); ?>
                        <li>
                            <h4 style="color:var(--b2f-gold)"><?php echo esc_html(clv_sub('diff_title')); ?></h4>
                            <p><?php echo esc_html(clv_sub('diff_description')); ?></p>
                        </li>
                        <?php endwhile; endif; ?>
                    </ul>
                </div>
                <div>
                    <div class="b2f-card" style="background:#0a1828;">
                        <h3 style="color:#fff;text-align:center;margin-bottom:var(--space-6)">
                            So sánh với Passion to Profit
                        </h3>
                        <div style="overflow-x:auto;">
                            <table style="width:100%;border-collapse:collapse;color:#fff;font-size:var(--text-sm)">
                                <tr>
                                    <th style="padding:var(--space-2);border-bottom:1px solid var(--b2f-border);text-align:left;color:#94A3B8;width:20%"></th>
                                    <th style="padding:var(--space-2);border-bottom:1px solid var(--b2f-border);text-align:left;color:var(--b2f-gold);width:40%">P2P (2 ngày)</th>
                                    <th style="padding:var(--space-2);border-bottom:1px solid var(--b2f-border);text-align:left;color:var(--b2f-orange);width:40%">Business to Freedom (10 tuần)</th>
                                </tr>
                                <?php if (have_rows('dv2_compare_rows', $pid)):
                                    while (have_rows('dv2_compare_rows', $pid)): the_row(); ?>
                                <tr>
                                    <td style="padding:var(--space-4) var(--space-2);border-bottom:1px solid var(--b2f-border);font-weight:600;"><?php echo esc_html(clv_sub('row_label')); ?></td>
                                    <td style="padding:var(--space-4) var(--space-2);border-bottom:1px solid var(--b2f-border);opacity:0.8;"><?php echo esc_html(clv_sub('row_p2p')); ?></td>
                                    <td style="padding:var(--space-4) var(--space-2);border-bottom:1px solid var(--b2f-border);"><?php echo esc_html(clv_sub('row_b2f')); ?></td>
                                </tr>
                                <?php endwhile; endif; ?>
                            </table>
                        </div>
                        <?php $compare_quote = clv_field('dv2_compare_quote', $pid, '&ldquo;Nếu coi Passion to Profit là tấm bản đồ, thì Business to Freedom chính là hành trình thực tế có người dẫn đường và cả tập thể đi cùng bạn.&rdquo;'); ?>
                        <?php if ($compare_quote): ?>
                        <p style="margin-top:var(--space-6);font-style:italic;text-align:center;color:var(--b2f-gold)">
                            <?php echo wp_kses_post($compare_quote); ?>
                        </p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- S5b: OUTCOMES – Bạn nhận được gì sau 10 tuần? -->
    <section class="b2f-section alt">
        <div class="container">
            <div class="section-header">
                <h2>Bạn nhận được gì sau 10 tuần học tập?</h2>
                <div class="b2f-divider"></div>
            </div>
            <div class="pain-grid">
                <?php
                $default_outcomes = [
                    ['outcome_icon' => '01', 'outcome_title' => 'Bản đồ 5P rõ ràng',              'outcome_description' => 'Khung chiến lược: Passion, Plan, Product, People & Process, Profit giúp bạn biết đang ở đâu và từng bước biến đam mê thành lợi nhuận.'],
                    ['outcome_icon' => '02', 'outcome_title' => 'Kế hoạch kinh doanh khả thi',    'outcome_description' => 'Dự toán vốn, tính toán điểm hòa vốn. Mọi con số rõ ràng để bạn tự tin gọi vốn hoặc đầu tư chính xác.'],
                    ['outcome_icon' => '03', 'outcome_title' => 'Menu chiến lược & Trải nghiệm',  'outcome_description' => 'Biết cách chọn món, định giá, thiết kế menu để vừa thu hút khách, vừa đảm bảo lợi nhuận tối đa.'],
                    ['outcome_icon' => '04', 'outcome_title' => 'Hệ thống quy trình SOP',         'outcome_description' => 'Thiết kế quy trình chuẩn để nhân sự làm việc hiệu quả, giảm thất thoát, quán có thể chạy tự động.'],
                    ['outcome_icon' => '05', 'outcome_title' => 'Bộ công cụ quản trị tài chính', 'outcome_description' => 'Đọc & hiểu báo cáo P&L, kiểm soát Prime Cost, áp dụng Menu Engineering. Quản lý minh bạch dòng tiền.'],
                    ['outcome_icon' => '06', 'outcome_title' => 'Feedback 1:1 trực tiếp từ Loan', 'outcome_description' => 'Mỗi tuần thực hành, đặt câu hỏi, nhận phản hồi trực tiếp để gỡ bỏ vướng mắc ngay tại chỗ.'],
                ];
                $outcomes = get_field('dv2_outcomes', $pid) ?: $default_outcomes;
                foreach ($outcomes as $o):
                    $o_icon  = is_array($o) ? ($o['outcome_icon']        ?? '') : '';
                    $o_title = is_array($o) ? ($o['outcome_title']       ?? '') : '';
                    $o_desc  = is_array($o) ? ($o['outcome_description'] ?? '') : '';
                ?>
                <div class="timeline-item" data-reveal>
                    <div class="timeline-week"><?php echo esc_html($o_icon); ?></div>
                    <div>
                        <h4 style="color:#fff;"><?php echo esc_html($o_title); ?></h4>
                        <p><?php echo esc_html($o_desc); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- S7-8: CURRICULUM (10 tuần) -->
    <section class="b2f-section">
        <div class="container" style="max-width:800px;">
            <div class="section-header">
                <h2>Lộ trình 10 tuần bao gồm</h2>
                <div class="b2f-divider"></div>
            </div>
            <div class="timeline">
                <?php if (have_rows('dv2_modules', $pid)):
                    while (have_rows('dv2_modules', $pid)): the_row(); ?>
                <div class="timeline-item" data-reveal>
                    <div class="timeline-week"><?php echo esc_html(clv_sub('module_week')); ?></div>
                    <div>
                        <h4 style="color:#fff;margin-bottom:var(--space-2);"><?php echo esc_html(clv_sub('module_title')); ?></h4>
                        <p style="margin:0;"><?php echo esc_html(clv_sub('module_description')); ?></p>
                    </div>
                </div>
                <?php endwhile; endif; ?>
            </div>
        </div>
    </section>


    <!-- S9: TESTIMONIALS -->
    <section class="b2f-section alt">
        <div class="container">
            <div class="section-header">
                <span class="badge">Học viên nói gì</span>
                <h2 style="margin-top:1rem;">Học viên nói gì về Business to Freedom?</h2>
                <div class="b2f-divider"></div>
            </div>
            <?php
            $default_dv2_testimonials = [
                ['testi_image' => clv_theme_img_url('dv2/t1-caolan.png'),     'testi_name' => 'Cao Lan',      'testi_location' => 'Chủ nhà hàng Việt ở Paris, Pháp',         'testi_result' => 'Chuẩn hoá quy trình đầu tên trong mô hình',     'testi_quote' => 'Dù khoá học bắt đầu lúc 2h sáng theo giờ Pháp, chị vẫn thấy rất hào hứng. Giá trị nhất là mọi thứ không còn mơ hồ. Mình biết cái gì đang thiếu và cần thay đổi. Thay đổi đầu tiên chính là áp dụng các quy trình chuẩn cho quán.'],
                ['testi_image' => clv_theme_img_url('dv2/t1-phamhieu.png'),  'testi_name' => 'Phạm Hiếu',   'testi_location' => 'Chủ tiệm cafe Việt ở Virginia, Mỹ',     'testi_result' => '5P trở thành bản đồ vail trò đối chiếu hàng ngày',  'testi_quote' => 'Khoá học chính là công cụ, là bản đồ để dù mình đang làm gì thì cũng có thể quay lại đối chiếu xem mình đã làm đúng hay chưa.'],
                ['testi_image' => clv_theme_img_url('dv2/t1-thanhnga.png'),  'testi_name' => 'Thanh Nga',    'testi_location' => 'Chủ quán trà trái cây Bảo Lộc',             'testi_result' => 'Đầu tước lưu được lợi nhuận mậu đầu tiên',        'testi_quote' => 'Bước tiến của em là vận hành được quán và để dành được lợi nhuận. Dù quán nhỏ, em đã bắt đầu bằng một kế hoạch kinh doanh hoàn chỉnh. Mọi thứ đang vận hành đúng như mong muốn và tự hào về bản thân.'],
                ['testi_image' => clv_theme_img_url('dv2/t1_lananh.png'),    'testi_name' => 'Lân Anh',     'testi_location' => 'Chủ quán cà phê TP HCM',                    'testi_result' => 'Hiểu rõ lo trò, cần chuẩn bị gì từ ngày đầu',       'testi_quote' => 'Đây là khóa học hiếm hoi giúp mình hiểu rõ từ ngày đầu cần chuẩn bị những gì. Loan không chỉ dạy kiến thức mà còn đồng hành như một người thầy thực sự.'],
                ['testi_image' => clv_theme_img_url('dv2/t1_lequyen.png'),   'testi_name' => 'Lê Quyền',    'testi_location' => 'Chủ cưới tiệc Hà Nội',                     'testi_result' => 'Biết tại sao quán lời mà túi tiền cạn, tìm xử lý', 'testi_quote' => 'Sự thay đổi lớn nhất sau khóa học là mình biết tại sao quán lời mà túi tiền vẫn cạn. Từ đó tôi kiểm soát được doanh thu và có kế hoạch mở rộng.'],
                ['testi_image' => clv_theme_img_url('dv2/t1_phuongnabi.png'),'testi_name' => 'Phương Nabi', 'testi_location' => 'Chủ nhà hàng Fusion TP HCM',              'testi_result' => 'Phân tích rõ mô hình, tìm ra diện tích đang tổn thất',   'testi_quote' => 'Loan giúp tôi thấy rõ mô hình thực sự đang hoạt động như thế nào, cà phê hóa nào đang một mình gánh tổn thất. Chưa được phân tích như vậy hết.'],
            ];

            $testis = get_field('dv2_testimonials', $pid) ?: $default_dv2_testimonials;

            $batches = array_chunk($testis, 3);
            foreach ($batches as $batch) :
            ?>
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:var(--space-6);margin-bottom:var(--space-10);">
                <?php foreach ($batch as $t) :
                    $img_val = $t['testi_image'] ?? '';
                    $img_src = is_array($img_val) ? ($img_val['url'] ?? '') : ($img_val ?: ''); ?>
                <div class="b2f-card" data-reveal>
                    <div class="testi-img-wrap">
                        <?php if ($img_src): ?>
                        <img src="<?php echo esc_url($img_src); ?>"
                             alt="<?php echo esc_attr($t['testi_name'] ?? ''); ?>"
                             class="testi-img" loading="lazy">
                        <?php endif; ?>
                    </div>
                    <p class="testi-name" style="font-family:var(--font-heading);font-size:var(--text-lg);color:var(--b2f-orange);margin-bottom:0;"><?php echo esc_html($t['testi_name'] ?? ''); ?></p>
                    <p style="font-size:var(--text-xs);color:rgba(255,255,255,0.5);margin-bottom:var(--space-3);"><?php echo esc_html($t['testi_location'] ?? ''); ?></p>
                    <?php if (!empty($t['testi_result'])): ?>
                    <p style="font-weight:600;color:var(--b2f-gold);font-size:var(--text-sm);margin-bottom:var(--space-2);">✅ <?php echo esc_html($t['testi_result']); ?></p>
                    <?php endif; ?>
                    <p class="testi-quote">"<?php echo esc_html($t['testi_quote'] ?? ''); ?>"</p>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </section>


    <!-- S9b: INSTRUCTOR – Ai là người đồng hành cùng bạn? -->
    <section class="b2f-section">
        <div class="container target-grid" style="align-items:center;">
            <div class="hero-img-wrap" data-reveal>
                <?php
                $inst_img_field = clv_field('dv2_instructor_image', $pid);
                if ($inst_img_field && is_array($inst_img_field)) {
                    $inst_img_src = $inst_img_field['url'] ?? '';
                } else {
                    $inst_img_src = get_template_directory_uri() . '/assets/dv1/instructor_2.jpg';
                }
                ?>
                <img src="<?php echo esc_url($inst_img_src); ?>" alt="Vũ Kiều Loan" class="hero-img"
                     style="border-radius:var(--radius-full);aspect-ratio:1;object-fit:cover;max-width:400px;border:4px solid var(--b2f-gold)">
            </div>
            <div class="hero-content" data-reveal>
                <div class="section-header" style="text-align:left;margin-bottom:var(--space-6);">
                    <h2>Ai là người đồng hành cùng bạn?</h2>
                    <div class="b2f-divider" style="margin-left:0;"></div>
                </div>
                <h3 style="color:#fff;margin-bottom:var(--space-4);">Vũ Kiều Loan
                    <span style="font-size:var(--text-base);color:var(--b2f-gold);display:block;font-weight:normal;margin-top:4px;">F&amp;B Startup Coach, ICF PCC</span>
                </h3>
                <?php
                $default_inst_points = [
                    'Hơn 15 năm trong ngành F&amp;B &amp; Hospitality tại cả Việt Nam và Mỹ.',
                    'Gần 10 năm khởi nghiệp: đồng sáng lập &amp; điều hành S&amp;L Diner, chuỗi nhà hàng Mỹ tại Hà Nội.',
                    'ICF PCC Coach: nằm trong số ít hơn 80 người tại Việt Nam đạt chứng nhận quốc tế này. Đồng hành với hơn 50+ chủ quán qua coaching 1:1 và group coaching.',
                ];
                $inst_points = get_field('dv2_instructor_points', $pid) ?: $default_inst_points;
                ?>
                <ul style="display:flex;flex-direction:column;gap:var(--space-4);margin-bottom:var(--space-6)">
                    <?php foreach ($inst_points as $inst_p):
                        $inst_text = is_array($inst_p) ? ($inst_p['point'] ?? '') : $inst_p;
                    ?>
                    <li style="display:flex;gap:var(--space-4);align-items:flex-start;">
                        <span style="color:var(--b2f-orange);font-size:1.5rem;line-height:1">&#10003;</span>
                        <p style="margin:0"><?php echo wp_kses_post($inst_text); ?></p>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <div style="display:flex;gap:12px;flex-wrap:wrap;margin-top:var(--space-4);">
                    <?php
                    $inst_socials = [
                        ['url' => clv_field('dv2_social_facebook',  $pid, 'https://www.facebook.com/loanvuk'),   'icon' => '📘', 'label' => 'Facebook'],
                        ['url' => clv_field('dv2_social_instagram', $pid, 'https://www.instagram.com/loanvuk'), 'icon' => '📸', 'label' => 'Instagram'],
                        ['url' => clv_field('dv2_social_website',   $pid, 'https://www.vukieuloan.com'),         'icon' => '🌐', 'label' => 'vukieuloan.com'],
                        ['url' => clv_field('dv2_social_email',     $pid, 'mailto:loanvuk@gmail.com'),          'icon' => '&#9993;', 'label' => 'Email'],
                    ];
                    foreach ($inst_socials as $inst_s):
                    ?>
                    <a href="<?php echo esc_url($inst_s['url']); ?>" target="_blank" rel="noopener"
                       style="font-size:var(--text-sm);padding:8px 16px;background:rgba(255,255,255,0.08);color:#fff;border:1px solid rgba(255,255,255,0.15);border-radius:8px;text-decoration:none;">
                        <?php echo $inst_s['icon']; ?> <?php echo esc_html($inst_s['label']); ?>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>


    <!-- S10: PRICING -->
    <section class="b2f-section alt">
        <div class="container" style="max-width:700px;">
            <div class="section-header">
                <h2>Học phí & Hình thức</h2>
                <div class="b2f-divider"></div>
            </div>
            <div class="b2f-card" style="text-align:center;">
                <h3 style="color:#fff;font-size:var(--text-3xl);margin-bottom:var(--space-2);">
                    <?php echo esc_html(clv_field('dv2_price_main', $pid, '15.000.000 VNĐ')); ?>
                </h3>
                <?php
                $price_vip = clv_field('dv2_price_vip', $pid);
                if ($price_vip): ?>
                <p style="color:var(--b2f-gold)">
                    🏆 Gói VIP: <?php echo esc_html($price_vip); ?>
                </p>
                <?php endif; ?>
                <p style="color:#94A3B8;font-size:var(--text-sm);">
                    <?php echo wp_kses_post(clv_field('dv2_payment_note', $pid, 'Hỗ trợ thanh toán 2 đợt. Liên hệ để biết thêm.')); ?>
                </p>
                <a href="<?php echo $lien_he_url; ?>" class="btn btn-primary" style="margin-top:var(--space-6);">
                    Đăng ký ngay
                </a>
            </div>
        </div>
    </section>


    <!-- S11: FAQ -->
    <section class="b2f-section alt">
        <div class="container">
            <div class="section-header">
                <span class="badge">FAQ</span>
                <h2 style="margin-top:1rem;">Câu hỏi thường gặp</h2>
                <div class="b2f-divider"></div>
            </div>
            <div style="max-width:760px;margin-inline:auto;">
                <?php $i = 1;
                if (have_rows('dv2_faqs', $pid)):
                    while (have_rows('dv2_faqs', $pid)): the_row(); ?>
                <div class="faq-item">
                    <button class="faq-q" aria-expanded="false">
                        <span><?php echo $i; ?>. <?php echo esc_html(clv_sub('faq_question')); ?></span>
                    </button>
                    <div class="faq-a">
                        <p><?php echo esc_html(clv_sub('faq_answer')); ?></p>
                    </div>
                </div>
                <?php $i++; endwhile; endif; ?>
            </div>
        </div>
    </section>


    <!-- S12: FINAL CTA -->
    <section class="b2f-section" style="text-align:center;position:relative;">
        <div class="container" style="position:relative;z-index:1;padding-block:var(--space-12);">
            <h2 style="color:#fff;font-size:var(--text-4xl);margin-bottom:var(--space-4);">
                <?php echo wp_kses_post(clv_field('dv2_cta_heading', $pid, 'Bắt đầu hành trình từ Đam mê đến Tự do')); ?>
            </h2>
            <p style="color:var(--b2f-gold);font-size:var(--text-xl);margin-bottom:var(--space-8);">
                <?php echo wp_kses_post(clv_field('dv2_cta_subtext', $pid, 'Khai giảng 27/03/2026 – Chỉ 10 chỗ/khoá')); ?>
            </p>
            <a href="<?php echo $lien_he_url; ?>" class="btn btn-primary"
               style="font-size:var(--text-lg);padding:var(--space-4) var(--space-12);border-radius:var(--radius-full);">
                <?php echo esc_html(clv_field('dv2_cta_final_label', $pid, 'ĐĂNG KÝ GIỮ CHỖ')); ?>
            </a>
        </div>
    </section>


</main><!-- #main -->

<?php get_footer(); ?>
