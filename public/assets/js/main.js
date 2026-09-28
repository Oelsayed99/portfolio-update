// Portfolio Main JavaScript

document.addEventListener('DOMContentLoaded', () => {
    console.log('Portfolio site loaded');

    // Theme: preference is system (default) | light | dark, stored in the "theme" cookie.
    const themeToggle = document.getElementById('theme-toggle');
    const body = document.body;
    const systemLight = matchMedia('(prefers-color-scheme: light)');
    const order = ['system', 'light', 'dark'];
    const icons = { system: 'fa-circle-half-stroke', light: 'fa-sun', dark: 'fa-moon' };
    let pref = body.dataset.themePref || 'system';

    function applyTheme() {
        const mode = pref === 'system' ? (systemLight.matches ? 'light' : 'dark') : pref;
        body.classList.remove('dark-mode', 'light-mode');
        body.classList.add(mode + '-mode');
        if (themeToggle) {
            themeToggle.querySelector('i').className = 'fas ' + icons[pref];
            const label = themeToggle.dataset['label' + pref[0].toUpperCase() + pref.slice(1)] || pref;
            themeToggle.title = label;
            themeToggle.setAttribute('aria-label', label);
        }
    }

    applyTheme();
    systemLight.addEventListener('change', () => { if (pref === 'system') applyTheme(); });
    if (themeToggle) {
        themeToggle.addEventListener('click', () => {
            pref = order[(order.indexOf(pref) + 1) % order.length];
            body.dataset.themePref = pref;
            document.cookie = 'theme=' + pref + '; path=/; max-age=' + (86400 * 365) + '; SameSite=Lax';
            applyTheme();
        });
    }

    // Mobile Menu Toggle
    const mobileMenu = document.getElementById('mobile-menu');
    const navLinks = document.querySelector('.nav-links');

    if (mobileMenu) {
        mobileMenu.addEventListener('click', () => {
            mobileMenu.classList.toggle('active');
            navLinks.classList.toggle('active');
        });
    }

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    // Simple scroll animation for cards
    const cards = document.querySelectorAll('.card');
    const observerOptions = {
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    cards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'all 0.6s ease-out';
        observer.observe(card);
    });
});

// Scroll reveal for any `.reveal` element; also counts up a `[data-count]` number inside it.
// Content is only hidden once this runs (html.js-reveal), so it stays visible without JS.
document.addEventListener('DOMContentLoaded', () => {
    const items = document.querySelectorAll('.reveal');
    if (!items.length || !('IntersectionObserver' in window)) return;
    document.documentElement.classList.add('js-reveal');
    const reduce = matchMedia('(prefers-reduced-motion: reduce)').matches;
    const io = new IntersectionObserver(entries => entries.forEach(e => {
        if (!e.isIntersecting) return;
        e.target.classList.add('is-visible');
        const num = e.target.querySelector('[data-count]');
        if (num && !reduce) {
            const end = +num.dataset.count, start = end > 1000 ? end - 12 : 0, t0 = performance.now();
            const tick = now => {
                const k = Math.min(1, (now - t0) / 1200);
                num.textContent = Math.round(start + (end - start) * (1 - Math.pow(1 - k, 3)));
                if (k < 1) requestAnimationFrame(tick);
            };
            requestAnimationFrame(tick);
        }
        io.unobserve(e.target);
    }), { threshold: 0.15 });
    items.forEach(el => io.observe(el));
});
