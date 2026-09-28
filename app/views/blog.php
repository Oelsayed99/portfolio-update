<?php 
include PARTIAL_PATH . '/header.php'; 
use app\models\Journey;

$journeyEntries = Journey::all();
$lang = get_current_lang();

// Story chapters: text in translations (story_N_*), photos in public/assets/images/journey/<img>.webp and <img>-1.webp, -2...
$story = [1 => '01-egypt', 2 => '02-india', 3 => '03-return', 4 => '04-dubai', 5 => '05-now'];?>

<!-- ── JOURNEY HEADER ── -->
<section class="journey-header" id="journey-header">
    <div class="container">
        <h1 class="journey-heading"><?= t('journey_heading') ?></h1>
        <p class="journey-subtitle"><?= t('journey_subtitle') ?></p>
    </div>
</section>

<!-- ── STORY ── -->
<section class="story" id="story">
    <?php foreach ($story as $n => $img): $i = $n - 1;
        $dir = '/assets/images/journey/';
        $photo = $dir . $img . '.webp';
        $hasPhoto = file_exists(BASE_PATH . '/public' . $photo);
        $collage = array_map('basename', glob(BASE_PATH . '/public' . $dir . $img . '-*.webp') ?: []); ?>
    <article class="story-chapter<?= $i % 2 ? ' story-chapter--flip' : '' ?>"<?= $hasPhoto ? ' style="background-image:url(\'' . $photo . '\')"' : '' ?>>
        <div class="container">
            <div class="story-copy">
                <span class="story-meta"><?= sprintf('%02d', $i + 1) ?> · <?= t("story_{$n}_place") ?> · <?= t("story_{$n}_when") ?></span>
                <h2 class="story-title"><?= t("story_{$n}_title") ?></h2>
                <p><?= t("story_{$n}_text") ?></p>
            </div>
            <?php if ($collage): ?>
            <div class="story-collage story-collage--<?= count($collage) ?>">
                <?php foreach ($collage as $img): ?>
                <img src="<?= $dir . $img ?>" alt="<?= htmlspecialchars(translate("story_{$n}_place")) ?>" loading="lazy">
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </article>
    <?php endforeach; ?>
</section>

<!-- ── TIMELINE (entries are managed in Admin → Journey) ── -->
<?php
$icons = ['project' => 'code', 'career' => 'briefcase', 'cert' => 'certificate', 'learning' => 'graduation-cap'];
$groups = ['project' => 'project', 'career' => 'career', 'cert' => 'learning', 'learning' => 'learning'];
$lastYear = null;
?>
<section class="journey-timeline" id="journey-timeline">
    <div class="container">
        <div class="tl-head reveal">
            <h2 class="about-block-title"><?= t('journey_timeline_title') ?></h2>
            <p class="about-lead"><?= t('journey_timeline_sub') ?></p>
            <div class="skill-tabs tl-filters">
                <button class="filter-btn active" data-tl="all"><?= t('filter_all') ?></button>
                <button class="filter-btn" data-tl="career"><i class="fas fa-briefcase"></i> <?= t('journey_filter_career') ?></button>
                <button class="filter-btn" data-tl="project"><i class="fas fa-code"></i> <?= t('journey_filter_project') ?></button>
                <button class="filter-btn" data-tl="learning"><i class="fas fa-graduation-cap"></i> <?= t('journey_filter_learning') ?></button>
            </div>
        </div>

        <ol class="tl">
            <?php foreach ($journeyEntries as $i => $j):
                $type = $j['tag_type'] ?: 'project';
                $year = substr($j['created_at'] ?? '', 0, 4);
                if ($year && $year !== $lastYear): $lastYear = $year; ?>
                    <li class="tl-year reveal"><span><?= htmlspecialchars($year) ?></span></li>
                <?php endif; ?>
                <li class="tl-item tl-item--<?= $i % 2 ? 'end' : 'start' ?> reveal" data-group="<?= $groups[$type] ?? 'project' ?>">
                    <span class="tl-dot tl-dot--<?= htmlspecialchars($type) ?>"><i class="fas fa-<?= $icons[$type] ?? 'star' ?>"></i></span>
                    <article class="tl-card">
                        <?php if (!empty($j['image'])): ?>
                            <img src="<?= htmlspecialchars($j['image']) ?>" alt="" class="tl-img" loading="lazy">
                        <?php endif; ?>
                        <div class="tl-body">
                            <div class="tl-meta">
                                <span class="tl-tag tl-tag--<?= htmlspecialchars($type) ?>"><?= htmlspecialchars($j['tag_' . $lang]) ?></span>
                                <span class="tl-date"><?= htmlspecialchars($j['date_' . $lang]) ?></span>
                            </div>
                            <h3><?= htmlspecialchars($j['title_' . $lang]) ?></h3>
                            <p><?= htmlspecialchars($j['description_' . $lang]) ?></p>
                        </div>
                    </article>
                </li>
            <?php endforeach; ?>
        </ol>
    </div>
</section>

<script>
document.querySelectorAll('[data-tl]').forEach(btn => btn.addEventListener('click', () => {
    document.querySelectorAll('[data-tl]').forEach(b => b.classList.toggle('active', b === btn));
    const f = btn.dataset.tl;
    document.querySelectorAll('.tl-item').forEach(li => li.hidden = f !== 'all' && li.dataset.group !== f);
    // hide a year marker when none of its events are visible
    document.querySelectorAll('.tl-year').forEach(y => {
        let n = y.nextElementSibling, any = false;
        while (n && !n.classList.contains('tl-year')) { any = any || !n.hidden; n = n.nextElementSibling; }
        y.hidden = !any;
    });
}));
</script>

<?php include PARTIAL_PATH . '/footer.php'; ?>
