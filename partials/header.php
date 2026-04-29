<!DOCTYPE html>
<html lang="<?= get_current_lang() ?>" dir="<?= is_rtl() ? 'rtl' : 'ltr' ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Omar Elsayed — Software Engineer & Full-Stack Developer. Creating innovative and scalable web applications.">
    <title><?= translate($title_key ?? 'nav_home') ?> | <?= translate('hero_name') ?></title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Actor&family=Handjet:wght@100..900&family=Noto+Kufi+Arabic:wght@100..900&family=Press+Start+2P&display=swap" rel="stylesheet">
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="/assets/css/style.css">
    
    <?php if (isset($_SESSION['admin_user_id']) && isset($_GET['admin_editor'])): ?>
        <!-- Admin Panel Styles -->
        <link rel="stylesheet" href="/assets/css/admin.css">
    <?php endif; ?>
</head>
<body class="<?= $_COOKIE['theme'] ?? 'dark' ?>-mode">
    <header id="site-header">
        <nav class="container">
            <div class="logo">
                <a href="/"><?= translate('hero_name') ?></a>
            </div>
            
            <ul class="nav-links" id="nav-links">
                <li><a href="/" class="<?= ($active_page === 'home') ? 'active' : ''; ?>"><?= t('nav_home') ?></a></li>
                <li><a href="/projects" class="<?= ($active_page === 'projects') ? 'active' : ''; ?>"><?= t('nav_projects') ?></a></li>
                <li><a href="/about" class="<?= ($active_page === 'about') ? 'active' : ''; ?>"><?= t('nav_about') ?></a></li>
                <li><a href="/blog" class="<?= ($active_page === 'blog') ? 'active' : ''; ?>"><?= t('nav_blog') ?></a></li>
                <li><a href="/contact" class="<?= ($active_page === 'contact') ? 'active' : ''; ?>"><?= t('nav_contact') ?></a></li>
            </ul>

            <div class="header-actions">
                <!-- Theme Toggle -->
                <button id="theme-toggle" class="icon-btn" aria-label="Toggle theme">
                    <i class="fas fa-moon"></i>
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
