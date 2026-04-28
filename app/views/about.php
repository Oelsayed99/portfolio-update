<?php include '../partials/header.php'; ?>

<!-- ── ABOUT HERO ── -->
<section class="about-hero" id="about-hero">
    <div class="container about-hero-container">
        <div class="about-hero-content">
            <h1 class="about-heading"><?= translate('about_heading') ?></h1>
            <p class="about-subtitle accent-text"><?= translate('about_subtitle') ?></p>
        </div>
        <div class="about-hero-image-container">
            <div class="about-image-halo"></div>
            <img src="/assets/images/about_portrait_new.png" alt="<?= translate('hero_name') ?>" class="about-hero-img">
        </div>
    </div>
</section>

<div class="container">
    <!-- ── PROFESSIONAL STORY ── -->
    <section class="about-section" id="about-story">
        <h2 class="about-section-title"><?= translate('about_pro_story_title') ?></h2>
        <p class="about-section-text"><?= translate('about_pro_story') ?></p>
    </section>

    <!-- ── ARCHITECTURE & PERFORMANCE ── -->
    <section class="about-section" id="about-arch">
        <h2 class="about-section-title"><?= translate('about_arch_title') ?></h2>
        <p class="about-section-text"><?= translate('about_arch_desc') ?></p>
    </section>

    <!-- ── SKILLS & EXPERTISE ── -->
    <section class="about-section about-skills-section" id="about-skills">
        <h2 class="about-section-title"><?= translate('about_skills_title') ?></h2>
        <div class="skills-grid-new">
            <!-- Backend Skills -->
            <div class="skill-card">
                <h3 class="skill-category"><?= translate('skill_backend') ?></h3>
                <ul class="skill-list-new">
                    <li>PHP</li>
                    <li>Laravel</li>
                    <li>Symfony</li>
                    <li>Node.js</li>
                    <li>Go</li>
                </ul>
            </div>
            <!-- Frontend Skills -->
            <div class="skill-card">
                <h3 class="skill-category"><?= translate('skill_frontend') ?></h3>
                <ul class="skill-list-new">
                    <li>JavaScript</li>
                    <li>React</li>
                    <li>Vue.js</li>
                    <li>HTML5/CSS3</li>
                </ul>
            </div>
            <!-- Database Skills -->
            <div class="skill-card">
                <h3 class="skill-category"><?= translate('skill_database') ?></h3>
                <ul class="skill-list-new">
                    <li>SQL</li>
                    <li>MySQL</li>
                    <li>PostgreSQL</li>
                    <li>Redis</li>
                    <li>MongoDB</li>
                </ul>
            </div>
        </div>
    </section>
</div>

<?php include '../partials/footer.php'; ?>
