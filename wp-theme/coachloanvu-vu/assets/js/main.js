/* main.js – Coach Loan Vũ WordPress Theme */

document.addEventListener('DOMContentLoaded', () => {

    // ── Mobile nav toggle ──────────────────────────────────
    const toggle   = document.querySelector('.nav-toggle');
    const navLinks = document.querySelector('.nav-links');

    if (toggle && navLinks) {
        toggle.addEventListener('click', () => {
            const isOpen = navLinks.classList.toggle('open');
            toggle.classList.toggle('open', isOpen);
            toggle.setAttribute('aria-expanded', String(isOpen));
        });

        // Close nav when a link is clicked (mobile)
        navLinks.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                navLinks.classList.remove('open');
                toggle.classList.remove('open');
                toggle.setAttribute('aria-expanded', 'false');
            });
        });
    }

    // ── Scroll reveal animation ────────────────────────────
    const revealElements = document.querySelectorAll('[data-reveal]');
    if (revealElements.length && 'IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

        revealElements.forEach(el => observer.observe(el));
    }

    // ── FAQ Accordion ──────────────────────────────────────
    document.querySelectorAll('.faq-q').forEach(btn => {
        btn.addEventListener('click', () => {
            const item = btn.closest('.faq-item');
            // Close other open items
            document.querySelectorAll('.faq-item.open').forEach(other => {
                if (other !== item) {
                    other.classList.remove('open');
                    other.querySelector('.faq-q')?.setAttribute('aria-expanded', 'false');
                }
            });
            // Toggle current
            const isOpen = item.classList.toggle('open');
            btn.setAttribute('aria-expanded', String(isOpen));
        });
    });

    // ── Countdown Timer (Dich Vu 1) ───────────────────────
    const cdTimer = document.getElementById('countdown-timer');
    const cdTarget = cdTimer?.dataset.target;

    if (cdTimer && cdTarget) {
        const targetDate = new Date(cdTarget).getTime();

        function updateCountdown() {
            const now      = Date.now();
            const distance = targetDate - now;

            if (distance < 0) {
                cdTimer.innerHTML = '<div style="color:var(--p2p-red,#E63946);font-weight:bold;font-size:1.2rem;">Khoá học đã bắt đầu!</div>';
                return;
            }

            const days    = Math.floor(distance / 86400000);
            const hours   = Math.floor((distance % 86400000) / 3600000);
            const minutes = Math.floor((distance % 3600000) / 60000);
            const seconds = Math.floor((distance % 60000) / 1000);

            const pad = n => String(n).padStart(2, '0');
            const set = (id, val) => { const el = document.getElementById(id); if (el) el.textContent = pad(val); };

            set('cd-days',  days);
            set('cd-hours', hours);
            set('cd-mins',  minutes);
            set('cd-secs',  seconds);
        }

        updateCountdown();
        setInterval(updateCountdown, 1000);
    }

});

// ── Scroll-to-top button ───────────────────────────────────
(function () {
    const btn = document.createElement('button');
    btn.innerHTML = '↑';
    btn.setAttribute('aria-label', 'Cuộn lên đầu trang');
    btn.style.cssText = [
        'position:fixed', 'bottom:80px', 'right:20px', 'z-index:99',
        'padding:12px 18px', 'background:var(--gold-accent,#C9A84C)', 'color:#0a0a0a',
        'border:none', 'border-radius:50%', 'font-size:20px', 'cursor:pointer',
        'opacity:0', 'visibility:hidden', 'transition:all 0.3s ease',
        'box-shadow:0 4px 10px rgba(0,0,0,0.3)'
    ].join(';');

    document.body.appendChild(btn);

    window.addEventListener('scroll', () => {
        const visible = window.scrollY > 400;
        btn.style.opacity     = visible ? '1' : '0';
        btn.style.visibility  = visible ? 'visible' : 'hidden';
    }, { passive: true });

    btn.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
})();
