<?php include '../partials/header.php'; ?>

<!-- ── HERO SECTION ── -->
<section class="hero-section" id="hero">
    <div class="container hero-container">
        <aside class="social-sidebar" id="social-sidebar">
            <a href="https://github.com/omarelsayed" target="_blank" aria-label="GitHub"><i class="fab fa-github"></i></a>
            <a href="https://linkedin.com/in/omarelsayed" target="_blank" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
        </aside>
        <div class="hero-content">
            <h1 class="hero-name">
                <span class="hero-greeting"><?= t('hero_hello') ?></span>
                <br>
                <?= str_replace(' ', '<br>', translate('hero_name')) ?>
            </h1>
            <h3 class="hero-title"><?= t('hero_title') ?></h3>
            <p class="hero-desc"><?= t('hero_desc') ?></p>
            <div class="hero-btns">
                <a href="/contact" class="btn btn-primary" id="btn-hire"><?= t('btn_hire') ?></a>
                <a href="/projects" class="btn btn-outline" id="btn-projects"><?= t('btn_projects') ?></a>
            </div>
        </div>
        <div class="hero-image-container">
            <div class="purple-glow"></div>
            <img src="/assets/images/hero_portrait.png" alt="<?= translate('hero_name') ?>" class="hero-img">
        </div>
    </div>
    <div>
        
    </div>
</section>

<?php include '../partials/footer.php'; ?>
