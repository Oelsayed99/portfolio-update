<?php include '../partials/header.php'; ?>

<!-- ── JOURNEY HEADER ── -->
<section class="journey-header" id="journey-header">
    <div class="container">
        <h1 class="journey-heading"><?= translate('journey_heading') ?></h1>
        <p class="journey-subtitle"><?= translate('journey_subtitle') ?></p>
    </div>
</section>

<!-- ── TIMELINE ── -->
<section class="journey-timeline" id="journey-timeline">
    <div class="container">
        <div class="timeline">
            <!-- Entry 1 — Left: Launched Apex Finance -->
            <div class="timeline-item timeline-left">
                <div class="timeline-dot"></div>
                <div class="timeline-card">
                    <div class="timeline-card-header">
                        <h3><?= translate('journey_1_title') ?></h3>
                        <span class="timeline-date"><?= translate('journey_1_date') ?></span>
                    </div>
                    <div class="timeline-card-body">
                        <img src="/assets/images/journey_apex.png" alt="<?= translate('journey_1_title') ?>" class="timeline-card-img">
                        <p><?= translate('journey_1_desc') ?></p>
                    </div>
                    <span class="timeline-tag tag-project"><i class="fas fa-code"></i> <?= translate('journey_tag_project') ?></span>
                </div>
            </div>

            <!-- Entry 2 — Right: Promoted to Senior -->
            <div class="timeline-item timeline-right">
                <div class="timeline-dot"></div>
                <div class="timeline-card">
                    <div class="timeline-card-header">
                        <h3><?= translate('journey_2_title') ?></h3>
                        <span class="timeline-date"><?= translate('journey_2_date') ?></span>
                    </div>
                    <div class="timeline-card-body">
                        <p><?= translate('journey_2_desc') ?></p>
                    </div>
                    <span class="timeline-tag tag-career"><i class="fas fa-briefcase"></i> <?= translate('journey_tag_career') ?></span>
                </div>
            </div>

            <!-- Entry 3 — Left: AWS Certification -->
            <div class="timeline-item timeline-left">
                <div class="timeline-dot"></div>
                <div class="timeline-card">
                    <div class="timeline-card-header">
                        <h3><?= translate('journey_3_title') ?></h3>
                        <span class="timeline-date"><?= translate('journey_3_date') ?></span>
                    </div>
                    <div class="timeline-card-body">
                        <p><?= translate('journey_3_desc') ?></p>
                    </div>
                    <span class="timeline-tag tag-cert"><i class="fas fa-certificate"></i> <?= translate('journey_tag_cert') ?></span>
                </div>
            </div>

            <!-- Entry 4 — Right: ML Specialization -->
            <div class="timeline-item timeline-right">
                <div class="timeline-dot"></div>
                <div class="timeline-card">
                    <div class="timeline-card-header">
                        <h3><?= translate('journey_4_title') ?></h3>
                        <span class="timeline-date"><?= translate('journey_4_date') ?></span>
                    </div>
                    <div class="timeline-card-body">
                        <p><?= translate('journey_4_desc') ?></p>
                    </div>
                    <span class="timeline-tag tag-learning"><i class="fas fa-graduation-cap"></i> <?= translate('journey_tag_learning') ?></span>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include '../partials/footer.php'; ?>
