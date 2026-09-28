// Portfolio Main JavaScript

document.addEventListener('DOMContentLoaded', () => {
    console.log('Portfolio site loaded');

    // Theme Toggle
    const themeToggle = document.getElementById('theme-toggle');
    const body = document.body;
    const icon = themeToggle.querySelector('i');

    // Check for saved theme
    const savedTheme = localStorage.getItem('theme') || 'dark';
    body.classList.remove('dark-mode', 'light-mode');
    body.classList.add(savedTheme + '-mode');
    updateIcon(savedTheme);

    if (themeToggle) {
        themeToggle.addEventListener('click', () => {
            if (body.classList.contains('dark-mode')) {
                body.classList.replace('dark-mode', 'light-mode');
                localStorage.setItem('theme', 'light');
                document.cookie = "theme=light; path=/; max-age=" + (86400 * 30);
                updateIcon('light');
            } else {
                body.classList.replace('light-mode', 'dark-mode');
                localStorage.setItem('theme', 'dark');
                document.cookie = "theme=dark; path=/; max-age=" + (86400 * 30);
                updateIcon('dark');
            }
        });
    }

    function updateIcon(theme) {
        if (theme === 'dark') {
            icon.classList.replace('fa-sun', 'fa-moon');
        } else {
            icon.classList.replace('fa-moon', 'fa-sun');
        }
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
