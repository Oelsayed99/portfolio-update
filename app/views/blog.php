<?php 
include '../partials/header.php'; 
use app\models\Journey;

$journeyEntries = Journey::all();
$lang = get_current_lang();
?>

<!-- ── JOURNEY HEADER ── -->
<section class="journey-header" id="journey-header">
    <div class="container">
        <h1 class="journey-heading"><?= t('journey_heading') ?></h1>
        <p class="journey-subtitle"><?= t('journey_subtitle') ?></p>
    </div>
</section>

<!-- ── TIMELINE ── -->
<section class="journey-timeline" id="journey-timeline">
    <div class="container">
        <div class="timeline">
            <?php foreach ($journeyEntries as $j): ?>
            <div class="timeline-item timeline-<?= $j['side'] ?>">
                <div class="timeline-dot"></div>
                <div class="timeline-card">
                    <div class="timeline-card-header">
                        <h3><?= $j['title_'.$lang] ?></h3>
                        <span class="timeline-date"><?= $j['date_'.$lang] ?></span>
                    </div>
                    <div class="timeline-card-body">
                        <?php if ($j['image']): ?>
                            <img src="<?= $j['image'] ?>" alt="<?= $j['title_'.$lang] ?>" class="timeline-card-img">
                        <?php endif; ?>
                        <p><?= $j['description_'.$lang] ?></p>
                    </div>
                    <span class="timeline-tag tag-<?= $j['tag_type'] ?>">
                        <i class="fas fa-<?= $j['tag_type'] === 'project' ? 'code' : ($j['tag_type'] === 'career' ? 'briefcase' : ($j['tag_type'] === 'cert' ? 'certificate' : 'graduation-cap')) ?>"></i> 
                        <?= $j['tag_'.$lang] ?>
                    </span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<?php include '../partials/footer.php'; ?>
