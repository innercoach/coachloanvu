<?php
/**
 * Template Name: Lien He – Contact
 *
 * page-lien-he.php
 * All content managed via ACF field group "Contact Page".
 */
get_header();
$pid = get_the_ID();
?>

<style>
.contact-page-hero { background:linear-gradient(135deg,var(--color-primary) 0%,var(--color-primary-dark) 100%); padding-block:var(--space-16); text-align:center; }
.contact-page-hero h1 { color:var(--color-accent); }
.contact-page-hero p { color:rgba(255,255,255,0.85); font-size:var(--text-lg); }
.contact-layout { display:grid; grid-template-columns:1fr 1.4fr; gap:var(--space-12); align-items:start; padding-block:var(--space-20); }
.contact-info-card { background:var(--color-white); border:1px solid var(--color-border); border-radius:var(--radius-lg); padding:var(--space-8); box-shadow:var(--shadow-sm); }
.contact-info-card h2 { font-size:var(--text-2xl); margin-bottom:var(--space-4); }
.info-list { margin-top:var(--space-6); }
.info-item { display:flex; gap:var(--space-4); align-items:flex-start; padding:var(--space-4) 0; border-bottom:1px solid var(--color-border); }
.info-item:last-child { border-bottom:none; }
.info-icon { width:44px; height:44px; background:rgba(141,27,10,0.08); border-radius:var(--radius-md); display:flex; align-items:center; justify-content:center; flex-shrink:0; color:var(--color-primary); font-size:1.2rem; }
.info-label { font-weight:600; color:var(--color-fg); margin-bottom:var(--space-1); font-size:var(--text-sm); }
.info-value { color:var(--color-fg-muted); font-size:var(--text-sm); margin-bottom:0; }
.contact-form-card { background:var(--color-white); border:1px solid var(--color-border); border-radius:var(--radius-lg); padding:var(--space-8); box-shadow:var(--shadow-sm); }
.contact-form-card h2 { font-size:var(--text-2xl); margin-bottom:var(--space-2); }
.form-lead { font-size:var(--text-sm); color:var(--color-fg-muted); margin-bottom:var(--space-6); }
.form-row { display:grid; grid-template-columns:1fr 1fr; gap:var(--space-4); }
.form-group { display:flex; flex-direction:column; gap:var(--space-2); margin-bottom:var(--space-4); }
label { font-size:var(--text-sm); font-weight:600; color:var(--color-fg); }
label .required { color:var(--color-primary); margin-left:2px; }
input, textarea, select { width:100%; padding:var(--space-3) var(--space-4); font-family:var(--font-body); font-size:var(--text-base); color:var(--color-fg); background:var(--color-bg); border:1.5px solid var(--color-border); border-radius:var(--radius-md); transition:border-color var(--transition),box-shadow var(--transition); outline:none; }
input:focus, textarea:focus, select:focus { border-color:var(--color-primary); box-shadow:0 0 0 3px rgba(141,27,10,0.08); }
textarea { resize:vertical; min-height:130px; }
.form-submit { margin-top:var(--space-2); }
.form-submit .btn { width:100%; justify-content:center; padding-block:var(--space-4); font-size:var(--text-lg); }
.form-note { text-align:center; font-size:var(--text-xs); color:var(--color-fg-muted); margin-top:var(--space-3); }
@media(max-width:768px) { .contact-layout { grid-template-columns:1fr; } .form-row { grid-template-columns:1fr; } }
</style>

<main id="main" role="main">

    <!-- Hero Banner -->
    <section class="contact-page-hero">
        <div class="container">
            <span class="badge" style="background:rgba(255,189,89,0.2);color:var(--color-accent);">Liên hệ</span>
            <h1 style="margin-top:1rem;"><?php echo esc_html(clv_field('contact_title', $pid, 'Hãy kết nối cùng tôi')); ?></h1>
            <p><?php echo esc_html(clv_field('contact_subtitle', $pid, 'Buổi tư vấn đầu tiên hoàn toàn miễn phí — không có cam kết.')); ?></p>
        </div>
    </section>


    <section>
        <div class="container">
            <div class="contact-layout">

                <!-- Info Column -->
                <div class="contact-info-card">
                    <span class="badge">Thông tin</span>
                    <h2 style="margin-top:1rem;">Tôi muốn lắng nghe bạn</h2>
                    <div class="divider"></div>
                    <p style="margin-top:1rem;">
                        <?php echo esc_html(clv_field('contact_intro', $pid, 'Đừng ngần ngại liên hệ qua bất kỳ kênh nào bạn thấy tiện nhất. Tôi sẽ phản hồi trong vòng 24 giờ.')); ?>
                    </p>

                    <div class="info-list">

                        <?php
                        $email   = clv_field('contact_email', $pid, clv_option('global_social_email', 'loanvuk@gmail.com'));
                        $phone   = clv_field('contact_phone', $pid, '');
                        $fb_url  = clv_field('contact_facebook_url', $pid, clv_option('global_social_facebook', '#'));
                        $hours   = clv_field('contact_hours', $pid, 'Thứ 2 – Thứ 7, 8:00 – 21:00');
                        ?>

                        <!-- Email -->
                        <div class="info-item">
                            <div class="info-icon" aria-hidden="true">✉️</div>
                            <div>
                                <p class="info-label">Email</p>
                                <p class="info-value"><a href="mailto:<?php echo sanitize_email($email); ?>" style="color:var(--color-primary);"><?php echo esc_html($email); ?></a></p>
                            </div>
                        </div>

                        <!-- Phone -->
                        <?php if ($phone): ?>
                        <div class="info-item">
                            <div class="info-icon" aria-hidden="true">📞</div>
                            <div>
                                <p class="info-label">Số điện thoại</p>
                                <p class="info-value"><a href="tel:<?php echo esc_attr(preg_replace('/\s/', '', $phone)); ?>" style="color:var(--color-primary);"><?php echo esc_html($phone); ?></a></p>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- Facebook -->
                        <div class="info-item">
                            <div class="info-icon" aria-hidden="true">📘</div>
                            <div>
                                <p class="info-label">Facebook</p>
                                <p class="info-value"><a href="<?php echo esc_url($fb_url); ?>" target="_blank" rel="noopener" style="color:var(--color-primary);">/CoachLoanVu</a></p>
                            </div>
                        </div>

                        <!-- Hours -->
                        <div class="info-item">
                            <div class="info-icon" aria-hidden="true">🕐</div>
                            <div>
                                <p class="info-label">Giờ làm việc</p>
                                <p class="info-value"><?php echo esc_html($hours); ?></p>
                            </div>
                        </div>

                    </div>
                </div>


                <!-- Form Column -->
                <div class="contact-form-card">
                    <span class="badge">Gửi tin nhắn</span>
                    <h2 style="margin-top:1rem;"><?php echo esc_html(clv_field('contact_form_title', $pid, 'Đặt lịch tư vấn miễn phí')); ?></h2>
                    <p class="form-lead">Điền thông tin bên dưới và tôi sẽ liên hệ lại với bạn sớm nhất có thể.</p>

                    <?php
                    // If Contact Form 7 form ID is set, use its shortcode
                    $cf7_id = clv_field('contact_form_id', $pid);
                    if ($cf7_id && function_exists('wpcf7_contact_form')) :
                        echo do_shortcode('[contact-form-7 id="' . intval($cf7_id) . '" title="Contact"]');
                    else :
                    // Fallback native HTML form (submissions handled manually or via another plugin)
                    ?>
                    <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST" novalidate id="contact-form">
                        <?php wp_nonce_field('clv_contact_form', 'clv_nonce'); ?>
                        <input type="hidden" name="action" value="clv_contact">

                        <div class="form-row">
                            <div class="form-group">
                                <label for="contact-name">Họ và tên <span class="required" aria-hidden="true">*</span></label>
                                <input type="text" id="contact-name" name="name" placeholder="Nguyễn Văn A" autocomplete="name" required>
                            </div>
                            <div class="form-group">
                                <label for="contact-email">Email <span class="required" aria-hidden="true">*</span></label>
                                <input type="email" id="contact-email" name="email" placeholder="example@email.com" autocomplete="email" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="contact-phone">Số điện thoại</label>
                            <input type="tel" id="contact-phone" name="phone" placeholder="0901 234 567" autocomplete="tel">
                        </div>

                        <div class="form-group">
                            <label for="contact-service">Dịch vụ quan tâm</label>
                            <select id="contact-service" name="service">
                                <option value="">-- Chọn dịch vụ --</option>
                                <option value="dv1">Passion to Profit</option>
                                <option value="dv2">Business to Freedom</option>
                                <option value="dv3">Business Mastery</option>
                                <option value="other">Khác / Chưa chắc</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="contact-message">Lời nhắn <span class="required" aria-hidden="true">*</span></label>
                            <textarea id="contact-message" name="message" placeholder="Chia sẻ với tôi về mục tiêu hoặc vấn đề bạn muốn giải quyết..." required></textarea>
                        </div>

                        <div class="form-submit">
                            <button type="submit" class="btn btn-primary">Gửi tin nhắn</button>
                        </div>
                        <p class="form-note">Tôi sẽ phản hồi trong vòng 24 giờ. Thông tin của bạn được bảo mật tuyệt đối.</p>
                    </form>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </section>

</main><!-- #main -->

<?php get_footer(); ?>
