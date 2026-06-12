<?php
/**
 * Template Name: Dich Vu 3 – Business Mastery
 *
 * page-business-mastery.php
 * All content managed via ACF field group "Service 3 – Business Mastery".
 */
get_header();
$pid = get_the_ID();
?>

<style>
html, body { overflow-x: hidden; max-width: 100%; }
:root {
    --bm-black:  #080808;
    --bm-dark2:  #0e0e0e;
    --bm-gold:   #C9A84C;
    --bm-gold-light: #D4AF37;
    --bm-accent: #2E7D32;
    --bm-card:   rgba(255,255,255,0.03);
    --bm-border: rgba(201,168,76,0.10);
    --bm-glass:  rgba(255,255,255,0.04);
    --bm-easing: cubic-bezier(0.16,1,0.3,1);
    --font-luxury: 'Playfair Display', Georgia, serif;
}
body { background: var(--bm-black); color: #E8E4DC; }
h1, h2, h3, h4 { color: var(--bm-gold); font-family: var(--font-luxury); letter-spacing: 0.02em; }
h1 { letter-spacing: 0.06em; }
p { color: rgba(255,255,255,0.75); }
.site-header { background: rgba(8,8,8,0.92); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(201,168,76,0.08); }
.nav-logo, .nav-logo span { color: var(--bm-gold); }
.nav-links a { color: #B0BEC5; }
.nav-links a.active, .nav-links a:hover { color: var(--bm-gold); }
.nav-links a::after { background: var(--bm-gold); }
.badge { background: rgba(201,168,76,0.08); color: var(--bm-gold); border: 1px solid rgba(201,168,76,0.15); backdrop-filter: blur(8px); }
.btn-primary { background: linear-gradient(135deg,var(--bm-accent),#1b5e20); color:#fff; box-shadow:0 4px 20px rgba(46,125,50,0.35); transition:all 0.4s var(--bm-easing); }
.btn-primary:hover { background:linear-gradient(135deg,#1b5e20,var(--bm-accent)); box-shadow:0 6px 30px rgba(46,125,50,0.5); transform:translateY(-2px); }

/* Glow Blobs */
.bm-glow-blob { position:fixed; border-radius:50%; filter:blur(80px); opacity:0.06; pointer-events:none; z-index:0; }
.bm-glow-blob-1 { width:500px; height:500px; background:var(--bm-gold); top:10%; left:-10%; animation:bm-blob-float 20s ease-in-out infinite alternate; }
.bm-glow-blob-2 { width:400px; height:400px; background:var(--bm-gold-light); bottom:20%; right:-8%; animation:bm-blob-float 25s ease-in-out infinite alternate-reverse; }
@keyframes bm-blob-float { 0%{transform:translate(0,0) scale(1)} 50%{transform:translate(30px,-20px) scale(1.1)} 100%{transform:translate(-20px,30px) scale(0.95)} }

.bm-section { padding-block:var(--space-20); overflow:hidden; position:relative; z-index:1; }
.bm-section.alt { background:var(--bm-dark2); }
.section-header { position:relative; z-index:1; }
.section-header p { color:#94A3B8; }
.section-header h2 { font-size:clamp(1.75rem,3vw,2.5rem); }
.bm-divider { width:60px; height:2px; background:linear-gradient(90deg,transparent,var(--bm-gold),transparent); opacity:0.6; margin-block:var(--space-4); }
.section-header .bm-divider { margin-inline:auto; }

/* Glass Card */
.bm-card { background:var(--bm-glass); backdrop-filter:blur(12px) saturate(1.3); border:1px solid var(--bm-border); border-radius:var(--radius-lg); padding:var(--space-8); transition:all 0.5s var(--bm-easing); position:relative; }
.bm-card:hover { border-color:rgba(201,168,76,0.35); transform:translateY(-6px); box-shadow:0 20px 50px rgba(0,0,0,0.4),0 0 30px rgba(201,168,76,0.06); }
.bm-card-icon { font-size:2rem; color:var(--bm-gold); margin-bottom:var(--space-4); }

.bm-grid-3 { display:grid; grid-template-columns:repeat(3,1fr); gap:var(--space-6); }
.bm-grid-2 { display:grid; grid-template-columns:repeat(2,1fr); gap:var(--space-6); }

/* Hero */
.hero { display:grid; grid-template-columns:2fr 1fr; gap:var(--space-8); align-items:center; }
.hero-section-bg { background:radial-gradient(ellipse at 8% 70%,rgba(201,120,20,0.35) 0%,transparent 50%),radial-gradient(ellipse at 90% 10%,rgba(40,20,5,0.50) 0%,transparent 55%),var(--bm-black); min-height:100vh; display:flex; align-items:center; position:relative; padding-block:0; }
.hero-content h1 { line-height:1.05; margin-bottom:var(--space-4); font-size:clamp(3rem,5vw,5rem); letter-spacing:0.06em; font-family:var(--font-luxury); text-shadow:0 0 80px rgba(201,168,76,0.15); }
.hero-tagline { font-size:var(--text-2xl); color:rgba(255,255,255,0.9); font-family:var(--font-luxury); font-style:italic; margin-bottom:var(--space-4); }
.hero-info { display:inline-block; background:var(--bm-glass); backdrop-filter:blur(12px); padding:var(--space-4); border-radius:var(--radius-md); border-left:2px solid var(--bm-gold); margin-block:var(--space-6); }
.hero-img-wrap { text-align:center; position:relative; }
.hero-img { border-radius:var(--radius-lg); max-height:600px; object-fit:contain; }
.hero-img-wrap::after { content:''; position:absolute; bottom:0; left:0; right:0; height:40%; background:linear-gradient(to top,var(--bm-black) 0%,transparent 100%); pointer-events:none; }

/* Timeline */
.timeline-item { display:flex; gap:var(--space-4); background:var(--bm-glass); backdrop-filter:blur(8px); padding:var(--space-6); border-radius:var(--radius-md); border-left:2px solid rgba(201,168,76,0.25); margin-bottom:var(--space-4); transition:all 0.4s var(--bm-easing); }
.timeline-item:hover { border-left-color:var(--bm-gold); box-shadow:0 10px 30px rgba(0,0,0,0.3); transform:translateX(4px); }

/* Pricing */
.pricing-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:var(--space-6); margin-top:var(--space-8); }
.pricing-card { background:var(--bm-glass); backdrop-filter:blur(12px); border:1px solid var(--bm-border); border-radius:var(--radius-lg); padding:var(--space-8); text-align:center; position:relative; overflow:hidden; transition:all 0.5s var(--bm-easing); }
.pricing-card:hover { transform:translateY(-4px); box-shadow:0 20px 50px rgba(0,0,0,0.4); }
.pricing-card.featured { background:rgba(201,168,76,0.08); border:2px solid var(--bm-gold); transform:scale(1.05); z-index:2; box-shadow:0 0 40px rgba(201,168,76,0.12),0 20px 60px rgba(0,0,0,0.3); }
.pricing-card.featured::before { content:'ĐỀ XUẤT'; position:absolute; top:0; left:50%; transform:translateX(-50%); background:linear-gradient(90deg,var(--bm-gold),var(--bm-gold-light)); color:var(--bm-black); font-size:0.75rem; font-weight:bold; width:100%; padding:4px 0; letter-spacing:2px; font-family:var(--font-luxury); }

/* Sticky CTA */
.sticky-cta { position:fixed; bottom:0; left:0; right:0; background:rgba(8,8,8,0.85); backdrop-filter:blur(16px) saturate(1.4); border-top:1px solid rgba(201,168,76,0.15); padding:var(--space-3) var(--space-6); display:flex; justify-content:space-between; align-items:center; gap:var(--space-4); z-index:100; }
.sticky-cta-info { display:flex; flex-direction:column; }
.sticky-cta-title { font-weight:700; color:var(--bm-gold); font-size:var(--text-base); font-family:var(--font-luxury); }
.sticky-cta-meta { font-size:var(--text-sm); color:rgba(255,255,255,0.65); margin-top:2px; }

.btn-gold { background:transparent; color:var(--bm-gold); border:1px solid var(--bm-gold); padding:var(--space-3) var(--space-6); display:inline-block; text-align:center; font-weight:600; border-radius:var(--radius-full); transition:all 0.4s var(--bm-easing); }
.btn-gold:hover { background:var(--bm-gold); color:var(--bm-black); box-shadow:0 0 30px rgba(201,168,76,0.25); }

@media(max-width:768px) {
    .hero { grid-template-columns:1fr; }
    .pricing-grid { grid-template-columns:1fr; }
    .pricing-card.featured { transform:scale(1); }
    .bm-grid-3, .bm-grid-2 { grid-template-columns:1fr; }
    .bm-section { padding-block:var(--space-12); }
    .hero-content h1 { font-size:clamp(2rem,8vw,2.5rem); }
}
@media(max-width:600px) { .bm-section { padding-inline:var(--space-4); } .container { padding-inline:var(--space-4); } .bm-glow-blob { display:none; } }
@media(max-width:640px) { .sticky-cta { flex-wrap:wrap; justify-content:center; text-align:center; } .sticky-cta-info { width:100%; align-items:center; } }
</style>

<?php
$lien_he_url  = esc_url(home_url('/lien-he/'));
$sticky_title = clv_field('dv3_sticky_title', $pid, '✨ Business Mastery – Coaching 1:1 Chiến Lược Dài Hạn');
$sticky_meta  = clv_field('dv3_sticky_meta', $pid, '🎁 Buổi tư vấn 1:1 miễn phí trị giá $200 · Chỉ 5 học viên/năm');
$hero_img     = clv_field('dv3_hero_image', $pid);
$hero_badge   = clv_field('dv3_badge', $pid, 'COACHING 1:1 CHIẾN LƯỢC DÀI HẠN');
$hero_title   = clv_field('dv3_title', $pid, 'BUSINESS MASTERY');
$hero_tagline = clv_field('dv3_tagline', $pid, 'Làm chủ mô hình của bạn ở cấp độ chiến lược');
$hero_desc    = clv_field('dv3_description', $pid, 'Chương trình coaching 1:1 chuyên sâu dành cho chủ quán nghiêm túc với tăng trưởng dài hạn.');
$gift_text    = clv_field('dv3_gift_text', $pid, 'Ưu đãi: Buổi tư vấn 1:1 cùng Loan miễn phí trị giá $200');
$cta_label    = clv_field('dv3_cta_label', $pid, 'ĐĂNG KÍ NGAY');
?>

<!-- Ambient Glow Blobs -->
<div class="bm-glow-blob bm-glow-blob-1" aria-hidden="true"></div>
<div class="bm-glow-blob bm-glow-blob-2" aria-hidden="true"></div>

<!-- Sticky CTA -->
<div class="sticky-cta" role="banner" aria-label="Đăng ký tư vấn">
    <div class="sticky-cta-info">
        <span class="sticky-cta-title"><?php echo esc_html($sticky_title); ?></span>
        <span class="sticky-cta-meta"><?php echo esc_html($sticky_meta); ?></span>
    </div>
    <a href="<?php echo $lien_he_url; ?>" class="btn btn-primary" style="white-space:nowrap;padding:8px 24px;">Liên hệ ngay</a>
</div>

<main id="main" role="main">

    <!-- S1: HERO -->
    <section class="bm-section hero-section-bg">
        <div class="container">
            <div class="hero">
                <div class="hero-content">
                    <span class="badge" style="letter-spacing:2px;"><?php echo esc_html($hero_badge); ?></span>
                    <h1><?php echo esc_html($hero_title); ?></h1>
                    <p class="hero-tagline"><?php echo esc_html($hero_tagline); ?></p>
                    <p style="font-size:var(--text-lg)"><?php echo esc_html($hero_desc); ?></p>

                    <div class="hero-info">
                        <span style="color:var(--bm-gold);font-size:1.5rem;display:inline-block;margin-right:8px;">🎁</span>
                        <span style="color:#fff;font-weight:600"><?php echo esc_html($gift_text); ?></span>
                    </div>

                    <div>
                        <a href="<?php echo $lien_he_url; ?>" class="btn btn-primary" style="margin-top:var(--space-2);">
                            <?php echo esc_html($cta_label); ?>
                        </a>
                    </div>
                </div>

                <div class="hero-img-wrap">
                    <?php clv_img_f('dv3_hero_image', $pid, 'dv3/hero-coach.png', 'Coach Loan Vũ Business Mastery', 'hero-img', 'loading="eager"'); ?>
                </div>
            </div>
        </div>
    </section>


    <!-- S2: PAIN POINTS -->
    <section class="bm-section alt">
        <div class="container">
            <div class="section-header">
                <h2>Bạn có đang đối diện với những vấn đề này?</h2>
                <div class="bm-divider"></div>
            </div>
            <div class="bm-grid-2">
                <?php if (have_rows('dv3_pains', $pid)):
                    while (have_rows('dv3_pains', $pid)): the_row();
                    $extra_style = get_sub_field('pain_full_width') ? 'grid-column:1/-1;max-width:600px;margin-inline:auto;' : '';
                ?>
                <div class="timeline-item" data-reveal style="<?php echo esc_attr($extra_style); ?>">
                    <span style="font-size:2rem;line-height:1;color:var(--bm-accent);font-weight:bold;">
                        <?php echo esc_html(clv_sub('pain_number')); ?>
                    </span>
                    <div>
                        <h4 style="color:#fff;"><?php echo esc_html(clv_sub('pain_title')); ?></h4>
                        <p><?php echo esc_html(clv_sub('pain_description')); ?></p>
                    </div>
                </div>
                <?php endwhile; endif; ?>
            </div>
        </div>
    </section>


    <!-- S3: WHO SHOULD JOIN -->
    <section class="bm-section">
        <div class="container">
            <div class="section-header">
                <h2>Ai nên tham gia?</h2>
                <div class="bm-divider"></div>
            </div>
            <div class="bm-grid-2">
                <?php if (have_rows('dv3_targets', $pid)):
                    while (have_rows('dv3_targets', $pid)): the_row(); ?>
                <div class="bm-card" data-reveal>
                    <div class="bm-card-icon"><?php echo esc_html(clv_sub('target_icon')); ?></div>
                    <h4 style="color:var(--bm-gold);font-size:1.25rem;"><?php echo esc_html(clv_sub('target_title')); ?></h4>
                    <p><?php echo esc_html(clv_sub('target_description')); ?></p>
                </div>
                <?php endwhile; endif; ?>
            </div>
        </div>
    </section>


    <!-- S4: HOW IT WORKS -->
    <section class="bm-section alt">
        <div class="container">
            <div class="section-header">
                <h2>Chương trình hoạt động như thế nào?</h2>
                <div class="bm-divider"></div>
                <p style="text-align:center;margin-bottom:var(--space-8);">
                    <span class="badge">Là chương trình coaching / mentoring 1-1</span>
                </p>
            </div>

            <div class="bm-grid-2">
                <div class="bm-card" style="border-top:4px solid #8B1A1A;">
                    <h3 style="color:#fff;margin-bottom:var(--space-4)">Không giống khoá học thông thường:</h3>
                    <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:var(--space-2)">
                        <?php if (have_rows('dv3_not_like', $pid)):
                            while (have_rows('dv3_not_like', $pid)): the_row(); ?>
                        <li style="display:flex;gap:10px;"><span style="color:#8B1A1A">❌</span> <?php echo esc_html(clv_sub('not_text')); ?></li>
                        <?php endwhile; endif; ?>
                    </ul>
                </div>
                <div class="bm-card" style="border-top:4px solid var(--bm-accent);">
                    <h3 style="color:#fff;margin-bottom:var(--space-4)">Thay vào đó bạn nhận được:</h3>
                    <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:var(--space-2)">
                        <?php if (have_rows('dv3_you_get', $pid)):
                            while (have_rows('dv3_you_get', $pid)): the_row(); ?>
                        <li style="display:flex;gap:10px;"><span style="color:var(--bm-accent)">✓</span> <?php echo esc_html(clv_sub('get_text')); ?></li>
                        <?php endwhile; endif; ?>
                    </ul>
                </div>
            </div>

            <!-- Focus badges -->
            <?php if (have_rows('dv3_focus_badges', $pid)): ?>
            <div style="background:rgba(201,168,76,0.1);border:1px solid var(--bm-gold);padding:var(--space-6);border-radius:var(--radius-lg);margin-top:var(--space-8);text-align:center;">
                <h4 style="margin-bottom:var(--space-4);color:var(--bm-gold);">Mỗi buổi làm việc tập trung trực tiếp vào:</h4>
                <div style="display:flex;flex-wrap:wrap;justify-content:center;gap:var(--space-4);">
                    <?php while (have_rows('dv3_focus_badges', $pid)): the_row(); ?>
                    <span class="badge" style="font-size:var(--text-sm);"><?php echo esc_html(clv_sub('badge_label')); ?></span>
                    <?php endwhile; ?>
                </div>
                <p style="margin-top:var(--space-6);font-style:italic;color:#fff;">
                    <?php echo esc_html(clv_field('dv3_focus_note', $pid, 'Mục tiêu không phải học thêm kiến thức. Mục tiêu là mô hình của bạn vận hành tốt hơn sau từng tháng.')); ?>
                </p>
            </div>
            <?php endif; ?>
        </div>
    </section>


    <!-- S5: VALUE PROPS -->
    <section class="bm-section">
        <div class="container">
            <div class="section-header">
                <h2>3 giá trị bạn sẽ nhận được</h2>
                <div class="bm-divider"></div>
            </div>
            <div class="bm-grid-3">
                <?php if (have_rows('dv3_values', $pid)):
                    while (have_rows('dv3_values', $pid)): the_row(); ?>
                <div class="bm-card" data-reveal style="text-align:center;">
                    <div style="font-size:4rem;line-height:1;color:var(--bm-gold);margin-bottom:var(--space-4);opacity:0.3;font-weight:bold;">
                        <?php echo esc_html(clv_sub('value_number')); ?>
                    </div>
                    <h4 style="color:#fff;"><?php echo esc_html(clv_sub('value_title')); ?></h4>
                    <p><?php echo esc_html(clv_sub('value_description')); ?></p>
                </div>
                <?php endwhile; endif; ?>
            </div>
        </div>
    </section>


    <!-- S6: WHAT YOU GET (Deliverables) -->
    <section class="bm-section alt">
        <div class="container" style="max-width:800px;">
            <div class="section-header">
                <h2>Bạn sẽ nhận được gì trong quá trình đồng hành?</h2>
                <div class="bm-divider"></div>
            </div>

            <div style="display:flex;flex-direction:column;gap:var(--space-4);">
                <?php if (have_rows('dv3_deliverables', $pid)):
                    while (have_rows('dv3_deliverables', $pid)): the_row(); ?>
                <div class="timeline-item" data-reveal>
                    <span style="color:var(--bm-accent);font-size:1.5rem">✓</span>
                    <p style="margin:0"><strong style="color:#fff;"><?php echo esc_html(clv_sub('deliverable_title')); ?></strong> <?php echo esc_html(clv_sub('deliverable_description')); ?></p>
                </div>
                <?php endwhile; endif; ?>
            </div>

            <?php $d_note = clv_field('dv3_deliverables_note', $pid); if ($d_note): ?>
            <p style="text-align:center;margin-top:var(--space-6);font-style:italic;color:var(--bm-gold);">
                <?php echo esc_html($d_note); ?>
            </p>
            <?php endif; ?>
        </div>
    </section>


    <!-- S7: COMPARISON TABLE -->
    <section class="bm-section">
        <div class="container">
            <div class="section-header">
                <h2>Khác biệt với Business to Freedom</h2>
                <div class="bm-divider"></div>
            </div>
            <div style="overflow-x:auto;">
                <table style="width:100%;min-width:600px;border-collapse:collapse;color:#fff;">
                    <thead>
                        <tr>
                            <th style="padding:var(--space-4);border-bottom:1px solid var(--bm-border);color:#94A3B8;text-align:left;width:20%;"></th>
                            <th style="padding:var(--space-4);border-bottom:1px solid var(--bm-border);color:#E87722;text-align:left;width:40%;">BUSINESS to FREEDOM</th>
                            <th style="padding:var(--space-4);border-bottom:1px solid var(--bm-border);color:var(--bm-gold);text-align:left;width:40%;">BUSINESS MASTERY</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (have_rows('dv3_compare_rows', $pid)):
                            while (have_rows('dv3_compare_rows', $pid)): the_row(); ?>
                        <tr>
                            <td style="padding:var(--space-4);border-bottom:1px solid rgba(255,255,255,0.05);font-weight:600;color:#94A3B8;"><?php echo esc_html(clv_sub('row_label')); ?></td>
                            <td style="padding:var(--space-4);border-bottom:1px solid rgba(255,255,255,0.05);opacity:0.8;"><?php echo esc_html(clv_sub('row_btf')); ?></td>
                            <td style="padding:var(--space-4);border-bottom:1px solid rgba(255,255,255,0.05);font-weight:600;background:rgba(201,168,76,0.05)"><?php echo esc_html(clv_sub('row_bm')); ?></td>
                        </tr>
                        <?php endwhile; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>


    <!-- S8: PRICING -->
    <section class="bm-section alt">
        <div class="container">
            <div class="section-header">
                <h2>Thời lượng và Hình thức</h2>
                <div class="bm-divider"></div>
                <p style="text-align:center;">Coaching 1:1 online qua Zoom · 1 buổi / tuần</p>
            </div>

            <div class="pricing-grid">
                <?php if (have_rows('dv3_plans', $pid)):
                    while (have_rows('dv3_plans', $pid)): the_row();
                    $is_featured = get_sub_field('plan_featured');
                    $btn_class   = $is_featured ? 'btn btn-primary' : 'btn-gold';
                ?>
                <div class="pricing-card<?php echo $is_featured ? ' featured' : ''; ?>" data-reveal>
                    <h3 style="color:#fff;"><?php echo esc_html(clv_sub('plan_duration')); ?></h3>
                    <p style="color:#94A3B8;font-size:var(--text-sm);margin-bottom:var(--space-4);"><?php echo esc_html(clv_sub('plan_subtitle')); ?></p>
                    <div style="font-size:<?php echo $is_featured ? '2.5rem' : '2rem'; ?>;font-weight:bold;color:var(--bm-gold);margin-bottom:var(--space-6);">
                        <?php echo esc_html(clv_sub('plan_price')); ?><span style="font-size:1rem;opacity:0.6;">đ</span>
                    </div>
                    <a href="<?php echo $lien_he_url; ?>" class="<?php echo $btn_class; ?>" style="width:100%;">Tư vấn lộ trình</a>
                </div>
                <?php endwhile; endif; ?>
            </div>

            <?php $cap_note = clv_field('dv3_capacity_note', $pid, '* Đặc biệt: Chỉ nhận tối đa 5 học viên mỗi năm để đảm bảo chất lượng đồng hành sâu sát.'); ?>
            <div style="text-align:center;margin-top:var(--space-8);">
                <p style="color:var(--bm-gold);font-size:var(--text-lg);font-style:italic;"><?php echo esc_html($cap_note); ?></p>
            </div>
        </div>
    </section>

</main><!-- #main -->

<?php get_footer(); ?>
