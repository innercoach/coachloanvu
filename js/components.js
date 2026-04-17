class SiteHeader extends HTMLElement {
    connectedCallback() {
        const activePage = window.location.pathname.split("/").pop() || "index.html";
        
        this.innerHTML = `
        <header class="site-header">
            <div class="container nav">
                <a href="index.html" class="nav-logo">Coach <span>Loan Vu</span></a>
                <button class="nav-toggle" aria-label="Toggle navigation">
                    <span></span><span></span><span></span>
                </button>
                <nav class="nav-links">
                    <a href="index.html" class="${activePage === 'index.html' ? 'active' : ''}">Trang chủ</a>
                    <a href="index.html#services">Dịch vụ</a>
                    <a href="dich-vu-1.html" class="${activePage === 'dich-vu-1.html' ? 'active' : ''}">Passion to Profit</a>
                    <a href="dich-vu-2.html" class="${activePage === 'dich-vu-2.html' ? 'active' : ''}">Business to Freedom</a>
                    <a href="dich-vu-3.html" class="${activePage === 'dich-vu-3.html' ? 'active' : ''}">Business Mastery</a>
                    <a href="lien-he.html" class="btn btn-primary" style="background:var(--gold-accent, #C9A84C); color:#000;">Thảo luận chiến lược</a>
                </nav>
            </div>
        </header>
        `;
    }
}
customElements.define('site-header', SiteHeader);

class SiteFooter extends HTMLElement {
    connectedCallback() {
        this.innerHTML = `
        <footer class="site-footer" style="margin-top:0;">
            <div class="container">
                <div class="footer-inner" style="border-top: 1px solid var(--home-border, rgba(255,255,255,0.08)); padding-top: var(--space-8);">
                    <div>
                        <div class="footer-logo">Coach <span>Loan Vu</span></div>
                        <p class="footer-tagline" style="max-width:320px; line-height:1.6; opacity:0.8;">Vũ Kiều Loan là F&B Startup Coach chuyên nghiệp (ICF PCC) với 16 năm kinh nghiệm tại Mỹ và Việt Nam. CEO S&L's Diner, đồng hành cùng chủ quán xây dựng kinh doanh bền vững.</p>
                    </div>
                    <div>
                        <h4 class="footer-links-title">Dịch vụ</h4>
                        <ul class="footer-links">
                            <li><a href="dich-vu-1.html">Passion to Profit</a></li>
                            <li><a href="dich-vu-2.html">Business to Freedom</a></li>
                            <li><a href="dich-vu-3.html">Business Mastery</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="footer-links-title">Liên hệ</h4>
                        <ul class="footer-links">
                            <li><a href="mailto:loanvuk@gmail.com">loanvuk@gmail.com</a></li>
                            <li><a href="https://www.vukieuloan.com" target="_blank" rel="noopener">vukieuloan.com</a></li>
                            <li><a href="https://www.facebook.com/loanvuk" target="_blank" rel="noopener">Facebook</a></li>
                            <li><a href="https://www.instagram.com/loanvuk" target="_blank" rel="noopener">Instagram</a></li>
                        </ul>
                    </div>
                </div>
                <div class="footer-bottom">
                    &copy; 2026 Coach Loan Vu. All rights reserved.
                </div>
            </div>
        </footer>
        `;
    }
}
customElements.define('site-footer', SiteFooter);
