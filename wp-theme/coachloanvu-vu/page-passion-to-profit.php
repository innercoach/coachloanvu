<?php
/**
 * Template Name: Dich Vu 1 – Passion to Profit
 *
 * page-passion-to-profit.php
 * Create a Page in WP Admin → assign this template.
 * All content managed via ACF field group "Service 1 – Passion to Profit".
 */
get_header();

// Shorthand for this page's post ID
$pid = get_the_ID();
?>

<style>
/* ── Dark theme ── */
html, body { overflow-x: hidden; max-width: 100%; }
body { background: #1a1a1a; color: #fff; }
:root {
    --p2p-gold: #F5A623;
    --p2p-red:  #E63946;
    --p2p-dark: #1a0f0f;
    --p2p-dark2:#140a0a;
    --p2p-card: rgba(255,255,255,0.05);
    --p2p-border: rgba(255,255,255,0.08);
}
h1, h2, h3 { color: var(--p2p-gold); }
p { color: rgba(255,255,255,0.82); }
.site-header { background:#111; border-color:rgba(255,255,255,0.08); }
.nav-logo { color: var(--p2p-gold); }
.nav-links a { color: rgba(255,255,255,0.7); }
.nav-links a:hover, .nav-links a.active { color: var(--p2p-gold); }
.nav-links a::after { background: var(--p2p-gold); }
.site-footer { background: #0d0d0d; }
.badge { background: rgba(245,166,35,0.15); color: var(--p2p-gold); }

/* Sections */
.p2p-section { padding-block: var(--space-20); background: var(--p2p-dark); overflow: hidden; }
.p2p-section.alt { background: var(--p2p-dark2); }

/* Sticky CTA */
.sticky-cta { position:fixed; bottom:0; left:0; right:0; z-index:200; background:var(--p2p-red); padding:var(--space-3) var(--space-6); display:flex; align-items:center; justify-content:space-between; gap:var(--space-4); box-shadow:0 -4px 20px rgba(0,0,0,0.4); }
.sticky-cta-info { display:flex; flex-direction:column; }
.sticky-cta-title { color:#fff; margin:0; font-weight:700; font-size:var(--text-base); }
.sticky-cta-meta { color:rgba(255,255,255,0.8); font-size:var(--text-sm); margin-top:2px; }
.sticky-cta .btn { background:var(--p2p-gold); color:#1a1a1a; padding:var(--space-2) var(--space-6); font-size:var(--text-sm); white-space:nowrap; flex-shrink:0; }

/* Hero */
.hero-p2p { min-height:calc(100vh - 72px); display:grid; grid-template-columns:1fr 1fr; align-items:center; gap:var(--space-8); padding-block:var(--space-12); background: radial-gradient(ellipse at 15% 55%, rgba(139,26,26,0.75) 0%, transparent 55%), radial-gradient(ellipse at 85% 20%, rgba(60,10,10,0.4) 0%, transparent 50%), #111111; }
.hero-p2p-img { position:relative; display:flex; justify-content:center; }
.hero-p2p-img::after { content:''; position:absolute; bottom:0; left:0; right:0; height:35%; background:linear-gradient(to top, #111111 0%, transparent 100%); pointer-events:none; border-radius:0 0 var(--radius-lg) var(--radius-lg); }
.hero-p2p-img img { width:min(420px,100%); height:auto; border-radius:var(--radius-lg); object-fit:cover; object-position:top; }
.coach-label { position:absolute; bottom:16px; left:16px; background:var(--p2p-red); color:#fff; padding:var(--space-2) var(--space-4); border-radius:var(--radius-md); font-size:var(--text-sm); font-weight:700; }
.hero-p2p-title { font-size:clamp(2rem,8vw,5.5rem); font-family:var(--font-heading); line-height:1.1; color:#fff; margin:0; }
.hero-p2p-title span { color:var(--p2p-red); }
.hero-tagline { font-size:var(--text-xl); font-style:italic; color:var(--p2p-gold); margin:var(--space-4) 0; }
.meta-row { display:flex; flex-wrap:wrap; gap:var(--space-4); margin:var(--space-6) 0; }
.meta-item { display:flex; align-items:center; gap:var(--space-2); font-size:var(--text-lg); font-weight:600; color:#fff; }
.price-badge { display:inline-block; background:var(--p2p-gold); color:#1a1a1a; font-family:var(--font-heading); font-size:var(--text-2xl); font-weight:700; padding:var(--space-2) var(--space-6); border-radius:var(--radius-full); margin-bottom:var(--space-4); }
.btn-p2p-cta { background:var(--p2p-red); color:#fff; font-size:var(--text-lg); padding:var(--space-4) var(--space-10); box-shadow:0 4px 15px rgba(230,57,70,0.3); transition:all 0.25s ease; }
.btn-p2p-cta:hover { background:#c52d3a; transform:translateY(-2px); }
.scholarship-note { font-size:var(--text-sm); color:rgba(255,255,255,0.7); margin-top:var(--space-3); }
.scholarship-note strong { color:var(--p2p-gold); }

/* Target Audience */
.target-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:var(--space-4); }
.target-card { background:var(--p2p-card); border:1px solid var(--p2p-border); border-radius:var(--radius-lg); padding:var(--space-6); border-left:4px solid var(--p2p-red); transition:all 0.25s ease; }
.target-card:hover { transform:translateY(-3px); box-shadow:0 8px 20px rgba(0,0,0,0.3); border-left-color:var(--p2p-gold); }
.target-num { font-family:var(--font-heading); font-size:var(--text-3xl); color:var(--p2p-red); opacity:0.4; line-height:1; margin-bottom:var(--space-2); }
.target-card strong { color:var(--p2p-gold); }

/* Benefits */
.benefit-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:var(--space-4); }
.benefit-card { background:var(--p2p-card); border:1px solid var(--p2p-border); border-radius:var(--radius-lg); padding:var(--space-6); }
.benefit-icon { font-size:2rem; margin-bottom:var(--space-3); }
.benefit-card h3 { font-size:var(--text-base); color:var(--p2p-red); margin-bottom:var(--space-2); font-family:var(--font-body); font-weight:700; }

/* Modules */
.modules-list { display:flex; flex-direction:column; gap:var(--space-4); }
.module-card { display:grid; grid-template-columns:auto 1fr; gap:var(--space-6); align-items:start; background:var(--p2p-card); border:1px solid var(--p2p-border); border-radius:var(--radius-lg); padding:var(--space-8); }
.module-label { background:var(--p2p-red); color:#fff; font-family:var(--font-heading); font-size:var(--text-sm); font-weight:700; padding:var(--space-2) var(--space-4); border-radius:var(--radius-md); text-align:center; white-space:nowrap; writing-mode:vertical-rl; transform:rotate(180deg); letter-spacing:0.05em; }
.module-card h3 { font-size:var(--text-xl); color:var(--p2p-gold); margin-bottom:var(--space-3); }

/* Testimonials */
.testi-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:var(--space-6); margin-bottom:var(--space-10); }
.testi-card { background:var(--p2p-card); border:1px solid var(--p2p-border); border-radius:var(--radius-lg); overflow:hidden; display:flex; flex-direction:column; }
.testi-img-wrap { width:100%; aspect-ratio:4/5; overflow:hidden; }
.testi-img { width:100%; height:100%; object-fit:cover; object-position:top center; display:block; }
.testi-body { padding:20px 24px 24px; flex:1; }
.testi-name { font-family:var(--font-heading); font-size:var(--text-lg); color:var(--p2p-red); margin-bottom:0; }
.testi-location { font-size:var(--text-xs); color:rgba(255,255,255,0.5); margin-bottom:var(--space-3); }
.testi-quote { font-size:var(--text-sm); font-style:italic; color:rgba(255,255,255,0.8); margin:0; }

/* Instructor */
.instructor-layout { display:grid; grid-template-columns:1fr 1fr; gap:var(--space-12); align-items:center; }
.instructor-img { border:3px solid var(--p2p-gold); border-radius:var(--radius-lg); overflow:hidden; }
.instructor-img img { width:100%; display:block; }
.instructor-name { font-size:clamp(var(--text-2xl),3vw,var(--text-4xl)); color:var(--p2p-gold); margin-bottom:var(--space-1); }
.instructor-title { color:rgba(255,255,255,0.6); font-size:var(--text-sm); margin-bottom:var(--space-6); }
.cred-list { display:flex; flex-direction:column; gap:var(--space-3); margin-top:var(--space-4); }
.cred-item { display:flex; gap:var(--space-3); align-items:flex-start; background:var(--p2p-red); border-radius:var(--radius-md); padding:var(--space-3) var(--space-4); }
.cred-num { font-family:var(--font-heading); font-size:var(--text-xl); color:var(--p2p-gold); font-weight:700; flex-shrink:0; line-height:1.2; }
.cred-item p { font-size:var(--text-sm); margin:0; color:#fff; }

/* FAQ */
.faq-list { display:flex; flex-direction:column; gap:var(--space-3); }
.faq-item { background:var(--p2p-card); border:1px solid var(--p2p-border); border-radius:var(--radius-md); overflow:hidden; }
.faq-q { width:100%; text-align:left; padding:var(--space-4) var(--space-6); background:transparent; border:none; color:#fff; font-size:var(--text-lg); font-weight:600; font-family:var(--font-heading); cursor:pointer; display:flex; justify-content:space-between; align-items:center; }
.faq-q:hover { background:rgba(204,0,0,0.08); }
.faq-q::after { content:'+'; font-size:1.5rem; color:var(--p2p-gold); transition:transform 0.3s ease; }
.faq-item.open .faq-q::after { transform:rotate(45deg); }
.faq-item.open .faq-q { color:var(--p2p-gold); }
.faq-a { padding:0 var(--space-6); max-height:0; overflow:hidden; transition:all 0.3s ease; }
.faq-item.open .faq-a { padding-bottom:var(--space-5); max-height:500px; }
.faq-a p { font-size:var(--text-sm); margin:0; color:rgba(255,255,255,0.8); }

/* CTA Final */
.cta-section { position:relative; text-align:center; padding-block:var(--space-24); padding-inline:var(--space-6); overflow:hidden; margin-bottom:68px; }
.cta-quote { font-size:clamp(var(--text-lg),2.5vw,var(--text-2xl)); font-weight:700; max-width:760px; margin:0 auto var(--space-8); line-height:1.6; color:#fff; }
.btn-cta-final { display:block; width:fit-content; max-width:calc(100% - 2rem); margin-inline:auto; text-align:center; line-height:1.4; background:var(--p2p-red); color:#fff; font-size:var(--text-xl); padding:var(--space-5) var(--space-8); border-radius:var(--radius-md); }
.btn-cta-final:hover { background:#aa0000; transform:translateY(-3px); box-shadow:0 12px 32px rgba(204,0,0,0.5); }
.slots-note { margin-top:var(--space-4); font-size:var(--text-sm); color:rgba(255,255,255,0.5); }

/* Responsive */
@media(max-width:768px) {
    .hero-p2p { grid-template-columns:1fr; text-align:center; padding-top:var(--space-8); }
    .hero-p2p-img { order:-1; }
    .hero-p2p-img img { width:200px; height:200px; border-radius:50%; }
    .meta-row { justify-content:center; }
    .target-grid, .benefit-grid, .testi-grid { grid-template-columns:repeat(2,1fr); }
    .instructor-layout { grid-template-columns:1fr; }
    .module-card { grid-template-columns:1fr; }
    .module-label { writing-mode:horizontal-tb; transform:none; width:fit-content; }
}
@media(max-width:600px) {
    .target-grid, .benefit-grid, .testi-grid { grid-template-columns:1fr; }
}
</style>

<?php
// ── ACF Field Values ────────────────────────────────────────
$lien_he_url  = esc_url(home_url('/lien-he/'));
$sticky_title = clv_field('dv1_sticky_title', $pid, '🔥 Passion to Profit – Workshop F&B Online');
$sticky_meta  = clv_field('dv1_sticky_meta', $pid, '📅 14–15/03/2026 · 🕘 9:00–11:00 AM · 💰 499.000 VNĐ · Chỉ 30 chỗ');

$hero_img     = clv_field('dv1_hero_image', $pid);
$coach_label  = clv_field('dv1_coach_label', $pid, 'Vũ Kiều Loan – F&B Coach');
$badge        = clv_field('dv1_badge', $pid, 'Workshop F&B Online · 2 ngày');
$title1       = clv_field('dv1_title_line1', $pid, 'PASSION <span>TO</span>');
$title2       = clv_field('dv1_title_line2', $pid, 'PROFIT');
$tagline      = clv_field('dv1_tagline', $pid, '"Bạn có phù hợp để kinh doanh nhà hàng không?"');
$description  = clv_field('dv1_description', $pid, 'Chỉ trong 2 ngày, Passion to Profit giúp bạn soi chiếu bản thân, hiểu rõ ngành F&B và có câu trả lời chắc chắn trước khi đầu tư thời gian, tiền bạc và công sức.');
$time_text    = clv_field('dv1_time', $pid, '9:00–11:00 AM');
$date_text    = clv_field('dv1_date', $pid, '14–15/03/2026');
$price_text   = clv_field('dv1_price', $pid, '499.000 VNĐ');
$slots_text   = clv_field('dv1_slots', $pid, '30');
$cta_label    = clv_field('dv1_cta_label', $pid, 'Đăng Ký Ngay – Chỉ 30 chỗ');
$schol_note   = clv_field('dv1_scholarship_note', $pid, '⭐ Đặc biệt: Cơ hội nhận 1 suất học bổng 100% khoá <strong>BUSINESS TO FREEDOM</strong> trị giá 15 triệu');
$countdown    = clv_field('dv1_countdown_target', $pid, 'March 14, 2026 09:00:00');
$instructor_img   = clv_field('dv1_instructor_image', $pid);
$instructor_name  = clv_field('dv1_instructor_name', $pid, 'Vũ Kiều Loan');
$instructor_title = clv_field('dv1_instructor_title', $pid, 'F&B Startup Coach · ICF PCC');
$cta_quote    = clv_field('dv1_cta_quote', $pid, '"Bạn có thể tiếp tục mơ mộng và trả giá bằng thử–sai, hoặc chỉ cần 2 ngày để có câu trả lời rõ ràng."');
$cta_final    = clv_field('dv1_cta_final_label', $pid, 'Đăng ký ngay hôm nay – Chỉ 30 chỗ cho Passion to Profit');
?>

<!-- Sticky CTA bar -->
<div class="sticky-cta" role="banner" aria-label="Đăng ký nhanh">
    <div class="sticky-cta-info">
        <span class="sticky-cta-title"><?php echo esc_html($sticky_title); ?></span>
        <span class="sticky-cta-meta"><?php echo esc_html($sticky_meta); ?></span>
    </div>
    <a href="<?php echo $lien_he_url; ?>" class="btn btn-accent" style="color:#1a1a1a;font-weight:700;">Đăng Ký Ngay</a>
</div>

<main id="main" role="main">

    <!-- S1: HERO -->
    <section class="hero-p2p" aria-label="Giới thiệu khoá học">
        <div class="hero-p2p-img">
            <?php clv_img_f('dv1_hero_image', $pid, 'dv1/hero-coach.png', 'Coach Vũ Kiều Loan – F&B Coach', '', 'loading="eager" style="width:min(420px,100%);height:auto;border-radius:var(--radius-lg);object-fit:cover;object-position:top"'); ?>
            <div class="coach-label"><?php echo esc_html($coach_label); ?></div>
        </div>

        <div style="padding-inline:var(--space-4);">
            <span class="badge" style="margin-bottom:var(--space-4);display:inline-block;">
                <?php echo esc_html($badge); ?>
            </span>
            <h1 class="hero-p2p-title"><?php echo wp_kses_post($title1); ?><br><?php echo wp_kses_post($title2); ?></h1>
            <p class="hero-tagline"><?php echo esc_html($tagline); ?></p>
            <p style="font-size:var(--text-base);max-width:480px;"><?php echo esc_html($description); ?></p>

            <div class="meta-row">
                <?php if ($time_text): ?>
                <div class="meta-item"><?php echo esc_html($time_text); ?></div>
                <?php endif; ?>
                <?php if ($date_text): ?>
                <div class="meta-item"><?php echo esc_html($date_text); ?></div>
                <?php endif; ?>
            </div>

            <div class="price-badge"><?php echo esc_html($price_text); ?></div>

            <!-- Countdown Timer -->
            <?php if ($countdown): ?>
            <div id="countdown-timer" data-target="<?php echo esc_attr($countdown); ?>"
                 style="margin-bottom:var(--space-6);display:flex;gap:10px;text-align:center;">
                <?php
                $units = [['cd-days','Ngày'], ['cd-hours','Giờ'], ['cd-mins','Phút'], ['cd-secs','Giây']];
                foreach ($units as [$id, $label]):
                    $color = ($id === 'cd-secs') ? 'var(--p2p-red)' : 'var(--p2p-gold)';
                ?>
                <div style="background:rgba(255,255,255,0.1);padding:10px 15px;border-radius:8px;">
                    <div id="<?php echo $id; ?>" style="font-family:var(--font-heading);font-size:2rem;color:<?php echo $color; ?>;line-height:1;">00</div>
                    <div style="font-size:0.75rem;text-transform:uppercase;color:rgba(255,255,255,0.7);"><?php echo $label; ?></div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <div>
                <a href="<?php echo $lien_he_url; ?>" class="btn btn-p2p-cta">
                    <?php echo esc_html($cta_label); ?>
                </a>
            </div>
            <p class="scholarship-note"><?php echo wp_kses_post($schol_note); ?></p>
        </div>
    </section>


    <!-- S2: CREDIBILITY -->
    <section class="p2p-section alt" aria-label="Giới thiệu giảng viên">
        <div class="container">
            <div class="section-header">
                <span class="badge">Về chương trình</span>
                <h2 style="margin-top:1rem;"><?php echo esc_html(clv_field('dv1_cred_title', $pid, 'Từ Đam mê đến Lợi nhuận bền vững')); ?></h2>
                <div class="divider" style="margin-inline:auto;"></div>
            </div>
            <?php
            $cred_img_field = clv_field('dv1_cred_image', $pid);
            if ($cred_img_field && is_array($cred_img_field)) {
                $cred_img_src = $cred_img_field['url'] ?? '';
            } else {
                $cred_img_src = get_template_directory_uri() . '/assets/dv1/instructor_1.png';
            }
            ?>
            <div class="cred-img-wrap">
                <img src="<?php echo esc_url($cred_img_src); ?>"
                     alt="Vũ Kiều Loan đang giảng dạy trong không gian nhà hàng phong cách Mỹ"
                     loading="lazy" style="width:100%;display:block;">
            </div>
            <div class="stats-row">
                <?php
                $default_stats = [
                    ['stat_num' => '15+', 'stat_label' => 'Năm kinh nghiệm Nhà hàng, Khách sạn cao cấp ở Mỹ và Việt Nam'],
                    ['stat_num' => '9+',  'stat_label' => 'Năm khởi nghiệp kinh doanh thực chiến ở thị trường Hà Nội'],
                    ['stat_num' => '1000+','stat_label' => 'Cuốn sách được bán ra, truyền cảm hứng cho người trẻ khởi nghiệp'],
                    ['stat_num' => '30+', 'stat_label' => 'Chủ quán đồng hành, đi từ con số 0 đến lợi nhuận bền vững'],
                ];
                $stats = get_field('dv1_stats', $pid) ?: $default_stats;
                foreach ($stats as $s):
                    $s_num   = is_array($s) ? ($s['stat_num']   ?? '') : '';
                    $s_label = is_array($s) ? ($s['stat_label'] ?? '') : '';
                ?>
                <div class="stat-card" data-reveal>
                    <div class="stat-num"><?php echo esc_html($s_num); ?></div>
                    <div class="stat-label"><?php echo esc_html($s_label); ?></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- S3: TARGET AUDIENCE -->
    <section class="p2p-section" aria-label="Đối tượng tham gia">
        <div class="container">
            <div class="section-header">
                <span class="badge">Dành cho bạn</span>
                <h2 style="margin-top:1rem;"><?php echo esc_html(clv_field('dv1_target_title', $pid, 'Chương trình này dành cho bạn nếu')); ?></h2>
                <div class="divider" style="margin-inline:auto;"></div>
            </div>
            <div class="target-grid">
                <?php if (have_rows('dv1_targets', $pid)):
                    while (have_rows('dv1_targets', $pid)): the_row(); ?>
                <div class="target-card" data-reveal>
                    <div class="target-num"><?php echo esc_html(clv_sub('target_number')); ?></div>
                    <p><?php echo wp_kses_post(clv_sub('target_text')); ?></p>
                </div>
                <?php endwhile; endif; ?>
            </div>
        </div>
    </section>


    <!-- S4: BENEFITS -->
    <section class="p2p-section alt" aria-label="Lợi ích khoá học">
        <div class="container">
            <div class="section-header">
                <span class="badge">Lợi ích</span>
                <h2 style="margin-top:1rem;"><?php echo esc_html(clv_field('dv1_benefits_title', $pid, 'Từ Ước mơ mở quán đến Bản đồ hành động rõ ràng')); ?></h2>
                <div class="divider" style="margin-inline:auto;"></div>
            </div>
            <div class="benefit-grid">
                <?php if (have_rows('dv1_benefits', $pid)):
                    while (have_rows('dv1_benefits', $pid)): the_row(); ?>
                <div class="benefit-card" data-reveal>
                    <div class="benefit-icon" aria-hidden="true"><?php echo esc_html(clv_sub('benefit_icon')); ?></div>
                    <h3><?php echo esc_html(clv_sub('benefit_title')); ?></h3>
                    <p><?php echo esc_html(clv_sub('benefit_description')); ?></p>
                </div>
                <?php endwhile; endif; ?>
            </div>
        </div>
    </section>


    <!-- S5: MODULES -->
    <section class="p2p-section" aria-label="Nội dung khoá học">
        <div class="container">
            <div class="section-header">
                <span class="badge">Nội dung</span>
                <h2 style="margin-top:1rem;"><?php echo esc_html(clv_field('dv1_modules_title', $pid, 'Hành trình 2 ngày học tập')); ?></h2>
                <div class="divider" style="margin-inline:auto;"></div>
            </div>
            <div class="modules-list">
                <?php if (have_rows('dv1_modules', $pid)):
                    while (have_rows('dv1_modules', $pid)): the_row(); ?>
                <div class="module-card" data-reveal>
                    <div class="module-label"><?php echo esc_html(clv_sub('module_label', 'MODULE')); ?></div>
                    <div>
                        <h3><?php echo esc_html(clv_sub('module_title')); ?></h3>
                        <p><?php echo wp_kses_post(clv_sub('module_description')); ?></p>
                    </div>
                </div>
                <?php endwhile; endif; ?>
            </div>
        </div>
    </section>


    <!-- S6: TESTIMONIALS -->
    <section class="p2p-section alt" aria-label="Học viên nói gì">
        <div class="container">
            <div class="section-header">
                <span class="badge">Học viên nói gì</span>
                <h2 style="margin-top:1rem;">Học viên nói gì về PASSION TO PROFIT?</h2>
                <div class="divider" style="margin-inline:auto;"></div>
            </div>

            <?php
            // Default testimonials using bundled theme images (no upload needed)
            $default_dv1_testimonials = [
                ['testi_image' => clv_theme_img_url('dv1/t1-lyly.png'),        'testi_name' => 'Lyly',              'testi_location' => 'Hà Nội',    'testi_quote' => 'Workshop của chị Loan không chỉ truyền cảm hứng mà còn cho em công cụ thực tế để hành động. Giờ thì em biết mô hình nào phù hợp với vốn và năng lực của bản thân. Không còn mơ hồ như trước nữa.'],
                ['testi_image' => clv_theme_img_url('dv1/t1-thuha.png'),       'testi_name' => 'Thu Hà',           'testi_location' => 'Hà Nội',    'testi_quote' => 'Trước giờ em cứ nghĩ phải hoàn hảo rồi mới bắt đầu. Nhưng workshop này cho em thấy bắt đầu từ niềm tin và kế hoạch rõ ràng là đủ. Em muốn mở một quán cafe và bánh ngọt nhỏ nhỏ xinh xinh.'],
                ['testi_image' => clv_theme_img_url('dv1/t1-haohao.png'),      'testi_name' => 'Hảo Hảo',          'testi_location' => 'Hà Nội',    'testi_quote' => 'Em cảm ơn chị Loan rất nhiều khi buổi workshop hôm nay thực sự truyền động lực cho em gia nhập vào ngành F&B. Rất mong được tham dự thêm các buổi workshop của chị để làm rõ các chữ P.'],
                ['testi_image' => clv_theme_img_url('dv1/t2-thuynga.png'),     'testi_name' => 'Thuý Nga',         'testi_location' => 'Hà Nội',    'testi_quote' => 'Tham gia workshop của Loan mà thấy giá trị quá. Chị ao ước mở một quán cafe nhỏ nhưng luôn sợ hãi sẽ thất bại. Nhờ Loan chia sẻ bí kíp, kiến thức, trải nghiệm mà chị có thêm dũng khí để quyết tâm xây dựng lại kế hoạch một cách rõ ràng.'],
                ['testi_image' => clv_theme_img_url('dv1/t2-chuphinnga.png'),  'testi_name' => 'Chu Phi Nga',      'testi_location' => 'Hà Nội',    'testi_quote' => 'Sau khoá học, mình nhận ra rằng: đừng chỉ bắt đầu với đam mê. Đam mê phải đi liền với thực tế, kiểm soát những con số ngay từ khi bắt đầu.'],
                ['testi_image' => clv_theme_img_url('dv1/t2-hoanglam.png'),    'testi_name' => 'Hoàng Lâm',        'testi_location' => 'TP HCM',    'testi_quote' => 'Cảm ơn những kiến thức của chị Loan, giúp em hình dung được các thách thức của một người mới bắt đầu nếu mong muốn bước vào lĩnh vực của ngành F&B và tránh những quyết định dại dột dẫn đến mất tiền.'],
                ['testi_image' => clv_theme_img_url('dv1/t3-liahvu.png'),      'testi_name' => 'Liah Vu',          'testi_location' => 'Hà Nội',    'testi_quote' => 'Tôi thấy tự tin hơn với con đường sắp tới, hiểu rõ hơn các chỉ số quan trọng về tài chính trong việc vận hành một mô hình kinh doanh và sẽ tiếp tục học tập, chia sẻ để biến ước mơ thành hiện thực.'],
                ['testi_image' => clv_theme_img_url('dv1/t3-lykhanhle.png'),   'testi_name' => 'Ly Khánh Lê',      'testi_location' => 'Hà Nội',    'testi_quote' => 'Em từng đóng cửa một quán cà phê vì không biết kiểm soát chi phí. Hôm nay ngồi trong lớp học, em như được chữa lành. Không ai phán xét, không ai dạy đời, chỉ có sự thẳng thắn, rõ ràng, và những hướng dẫn cụ thể.'],
                ['testi_image' => clv_theme_img_url('dv1/t3-diemtruong.png'),  'testi_name' => 'Diễm Trương',      'testi_location' => 'TP HCM',    'testi_quote' => 'Toàn những kiến thức chuyên sâu, thực chiến một người đã trải qua bao nhiêu bài học. Thật quá giá trị.'],
                ['testi_image' => clv_theme_img_url('dv1/t4-kimngan.png'),     'testi_name' => 'Trần Vũ Kim Ngân', 'testi_location' => 'Biên Hoà',  'testi_quote' => 'Sau chỉ 2 buổi workshop, em đã phác thảo được một bản kế hoạch kinh doanh rõ ràng. Bắt đầu từ chân dung khách hàng, tới việc giải quyết các vấn đề, nỗi đau của họ, biết cách làm mình khác biệt hơn với các đối thủ trên thị trường.'],
                ['testi_image' => clv_theme_img_url('dv1/t4-duonghang.png'),   'testi_name' => 'Dương Hằng',       'testi_location' => 'Hà Nội',    'testi_quote' => 'Em tham gia chương trình và học được cách xây dựng kế hoạch và những thứ quan trọng cốt lõi trong việc xây dựng nhà hàng/quán cafe, dự toán doanh thu và chi phí để vận hành quán. Mọi thứ sắp không chỉ còn là giấc mơ.'],
                ['testi_image' => clv_theme_img_url('dv1/t4-quocminh.png'),    'testi_name' => 'Nguyễn Quốc Minh', 'testi_location' => 'Hà Nội',    'testi_quote' => 'Qua 2 buổi workshop em hiểu được việc học hỏi từ những người đi trước là rất quan trọng. Đặc biệt với những ai mới bắt đầu khởi nghiệp sẽ tiết kiệm được rất nhiều thời gian, công sức và tiền bạc.'],
            ];

            // Use ACF data if available, otherwise use bundled defaults
            $testi_rows = get_field('dv1_testimonials', $pid) ?: $default_dv1_testimonials;
            // Merge: for each row, if testi_image is empty (ACF row with no image), fall back to theme image
            $testi_rows = array_map(function($t) {
                if (empty($t['testi_image']) && isset($t['_fallback_img'])) {
                    $t['testi_image'] = $t['_fallback_img'];
                }
                return $t;
            }, $testi_rows);

            $batches = array_chunk($testi_rows, 3);
            foreach ($batches as $batch) :
            ?>
            <div class="testi-grid">
                <?php foreach ($batch as $t) :
                    $img_val = $t['testi_image'] ?? '';
                    $img_src = is_array($img_val) ? ($img_val['url'] ?? '') : ($img_val ?: '');
                ?>
                <div class="testi-card" data-reveal>
                    <div class="testi-img-wrap">
                        <?php if ($img_src): ?>
                        <img src="<?php echo esc_url($img_src); ?>"
                             alt="<?php echo esc_attr($t['testi_name'] ?? ''); ?>"
                             class="testi-img" loading="lazy">
                        <?php endif; ?>
                    </div>
                    <div class="testi-body">
                        <p class="testi-name"><?php echo esc_html($t['testi_name'] ?? ''); ?></p>
                        <p class="testi-location"><?php echo esc_html($t['testi_location'] ?? ''); ?></p>
                        <p class="testi-quote">"<?php echo esc_html($t['testi_quote'] ?? ''); ?>"</p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </section>


    <!-- S10: INSTRUCTOR -->
    <section class="p2p-section" aria-label="Giảng viên">
        <div class="container">
            <div class="section-header">
                <span class="badge">Giảng viên</span>
                <h2 style="margin-top:1rem;">Ai là người đồng hành cùng bạn?</h2>
                <div class="divider" style="margin-inline:auto;"></div>
            </div>
            <div class="instructor-layout">
                <div class="instructor-img">
                    <?php clv_img_f('dv1_instructor_image', $pid, 'dv1/instructor_2.jpg', $instructor_name, '', 'loading="lazy" style="width:100%;display:block"'); ?>
                </div>
                <div>
                    <h2 class="instructor-name"><?php echo esc_html($instructor_name); ?></h2>
                    <p class="instructor-title"><?php echo esc_html($instructor_title); ?></p>
                    <div class="divider"></div>
                    <div class="cred-list">
                        <?php if (have_rows('dv1_credentials', $pid)):
                            while (have_rows('dv1_credentials', $pid)): the_row(); ?>
                        <div class="cred-item">
                            <span class="cred-num"><?php echo esc_html(clv_sub('cred_number')); ?></span>
                            <p><?php echo wp_kses_post(clv_sub('cred_text')); ?></p>
                        </div>
                        <?php endwhile; endif; ?>
                    </div>
                    <!-- Social links from global options -->
                    <div style="margin-top:var(--space-6);display:flex;gap:var(--space-3);flex-wrap:wrap;">
                        <?php
                        $social_style = 'font-size:var(--text-sm);padding:8px 16px;background:rgba(255,255,255,0.08);color:#fff;border:1px solid rgba(255,255,255,0.15);border-radius:var(--radius-md);text-decoration:none;';
                        $fb = clv_option('global_social_facebook');
                        $ig = clv_option('global_social_instagram');
                        $em = clv_option('global_social_email');
                        if ($fb): ?><a href="<?php echo esc_url($fb); ?>" target="_blank" rel="noopener" style="<?php echo $social_style; ?>">📘 Facebook</a><?php endif; ?>
                        <?php if ($ig): ?><a href="<?php echo esc_url($ig); ?>" target="_blank" rel="noopener" style="<?php echo $social_style; ?>">📸 Instagram</a><?php endif; ?>
                        <?php if ($em): ?><a href="mailto:<?php echo sanitize_email($em); ?>" style="<?php echo $social_style; ?>">✉️ <?php echo esc_html($em); ?></a><?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- S11: FAQ -->
    <section class="p2p-section alt" aria-label="Câu hỏi thường gặp">
        <div class="container">
            <div class="section-header">
                <span class="badge">FAQ</span>
                <h2 style="margin-top:1rem;">Câu hỏi thường gặp</h2>
                <div class="divider" style="margin-inline:auto;"></div>
            </div>
            <div class="faq-list" style="max-width:760px;margin-inline:auto;">
                <?php
                $i = 1;
                if (have_rows('dv1_faqs', $pid)):
                    while (have_rows('dv1_faqs', $pid)): the_row(); ?>
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


    <!-- S14: CTA FINAL -->
    <?php
    $cta_bg_url = $hero_img ? (is_array($hero_img) ? $hero_img['url'] : $hero_img) : '';
    $cta_bg_css = $cta_bg_url ? "url('{$cta_bg_url}') center/cover no-repeat" : '';
    ?>
    <section class="cta-section" aria-label="Đăng ký ngay"
        style="background:<?php echo $cta_bg_css ? "linear-gradient(rgba(0,0,0,0.75),rgba(0,0,0,0.75)),{$cta_bg_css}" : 'var(--p2p-dark)'; ?>;">
        <div class="container">
            <p class="cta-quote"><?php echo wp_kses_post($cta_quote); ?></p>
            <a href="<?php echo $lien_he_url; ?>" class="btn btn-cta-final">
                <?php echo esc_html($cta_final); ?>
            </a>
            <p class="slots-note">📅 <?php echo esc_html($date_text); ?> &nbsp;|&nbsp; 🕐 <?php echo esc_html($time_text); ?> &nbsp;|&nbsp; 💲 <?php echo esc_html($price_text); ?></p>
        </div>
    </section>

</main><!-- #main -->

<?php get_footer(); ?>
