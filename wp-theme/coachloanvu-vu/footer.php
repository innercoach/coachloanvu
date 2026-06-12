    </main><!-- #main -->

    <!-- Footer -->
    <footer class="site-footer" role="contentinfo">
        <div class="container">
            <div class="footer-inner" style="border-top: 1px solid rgba(255,255,255,0.08); padding-top: var(--space-8);">

                <!-- Brand -->
                <div>
                    <div class="footer-logo">
                        <?php echo wp_kses_post(clv_option('global_logo_text', 'Coach <span>Loan Vu</span>')); ?>
                    </div>
                    <p class="footer-tagline" style="max-width:320px; line-height:1.6; opacity:0.8;">
                        <?php echo esc_html(clv_option('global_footer_tagline', 'Vũ Kiều Loan là F&B Startup Coach chuyên nghiệp (ICF PCC) với 16 năm kinh nghiệm tại Mỹ và Việt Nam.')); ?>
                    </p>
                </div>

                <!-- Service Links -->
                <div>
                    <h4 class="footer-links-title">Dịch vụ</h4>
                    <ul class="footer-links">
                        <?php
                        $services = [
                            ['label' => 'Passion to Profit',  'slug' => 'passion-to-profit'],
                            ['label' => 'Business to Freedom','slug' => 'business-to-freedom'],
                            ['label' => 'Business Mastery',   'slug' => 'business-mastery'],
                        ];
                        foreach ($services as $s) :
                        ?>
                        <li><a href="<?php echo esc_url(home_url('/' . $s['slug'] . '/')); ?>">
                            <?php echo esc_html($s['label']); ?>
                        </a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Contact Links -->
                <div>
                    <h4 class="footer-links-title">Liên hệ</h4>
                    <ul class="footer-links">
                        <?php
                        $email = clv_option('global_social_email', 'loanvuk@gmail.com');
                        $fb    = clv_option('global_social_facebook', 'https://www.facebook.com/loanvuk');
                        $ig    = clv_option('global_social_instagram', 'https://www.instagram.com/loanvuk');
                        ?>
                        <li><a href="mailto:<?php echo sanitize_email($email); ?>"><?php echo esc_html($email); ?></a></li>
                        <li><a href="https://www.vukieuloan.com" target="_blank" rel="noopener">vukieuloan.com</a></li>
                        <?php if ($fb): ?>
                        <li><a href="<?php echo esc_url($fb); ?>" target="_blank" rel="noopener">Facebook</a></li>
                        <?php endif; ?>
                        <?php if ($ig): ?>
                        <li><a href="<?php echo esc_url($ig); ?>" target="_blank" rel="noopener">Instagram</a></li>
                        <?php endif; ?>
                    </ul>
                </div>

            </div>

            <div class="footer-bottom">
                <?php echo esc_html(clv_option('global_footer_copyright', '© ' . date('Y') . ' Coach Loan Vu. All rights reserved.')); ?>
            </div>
        </div>
    </footer><!-- .site-footer -->

    <?php wp_footer(); ?>
</body>
</html>
