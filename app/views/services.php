<?php
include PARTIAL_PATH . '/header.php';
// All copy lives in translations (svc_*), so it is editable in the Visual Editor.
$ar = get_current_lang() === 'ar';
$services = ['ai' => 'robot', 'web' => 'code', 'bilingual' => 'language', 'data' => 'database', 'maintenance' => 'screwdriver-wrench', 'hosting' => 'server'];
$steps = [1 => 'magnifying-glass', 2 => 'compass-drafting', 3 => 'code', 4 => 'rocket', 5 => 'life-ring'];
?>

<!-- ── HERO ── -->
<section class="svc-hero">
    <div class="container svc-hero-grid">
        <div class="reveal">
            <span class="hero-chip"><?= t('svc_heading') ?></span>
            <h1 class="svc-hero-title"><?= t('svc_hero_title') ?></h1>
            <p class="about-lead"><?= t('svc_subtitle') ?></p>
            <div class="hero-btns">
                <a href="/contact" class="btn btn-primary"><?= t('svc_start') ?></a>
                <a href="/projects" class="btn btn-outline"><?= t('btn_projects') ?></a>
            </div>
        </div>
        <div class="svc-hero-art reveal">
            <img src="/assets/images/home/services.webp" alt="" width="1200" height="900">
        </div>
    </div>
</section>

<div class="container">
    <!-- ── SERVICES ── -->
    <section class="about-block">
        <h2 class="about-block-title reveal"><?= t('svc_what_title') ?></h2>
        <div class="svc-grid">
            <?php foreach ($services as $key => $icon): ?>
                <article class="svc-card reveal">
                    <span class="project-card-icon"><i class="fas fa-<?= $icon ?>"></i></span>
                    <h3><?= t("svc_{$key}_title") ?></h3>
                    <p><?= t("svc_{$key}_text") ?></p>
                    <details class="svc-more">
                        <summary><?= t('svc_included') ?> <i class="fas fa-chevron-down"></i></summary>
                        <ul class="svc-list"><?= t_lines("svc_{$key}_includes", 'li') ?></ul>
                    </details>
                </article>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- ── PROCESS ── -->
    <section class="about-block">
        <h2 class="about-block-title reveal"><?= t('svc_process_title') ?></h2>
        <ol class="svc-steps">
            <?php foreach ($steps as $n => $icon): ?>
                <li class="svc-step reveal" style="--i: <?= $n ?>">
                    <span class="svc-step-num"><i class="fas fa-<?= $icon ?>"></i></span>
                    <span class="svc-step-label"><?= sprintf('%02d', $n) ?></span>
                    <h3><?= t("svc_step{$n}_title") ?></h3>
                    <p><?= t("svc_step{$n}_text") ?></p>
                </li>
            <?php endforeach; ?>
        </ol>
    </section>

    <!-- ── WHY ME ── -->
    <section class="about-block svc-why">
        <div class="svc-why-art reveal">
            <img src="/assets/images/home/about.webp" alt="" loading="lazy" width="1200" height="900">
        </div>
        <div class="reveal">
            <h2 class="about-block-title"><?= t('svc_why_title') ?></h2>
            <?php for ($n = 1; $n <= 3; $n++): ?>
                <div class="svc-why-item">
                    <i class="fas fa-circle-check"></i>
                    <div>
                        <h3><?= t("svc_why{$n}_title") ?></h3>
                        <p><?= t("svc_why{$n}_text") ?></p>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </section>

    <!-- ── FAQ ── -->
    <section class="about-block">
        <h2 class="about-block-title reveal"><?= t('svc_faq_title') ?></h2>
        <div class="exp-list">
            <?php for ($n = 1; $n <= 4; $n++): ?>
                <details class="exp-item reveal">
                    <summary>
                        <span class="exp-head"><span class="exp-role"><?= t("svc_faq{$n}_q") ?></span></span>
                        <i class="fas fa-chevron-down exp-chevron"></i>
                    </summary>
                    <p class="svc-faq-a"><?= t("svc_faq{$n}_a") ?></p>
                </details>
            <?php endfor; ?>
        </div>
    </section>

    <!-- ── CTA ── -->
    <section class="about-block svc-cta-wrap">
        <div class="home-cta-card reveal">
            <h2><?= t('svc_cta') ?></h2>
            <a href="/contact" class="btn btn-primary"><?= t('svc_start') ?> <i class="fas fa-arrow-<?= $ar ? 'left' : 'right' ?>" style="margin-inline-start:.5rem"></i></a>
        </div>
    </section>
</div>

<?php include PARTIAL_PATH . '/footer.php'; ?>
