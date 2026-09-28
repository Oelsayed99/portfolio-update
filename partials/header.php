<!DOCTYPE html>
<html lang="<?= get_current_lang() ?>" dir="<?= is_rtl() ? 'rtl' : 'ltr' ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Omar Elsayed — Software Engineer & Full-Stack Developer. Creating innovative and scalable web applications.">
    <title><?= translate($title_key ?? 'nav_home') ?> | <?= translate('hero_name') ?></title>
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="manifest" href="/site.webmanifest">
    <meta property="og:image" content="<?= (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http') . '://' . htmlspecialchars($_SERVER['HTTP_HOST'] ?? 'elsayedomar.com') ?>/assets/images/brand/og-image.jpg">
    <meta name="twitter:card" content="summary_large_image">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Space+Grotesk:wght@500;700&family=Noto+Kufi+Arabic:wght@400;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="/assets/css/style.css?v=<?= filemtime(BASE_PATH . '/public/assets/css/style.css') ?>">
    
    <?php if (is_editor_mode()): ?>
        <!-- Admin Panel Styles -->
        <link rel="stylesheet" href="/assets/css/admin.css">
    <?php endif; ?>

</head>
<?php $themePref = in_array($_COOKIE['theme'] ?? '', ['light', 'dark', 'system'], true) ? $_COOKIE['theme'] : 'system'; ?>
<body class="<?= $themePref === 'light' ? 'light' : 'dark' ?>-mode" data-theme-pref="<?= $themePref ?>">
<script>
// "system" follows the device; resolve it before anything paints to avoid a flash
if (document.body.dataset.themePref === 'system' && matchMedia('(prefers-color-scheme: light)').matches) {
    document.body.classList.replace('dark-mode', 'light-mode');
}
</script>
    <header id="site-header">
        <nav class="container">
            <div class="logo">
                <a href="/" class="logo-link" aria-label="<?= htmlspecialchars(translate('hero_name')) ?>"><img src="/assets/images/brand/logo-icon.webp" alt="<?= htmlspecialchars(translate('hero_name')) ?>" class="logo-icon" width="1200" height="487"></a>
            </div>
            
            <ul class="nav-links" id="nav-links">
                <li><a href="/" class="<?= ($active_page === 'home') ? 'active' : ''; ?>"><?= t('nav_home') ?></a></li>
                <li><a href="/projects" class="<?= ($active_page === 'projects') ? 'active' : ''; ?>"><?= t('nav_projects') ?></a></li>
                <li><a href="/about" class="<?= ($active_page === 'about') ? 'active' : ''; ?>"><?= t('nav_about') ?></a></li>
                <li><a href="/services" class="<?= ($active_page === 'services') ? 'active' : ''; ?>"><?= t('nav_services') ?></a></li>
                <li><a href="/blog" class="<?= ($active_page === 'blog') ? 'active' : ''; ?>"><?= t('nav_blog') ?></a></li>
                <li><a href="/contact" class="<?= ($active_page === 'contact') ? 'active' : ''; ?>"><?= t('nav_contact') ?></a></li>
            </ul>

            <div class="header-actions">
                <!-- Theme Toggle -->
                <button id="theme-toggle" class="icon-btn"
                        data-label-system="<?= htmlspecialchars(translate('theme_system')) ?>"
                        data-label-light="<?= htmlspecialchars(translate('theme_light')) ?>"
                        data-label-dark="<?= htmlspecialchars(translate('theme_dark')) ?>">
                    <i class="fas fa-circle-half-stroke"></i>
                </button>
                
                <!-- Language Switcher -->
                <div class="lang-switcher">
                    <?php if (get_current_lang() === 'en'): ?>
                        <a href="/lang?lang=ar" class="lang-link" id="lang-switch">العربية</a>
                    <?php else: ?>
                        <a href="/lang?lang=en" class="lang-link" id="lang-switch">English</a>
                    <?php endif; ?>
                </div>

                <!-- Mobile Menu Toggle -->
                <div class="menu-toggle" id="mobile-menu" aria-label="Toggle menu">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
            </div>
        </nav>
    </header>

    <main>
