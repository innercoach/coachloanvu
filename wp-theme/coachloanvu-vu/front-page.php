<?php
/**
 * Template Name: Trang Chủ
 *
 * front-page.php — Homepage (equivalent to index.html).
 * All content is managed via ACF fields on the "Trang chủ" page.
 */
get_header();
?>

<style>
/* ── Homepage Theme ── */
:root {
    --c-dv1: #CC0000;
    --c-dv2: #E87722;
    --c-dv3: #C9A84C;
    --home-bg: #0a0a0a;
    --home-card: rgba(255,255,255,0.03);
    --home-border: rgba(255,255,255,0.08);
    --gold-accent: #C9A84C;
}
body { background: var(--home-bg); color: #CBD5E1; }
h1, h2, h3, h4 { color: #fff; }
.site-header { background: rgba(10,10,10,0.95); backdrop-filter: blur(10px); border-bottom: 1px solid var(--home-border); position: fixed; top: 0; width: 100%; z-index: 1000; }
.nav-logo, .nav-logo span { color: var(--gold-accent); }
.nav-links a { color: #CBD5E1; }
.nav-links a.active, .nav-links a:hover { color: var(--gold-accent); }

.btn-gold { background: var(--gold-accent); color: #000; padding: var(--space-3) var(--space-6); border-radius: var(--radius-full); font-weight: 600; display: inline-block; transition: all var(--transition); }
.btn-gold:hover { background: #E6C86C; transform: translateY(-2px); }
.btn-outline { border: 1px solid var(--gold-accent); color: var(--gold-accent); padding: var(--space-3) var(--space-6); border-radius: var(--radius-full); font-weight: 600; display: inline-block; background: transparent; transition: all var(--transition); }
.btn-outline:hover { background: rgba(201,168,76,0.1); }

.section-title { text-align: center; margin-bottom: var(--space-12); }
.section-title h2 { font-size: clamp(2rem,4vw,3rem); font-family: var(--font-heading); color: var(--gold-accent); margin-bottom: var(--space-4); }
.section-title p { color: #94A3B8; font-size: var(--text-lg); max-width: 600px; margin-inline: auto; }

.home-section { padding-block: var(--space-24) var(--space-20); overflow: hidden; }
.home-section.alt { background: linear-gradient(180deg, #050505 0%, #0a0a0a 100%); }
.home-divider { width: 60px; height: 3px; background: var(--gold-accent); margin-inline: auto; margin-block: var(--space-4); opacity: 0.8; }

/* Hero */
.hero { display: grid; grid-template-columns: 1.2fr 1fr; gap: var(--space-8); align-items: center; min-height: auto; padding-top: 110px; padding-bottom: var(--space-12); }
.hero-content h1 { font-family: var(--font-heading); font-size: clamp(2.5rem,5vw,4.5rem); line-height: 1.1; margin-bottom: var(--space-6); background: linear-gradient(to right, #F5A623, #C9A84C); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
.hero-tagline { font-size: var(--text-xl); color: #E2E8F0; margin-bottom: var(--space-6); line-height: 1.6; }
.hero-img-wrap { text-align: right; position: relative; }
.hero-img { max-height: 560px; width: 100%; object-fit: contain; object-position: bottom right; mask-image: linear-gradient(to bottom, black 82%, transparent 100%); -webkit-mask-image: linear-gradient(to bottom, black 82%, transparent 100%); }
.hero-bg-blob { position: absolute; width: 400px; height: 400px; background: var(--gold-accent); border-radius: 50%; filter: blur(100px); opacity: 0.15; top: 50%; left: 50%; transform: translate(-50%,-50%); z-index: -1; }

/* Services */
.service-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: var(--space-6); }
.srv-card { background: var(--home-card); border: 1px solid var(--home-border); border-radius: var(--radius-lg); padding: var(--space-8); display: flex; flex-direction: column; transition: all var(--transition); position: relative; overflow: hidden; text-align: left; }
.srv-card:hover { transform: translateY(-8px); border-color: rgba(255,255,255,0.2); }
.srv-num { font-family: var(--font-heading); font-size: 3rem; color: rgba(255,255,255,0.05); position: absolute; top: 20px; right: 20px; line-height: 1; }
.srv-card h3 { font-size: 1.75rem; margin-bottom: var(--space-2); margin-top: var(--space-8); }
.srv-card p { flex-grow: 1; color: #94A3B8; margin-bottom: var(--space-6); }
.srv-card.c-p2p { border-top: 4px solid var(--c-dv1); }
.srv-card.c-p2p h3 { color: var(--c-dv1); }
.srv-card.c-b2f { border-top: 4px solid var(--c-dv2); }
.srv-card.c-b2f h3 { color: var(--c-dv2); }
.srv-card.c-bm  { border-top: 4px solid var(--c-dv3); }
.srv-card.c-bm  h3 { color: var(--c-dv3); }

/* About */
.about-grid { display: grid; grid-template-columns: 1fr 1.3fr; gap: var(--space-12); align-items: center; }
.about-img-wrap { position: relative; }
.about-img { width: 100%; max-width: 420px; max-height: 520px; border-radius: var(--radius-lg); object-fit: cover; object-position: top center; border: 1px solid var(--home-border); }
.about-img-badge { position: absolute; bottom: 20px; left: -20px; background: var(--gold-accent); color: #000; font-weight: 700; font-size: var(--text-sm); padding: var(--space-2) var(--space-4); border-radius: var(--radius-md); box-shadow: 0 8px 24px rgba(0,0,0,0.4); }
.about-badge-row { display: flex; flex-wrap: wrap; gap: var(--space-2); margin-bottom: var(--space-6); }
.about-badge { background: rgba(201,168,76,0.1); border: 1px solid rgba(201,168,76,0.25); color: var(--gold-accent); padding: 4px 12px; border-radius: var(--radius-full); font-size: var(--text-sm); font-weight: 600; }
.about-name { font-size: clamp(2rem,4vw,3rem); font-family: var(--font-heading); color: #fff; margin-bottom: var(--space-2); }
.about-title { color: var(--gold-accent); font-size: var(--text-lg); margin-bottom: var(--space-6); }
.about-bio { color: #94A3B8; line-height: 1.8; margin-bottom: var(--space-8); }
.stat-grid { display: grid; grid-template-columns: repeat(4,1fr); gap: var(--space-4); }
.stat-card { background: var(--home-card); border: 1px solid var(--home-border); border-radius: var(--radius-md); padding: var(--space-4) var(--space-3); text-align: center; transition: border-color 0.3s; }
.stat-card:hover { border-color: rgba(201,168,76,0.4); }
.stat-num { font-family: var(--font-heading); font-size: var(--text-3xl); color: var(--gold-accent); font-weight: 700; line-height: 1; margin-bottom: 4px; }
.stat-label { font-size: var(--text-xs); color: #64748B; text-transform: uppercase; letter-spacing: 0.05em; }

/* Book */
.book-section { background: linear-gradient(135deg,#111 0%,#1a1a1a 100%); border-top: 1px solid var(--home-border); border-bottom: 1px solid var(--home-border); padding-block: var(--space-20); }
.book-grid { display: grid; grid-template-columns: 1fr 1fr; gap: var(--space-12); align-items: center; }
.book-img-wrap { text-align: center; }

/* Testimonials */
.testi-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: var(--space-6); }
.testi-card { background: var(--home-card); border: 1px solid var(--home-border); padding: var(--space-8); border-radius: var(--radius-lg); }
.testi-card p { font-style: italic; color: #E2E8F0; margin-bottom: var(--space-6); }
.testi-author { display: flex; align-items: center; gap: var(--space-4); border-top: 1px solid var(--home-border); padding-top: var(--space-4); }
.testi-avatar { width: 48px; height: 48px; border-radius: 50%; object-fit: cover; }
.testi-author h4 { font-size: var(--text-base); margin: 0; color: var(--gold-accent); }
.testi-author span { font-size: var(--text-sm); color: #94A3B8; }

/* Ecosystem */
.eco-grid { display: grid; grid-template-columns: repeat(auto-fit,minmax(250px,1fr)); gap: var(--space-6); }
.eco-card { background: var(--home-card); border: 1px solid var(--home-border); border-radius: var(--radius-lg); padding: var(--space-8); text-align: center; transition: all var(--transition); display: flex; flex-direction: column; align-items: center; justify-content: center; text-decoration: none; }
.eco-card:hover { background: rgba(255,255,255,0.06); transform: translateY(-4px); }
.eco-icon { font-size: 2.5rem; margin-bottom: var(--space-4); color: var(--gold-accent); }

/* Responsive */
@media(max-width:992px) {
    .hero, .book-grid { grid-template-columns: 1fr; text-align: center; }
    .hero-img-wrap { text-align: center; }
    .hero-img { max-height: 500px; }
    .service-grid, .testi-grid { grid-template-columns: 1fr; }
}
@media(max-width:768px) {
    .about-grid { grid-template-columns: 1fr; }
    .about-img-wrap { display: none; }
    .stat-grid { grid-template-columns: repeat(2,1fr); gap: var(--space-6) var(--space-4); }
    .hero-content h1 { font-size: clamp(2rem,8vw,3rem); }
    .srv-num { font-size: 6rem; opacity: 0.05; }
    .book-section .btn-gold, .book-section .btn-outline { width: 100%; text-align: center; }
}
</style>

<main id="main" role="main">

    <!-- ══════════════════════════════════════════════════════
         SECTION 1: HERO
    ══════════════════════════════════════════════════════ -->
    <section class="home-section" style="padding-top:0;">
        <div class="container hero">

            <div class="hero-content" data-reveal>
                <span style="color:var(--gold-accent);font-weight:600;letter-spacing:2px;text-transform:uppercase;font-size:var(--text-sm)">
                    <?php clv_e('hero_eyebrow', null, 'F&B Startup Coach, ICF PCC'); ?>
                </span>

                <h1><?php echo wp_kses_post(clv_field('hero_title', null, 'Từ Đam mê đến Lợi nhuận,<br>Và Làm Chủ Nền Móng Tự Do.')); ?></h1>

                <p class="hero-tagline">
                    <?php clv_e('hero_tagline', null, 'Hơn 15 năm kinh nghiệm. Đồng hành cùng chủ quán F&B trên mọi chặng đường phát triển.'); ?>
                </p>

                <div style="display:flex;gap:16px;flex-wrap:wrap;">
                    <a href="<?php clv_e('hero_cta_primary_url', null, '#services'); ?>"
                       class="btn-gold">
                        <?php clv_e('hero_cta_primary_label', null, 'Khám phá dịch vụ'); ?>
                    </a>
                    <a href="<?php echo esc_url(clv_field('hero_cta_secondary_url', null, home_url('/lien-he/'))); ?>"
                       class="btn-outline">
                        <?php clv_e('hero_cta_secondary_label', null, 'Tư vấn 1:1 miễn phí'); ?>
                    </a>
                </div>
            </div>

            <div class="hero-img-wrap" data-reveal>
                <div class="hero-bg-blob"></div>
                <?php clv_img_f('hero_image', null, 'dv3/hero-coach.png', 'Coach Loan Vũ', 'hero-img', 'loading="eager"'); ?>
            </div>

        </div>
    </section>


    <!-- ══════════════════════════════════════════════════════
         SECTION 2: SERVICES ECOSYSTEM
    ══════════════════════════════════════════════════════ -->
    <section id="services" class="home-section alt">
        <div class="container">

            <div class="section-title" data-reveal>
                <h2><?php clv_e('services_title', null, 'Hệ Sinh Thái Dịch Vụ'); ?></h2>
                <div class="home-divider"></div>
                <p><?php clv_e('services_subtitle', null, 'Lộ trình hoàn chỉnh được thiết kế để giải quyết chính xác bài toán của bạn ở từng giai đoạn phát triển.'); ?></p>
            </div>

            <div class="service-grid">
                <?php if (have_rows('services')) :
                    while (have_rows('services')) : the_row();
                    $color_class = clv_sub('service_color_class', 'c-p2p');
                    $svc_url     = clv_sub('service_url', home_url('/'));
                ?>
                <div class="srv-card <?php echo esc_attr($color_class); ?>" data-reveal>
                    <div class="srv-num"><?php echo esc_html(clv_sub('service_number', '01')); ?></div>
                    <h3><?php echo esc_html(clv_sub('service_name')); ?></h3>
                    <p><?php echo esc_html(clv_sub('service_description')); ?></p>
                    <a href="<?php echo esc_url($svc_url); ?>"
                       style="color:var(--color-accent);font-weight:600;">
                        Tìm hiểu chi tiết →
                    </a>
                </div>
                <?php endwhile; else : ?>
                <!-- Fallback: hardcoded 3 services -->
                <div class="srv-card c-p2p" data-reveal>
                    <div class="srv-num">01</div>
                    <h3>Passion to Profit</h3>
                    <p>Dành cho người chuẩn bị khởi nghiệp hoặc mới mở quán. Khoá học tập trung cấp tốc 2 ngày.</p>
                    <a href="<?php echo esc_url(home_url('/passion-to-profit/')); ?>" style="color:var(--c-dv1,#CC0000);font-weight:600;">Tìm hiểu chi tiết →</a>
                </div>
                <div class="srv-card c-b2f" data-reveal>
                    <div class="srv-num">02</div>
                    <h3>Business to Freedom</h3>
                    <p>Dành cho chủ quán muốn thoát khỏi vận hành 24/7. Chương trình nhóm thực chiến 10 tuần.</p>
                    <a href="<?php echo esc_url(home_url('/business-to-freedom/')); ?>" style="color:var(--c-dv2,#E87722);font-weight:600;">Tìm hiểu chi tiết →</a>
                </div>
                <div class="srv-card c-bm" data-reveal>
                    <div class="srv-num">03</div>
                    <h3>Business Mastery</h3>
                    <p>Coaching 1:1 cao cấp, giải quyết trực tiếp bài toán chiến lược mở rộng từ 6–12 tháng.</p>
                    <a href="<?php echo esc_url(home_url('/business-mastery/')); ?>" style="color:var(--c-dv3,#C9A84C);font-weight:600;">Tìm hiểu chi tiết →</a>
                </div>
                <?php endif; ?>
            </div>

        </div>
    </section>


    <!-- ══════════════════════════════════════════════════════
         SECTION 3: ABOUT COACH
    ══════════════════════════════════════════════════════ -->
    <section class="home-section">
        <div class="container">
            <div class="about-grid">

                <!-- Image -->
                <div class="about-img-wrap" data-reveal>
                    <?php clv_img_f('about_image', null, 'dv1/hero-coach.png', 'Coach Vũ Kiều Loan', 'about-img', 'loading="lazy"'); ?>
                    <span class="about-img-badge">
                        <?php clv_e('about_badge_image', null, 'ICF PCC Coach'); ?>
                    </span>
                </div>

                <!-- Content -->
                <div data-reveal>
                    <!-- Badges -->
                    <div class="about-badge-row">
                        <?php if (have_rows('about_badges')) :
                            while (have_rows('about_badges')) : the_row(); ?>
                            <span class="about-badge"><?php echo esc_html(clv_sub('badge_text')); ?></span>
                        <?php endwhile; else : ?>
                            <span class="about-badge">F&amp;B Coach</span>
                            <span class="about-badge">ICF PCC</span>
                            <span class="about-badge">Tác giả sách</span>
                            <span class="about-badge">Chủ nhà hàng</span>
                        <?php endif; ?>
                    </div>

                    <h2 class="about-name"><?php clv_e('about_name', null, 'Vũ Kiều Loan'); ?></h2>
                    <p class="about-title"><?php clv_e('about_title', null, 'Người đồng hành chiến lược cho chủ quán F&B Việt'); ?></p>

                    <div class="about-bio">
                        <?php clv_html('about_bio', null, 'Hơn 16 năm trong ngành F&B &amp; Hospitality tại Mỹ và Việt Nam.'); ?>
                    </div>

                    <!-- Stats -->
                    <div class="stat-grid">
                        <?php if (have_rows('about_stats')) :
                            while (have_rows('about_stats')) : the_row(); ?>
                            <div class="stat-card">
                                <div class="stat-num"><?php echo esc_html(clv_sub('stat_number')); ?></div>
                                <div class="stat-label"><?php echo esc_html(clv_sub('stat_label')); ?></div>
                            </div>
                        <?php endwhile; else : ?>
                            <div class="stat-card"><div class="stat-num">16+</div><div class="stat-label">Năm kinh nghiệm F&B</div></div>
                            <div class="stat-card"><div class="stat-num">50+</div><div class="stat-label">Chủ quán đồng hành</div></div>
                            <div class="stat-card"><div class="stat-num">1.000</div><div class="stat-label">Cuốn sách đã bán</div></div>
                            <div class="stat-card"><div class="stat-num">3</div><div class="stat-label">Chương trình Coaching</div></div>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- ══════════════════════════════════════════════════════
         SECTION 4: BOOK
    ══════════════════════════════════════════════════════ -->
    <section class="book-section">
        <div class="container book-grid">

            <div class="book-img-wrap" data-reveal>
                <?php
                $book_img = clv_field('book_image');
                if ($book_img) {
                    clv_img($book_img, 'Ánh Sáng Của Ước Mơ – Tác giả Vũ Kiều Loan', '', 'large',
                        'style="width:100%;max-width:300px;max-height:460px;object-fit:cover;object-position:top;border-radius:var(--radius-md);box-shadow:0 24px 60px rgba(0,0,0,0.5),0 0 40px rgba(201,168,76,0.1);display:block;margin:auto;" loading="lazy"');
                } else {
                    $fallback_book = clv_theme_img_url('home/book-mockup.png');
                    echo '<img src="' . esc_url($fallback_book) . '" alt="Ánh Sáng Của Ước Mơ" style="width:100%;max-width:300px;max-height:460px;object-fit:cover;object-position:top;border-radius:var(--radius-md);box-shadow:0 24px 60px rgba(0,0,0,0.5),0 0 40px rgba(201,168,76,0.1);display:block;margin:auto;" loading="lazy">';
                }
                ?>
            </div>

            <div data-reveal>
                <span style="font-size:var(--text-sm);color:var(--gold-accent);font-weight:600;letter-spacing:2px;text-transform:uppercase;">
                    <?php clv_e('book_eyebrow', null, 'Sách của Coach Loan Vũ'); ?>
                </span>
                <h2 style="font-size:clamp(1.75rem,3vw,2.5rem);margin:var(--space-2) 0 var(--space-4);color:#fff;font-family:var(--font-heading);">
                    <?php clv_e('book_title', null, 'Ánh Sáng Của Ước Mơ'); ?>
                </h2>
                <div style="font-size:var(--text-lg);line-height:1.6;color:#E2E8F0;margin-bottom:var(--space-4);">
                    <?php clv_html('book_description', null, 'Cuốn sách truyền cảm hứng về hành trình chuyển hoá từ người đi làm thuê đến người làm chủ nhà hàng.'); ?>
                </div>
                <p style="color:#94A3B8;margin-bottom:var(--space-6);">
                    <?php clv_html('book_highlight', null, 'Đã truyền cảm hứng cho hơn <strong>1.000 người trẻ</strong> trong hành trình khởi nghiệp F&B.'); ?>
                </p>
                <div style="display:flex;gap:16px;flex-wrap:wrap;">
                    <a href="<?php echo esc_url(clv_field('book_cta_buy_url', null, '#')); ?>" class="btn-gold">
                        <?php clv_e('book_cta_buy_label', null, 'Mua Sách Ngay'); ?>
                    </a>
                </div>
            </div>

        </div>
    </section>


    <!-- ══════════════════════════════════════════════════════
         SECTION 5: TESTIMONIALS
    ══════════════════════════════════════════════════════ -->
    <section class="home-section alt">
        <div class="container">

            <div class="section-title" data-reveal>
                <h2><?php clv_e('testimonials_title', null, 'Trải nghiệm chuyển hoá'); ?></h2>
                <div class="home-divider"></div>
                <p>Lắng nghe những học viên đã xây dựng thành công bộ quy trình chuyên nghiệp cho quán của họ.</p>
            </div>

            <div class="testi-grid">
                <?php
                // Default testimonials when ACF has no data
                $default_home_testis = [
                    [
                        'testi_quote'  => 'Mọi thứ không còn mơ hồ. Mình biết cái gì đang thiếu và cần thay đổi. Thay đổi đầu tiên là áp dụng các quy trình chuẩn cho quán.',
                        'testi_name'   => 'Cao Lan',
                        'testi_role'   => 'Chủ nhà hàng Việt ở Paris',
                        'testi_avatar' => clv_theme_img_url('dv2/t1-caolan.png'),
                    ],
                    [
                        'testi_quote'  => 'Bước tiến của em là vận hành được quán và để dành được lợi nhuận. Mọi thứ đang vận hành đúng như mong muốn và em rất tự hào.',
                        'testi_name'   => 'Thanh Nga',
                        'testi_role'   => 'Chủ quán trà tại Bảo Lộc',
                        'testi_avatar' => clv_theme_img_url('dv2/t1-thanhnga.png'),
                    ],
                    [
                        'testi_quote'  => 'Khoá học là bản đồ để dù mình đang làm gì cũng có thể đối chiếu. Dù kinh doanh bao lâu, mình vẫn cần soi lại để tìm hướng đi đúng.',
                        'testi_name'   => 'Phạm Hiếu',
                        'testi_role'   => 'Chủ cafe Việt ở Virginia, Mỹ',
                        'testi_avatar' => clv_theme_img_url('dv2/t1-phamhieu.png'),
                    ],
                ];
                $home_testis = get_field('testimonials') ?: $default_home_testis;
                foreach ($home_testis as $t) :
                    $av_val = $t['testi_avatar'] ?? '';
                    if (is_array($av_val)) {
                        $av_src = $av_val['url'] ?? '';
                    } elseif (is_numeric($av_val)) {
                        $av_src = wp_get_attachment_image_url((int) $av_val, 'clv-avatar') ?: wp_get_attachment_url((int) $av_val);
                    } else {
                        $av_src = $av_val ?: '';
                    }
                ?>
                <div class="testi-card" data-reveal>
                    <p>"<?php echo esc_html($t['testi_quote'] ?? ''); ?>"</p>
                    <div class="testi-author">
                        <?php if ($av_src): ?>
                        <img src="<?php echo esc_url($av_src); ?>" alt="<?php echo esc_attr($t['testi_name'] ?? ''); ?>" class="testi-avatar" loading="lazy">
                        <?php endif; ?>
                        <div>
                            <h4><?php echo esc_html($t['testi_name'] ?? ''); ?></h4>
                            <span><?php echo esc_html($t['testi_role'] ?? ''); ?></span>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

        </div>
    </section>


    <!-- ══════════════════════════════════════════════════════
         SECTION 6: SOCIAL CHANNELS
    ══════════════════════════════════════════════════════ -->
    <section class="home-section">
        <div class="container">

            <div class="section-title" data-reveal>
                <h2>Kết nối đa kênh</h2>
                <div class="home-divider"></div>
                <p>Theo dõi và gia nhập cộng đồng chung đam mê khởi nghiệp và vận hành thương hiệu F&B.</p>
            </div>

            <div class="eco-grid">
                <?php
                // Default channels when ACF has no data
                $default_channels = [
                    ['channel_icon' => '📘', 'channel_name' => 'Facebook',    'channel_url' => 'https://www.facebook.com/loanvuk', 'channel_description' => 'Cộng đồng hỗ trợ &amp; chia sẻ'],
                    ['channel_icon' => '📺', 'channel_name' => 'YouTube',     'channel_url' => 'https://www.youtube.com/@loanvuk',   'channel_description' => 'Nhận định &amp; hướng dẫn thực chiến'],
                    ['channel_icon' => '📧', 'channel_name' => 'Newsletter',  'channel_url' => '#',                                  'channel_description' => 'Insight kinh doanh qua Substack'],
                    ['channel_icon' => '🍽️', 'channel_name' => "S&L's Diner", 'channel_url' => '#',                                  'channel_description' => 'Cửa hàng thực chiến của Loan'],
                ];

                if (have_rows('channels')) :
                    while (have_rows('channels')) : the_row();
                        $ch_url = clv_sub('channel_url', '#');
                ?>
                <a href="<?php echo esc_url($ch_url); ?>" class="eco-card" data-reveal
                   <?php echo ($ch_url !== '#') ? 'target="_blank" rel="noopener"' : ''; ?>>
                    <div class="eco-icon"><?php echo esc_html(clv_sub('channel_icon')); ?></div>
                    <h3 style="color:#fff;"><?php echo esc_html(clv_sub('channel_name')); ?></h3>
                    <p style="color:#94A3B8;margin-top:var(--space-2);font-size:var(--text-sm);">
                        <?php echo esc_html(clv_sub('channel_description')); ?>
                    </p>
                </a>
                <?php endwhile;
                else:
                    foreach ($default_channels as $ch) :
                        $ch_url = $ch['channel_url'] ?? '#';
                ?>
                <a href="<?php echo esc_url($ch_url); ?>" class="eco-card" data-reveal
                   <?php echo ($ch_url !== '#') ? 'target="_blank" rel="noopener"' : ''; ?>>
                    <div class="eco-icon"><?php echo $ch['channel_icon']; ?></div>
                    <h3 style="color:#fff;"><?php echo esc_html($ch['channel_name']); ?></h3>
                    <p style="color:#94A3B8;margin-top:var(--space-2);font-size:var(--text-sm);">
                        <?php echo $ch['channel_description']; ?>
                    </p>
                </a>
                <?php endforeach;
                endif;
                ?>
            </div>

        </div>
    </section>

</main><!-- #main -->

<?php get_footer();
