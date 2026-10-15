<?php include PARTIAL_PATH . '/header.php'; ?>

<section class="svc-hero" style="min-height: 60vh; display: flex; align-items: center;">
    <div class="container" style="text-align: center;">
        <span class="hero-chip">404</span>
        <h1 class="svc-hero-title"><?= t('notfound_title') ?></h1>
        <p class="about-lead" style="margin: 0 auto 2rem;"><?= t('notfound_text') ?></p>
        <div class="hero-btns" style="justify-content: center;">
            <a href="/" class="btn btn-primary"><?= t('nav_home') ?></a>
            <a href="/projects" class="btn btn-outline"><?= t('nav_projects') ?></a>
        </div>
    </div>
</section>

<?php include PARTIAL_PATH . '/footer.php'; ?>
