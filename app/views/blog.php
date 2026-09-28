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

// One timeline: manual entries (Admin → Journey) + projects that have a timeline date (Admin → Projects)
$months = $lang === 'ar'
    ? ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو', 'يوليو', 'أغسطس', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر']
    : ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
$timeline = [];
foreach ($journeyEntries as $j) {
    $timeline[] = ['at' => $j['created_at'], 'type' => $j['tag_type'] ?: 'project', 'tag' => $j['tag_' . $lang],
                   'date' => $j['date_' . $lang], 'title' => $j['title_' . $lang], 'text' => $j['description_' . $lang],
                   'image' => $j['image'], 'href' => null];
}
foreach (app\models\Project::all(false) as $p) {
    if (empty($p['timeline_date'])) continue;
    $ts = strtotime($p['timeline_date']);
    $timeline[] = ['at' => $p['timeline_date'], 'type' => 'project', 'tag' => translate('journey_tag_project'),
                   'date' => $months[date('n', $ts) - 1] . ' ' . date('Y', $ts),
                   'title' => $p['title_' . $lang] ?: $p['title_en'], 'text' => $p['short_description_' . $lang] ?: $p['short_description_en'],
                   'image' => $p['thumbnail'], 'href' => '/projects/' . $p['slug']];
}
usort($timeline, fn($a, $b) => strcmp($b['at'], $a['at']));
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
            <?php foreach ($timeline as $i => $e):
                $type = $e['type'];
                $year = substr($e['at'] ?? '', 0, 4);
                if ($year && $year !== $lastYear): $lastYear = $year; ?>
                    <li class="tl-year reveal"><span><?= htmlspecialchars($year) ?></span></li>
                <?php endif; ?>
                <li class="tl-item tl-item--<?= $i % 2 ? 'end' : 'start' ?> reveal" data-group="<?= $groups[$type] ?? 'project' ?>">
                    <span class="tl-dot tl-dot--<?= htmlspecialchars($type) ?>"><i class="fas fa-<?= $icons[$type] ?? 'star' ?>"></i></span>
                    <article class="tl-card<?= $e['href'] ? ' tl-card--link' : '' ?>">
                        <?php if (!empty($e['image'])): ?>
                            <img src="<?= htmlspecialchars($e['image']) ?>" alt="" class="tl-img" loading="lazy">
                        <?php endif; ?>
                        <div class="tl-body">
                            <div class="tl-meta">
                                <span class="tl-tag tl-tag--<?= htmlspecialchars($type) ?>"><?= htmlspecialchars($e['tag']) ?></span>
                                <span class="tl-date"><?= htmlspecialchars($e['date']) ?></span>
                            </div>
                            <h3><?php if ($e['href']): ?><a href="<?= htmlspecialchars($e['href']) ?>" class="card-link"><?= htmlspecialchars($e['title']) ?></a><?php else: ?><?= htmlspecialchars($e['title']) ?><?php endif; ?></h3>
                            <p><?= htmlspecialchars($e['text']) ?></p>
                            <?php if ($e['href']): ?><span class="card-cta"><?= t('card_cta') ?> <i class="fas fa-arrow-<?= $lang === 'ar' ? 'left' : 'right' ?>"></i></span><?php endif; ?>
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
