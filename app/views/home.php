<?php include PARTIAL_PATH . '/header.php';
$lang = get_current_lang();
$tiles = [
    ['href' => '/about',    'label' => 'nav_about',    'img' => '/assets/images/home/about.webp'],
    ['href' => '/projects', 'label' => 'nav_projects', 'img' => '/assets/images/home/projects.webp'],
    ['href' => '/services', 'label' => 'nav_services', 'img' => '/assets/images/home/services.webp'],
    ['href' => '/blog',     'label' => 'nav_blog',     'img' => '/assets/images/home/journey.webp'],
];
?>

<!-- ── HERO SECTION ── -->
<section class="hero-section" id="hero">
    <div class="container hero-container">
        <aside class="social-sidebar" id="social-sidebar">
            <a href="https://<?= translate('contact_github') ?>" target="_blank" aria-label="GitHub"><i class="fab fa-github"></i></a>
            <a href="https://<?= translate('contact_linkedin') ?>" target="_blank" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
        </aside>

        <div class="hero-content">
            <span class="hero-chip"><?= t('hero_title') ?></span>
            <p class="hero-greeting"><?= t('hero_hello') ?> <?= t('hero_name') ?></p>
            <h1 class="hero-name"><?= t('hero_headline') ?></h1>
            <p class="hero-desc"><?= t('hero_desc') ?></p>
            <div class="hero-btns">
                <a href="/contact" class="btn btn-primary" id="btn-hire"><?= t('btn_hire') ?></a>
                <a href="/projects" class="btn btn-outline" id="btn-projects"><?= t('btn_projects') ?></a>
            </div>
        </div>
        <div class="hero-image-container">
            <div class="purple-glow"></div>
            <img src="/assets/images/hero_portrait.webp" alt="<?= translate('hero_name') ?>" class="hero-img" width="1100" height="1467">
        </div>
    </div>
</section>

<!-- ── EXPLORE TILES ── -->
<section class="explore">
    <div class="container">
        <h2 class="explore-heading"><?= t('home_explore') ?></h2>
        <div class="explore-grid">
            <?php foreach ($tiles as $tile): ?>
            <a href="<?= $tile['href'] ?>" class="explore-tile" style="background-image:url('<?= $tile['img'] ?>')">
                <span class="explore-label"><?= t($tile['label']) ?></span>
                <span class="explore-go" aria-hidden="true"><i class="fas fa-arrow-<?= $lang === 'ar' ? 'left' : 'right' ?>"></i></span>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ── CTA ── -->
<section class="home-cta">
    <div class="container">
        <div class="home-cta-card">
            <h2><?= t('home_cta') ?></h2>
            <a href="/contact" class="btn btn-primary"><?= t('btn_hire') ?></a>
        </div>
    </div>
</section>

<?php include PARTIAL_PATH . '/footer.php'; ?>
