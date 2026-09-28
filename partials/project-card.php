<?php
/**
 * One project card. Expects $p (project row), $lang, and $variant:
 * 'featured' (wide, image left), 'image' (image on top), 'building' (image + progress), 'compact' (no image).
 */
$ar = $lang === 'ar';
$pTechs = app\models\Project::getTechnologies($p['id']);
$pTags = app\models\Project::getTags($p['id']);
$extraTechs = max(0, count($pTechs) - 4);
$title = $p['title_' . $lang] ?: $p['title_en'];
$desc = $p['short_description_' . $lang] ?: $p['description_' . $lang];
$company = $p['company_' . $lang] ?? '';
$hasImage = $variant !== 'compact';
?>
<article class="project-card-new project-card--<?= $variant ?>"
         data-title="<?= htmlspecialchars(strtolower($p['title_en'] . ' ' . $p['title_ar'])) ?>"
         data-techs="<?= htmlspecialchars(strtolower(implode(' ', array_column($pTechs, 'name')))) ?>"
         data-tags="<?= htmlspecialchars(strtolower(implode(' ', array_column($pTags, 'name_en')))) ?>"
         data-company="<?= htmlspecialchars(strtolower($p['company_en'] ?? '')) ?>">
    <?php if ($hasImage): ?>
        <div class="project-card-image">
            <img src="<?= htmlspecialchars($p['thumbnail'] ?: '/assets/images/default_project.png') ?>" alt="" loading="lazy">
            <span class="badge-status-wrap">
                <span class="badge-status-dot" style="background: <?= htmlspecialchars($p['status_color'] ?: '#fff') ?>"></span>
                <?= htmlspecialchars($p['status_name_' . $lang]) ?>
            </span>
        </div>
    <?php endif; ?>

    <div class="project-card-body">
        <?php if (!$hasImage): ?>
            <div class="project-card-top">
                <span class="project-card-icon"><i class="<?= !empty($p['github_url']) ? 'fab fa-github' : 'fas fa-flask' ?>"></i></span>
                <span class="project-card-status"><span class="badge-status-dot" style="background: <?= htmlspecialchars($p['status_color'] ?: '#fff') ?>"></span><?= htmlspecialchars($p['status_name_' . $lang]) ?></span>
            </div>
        <?php endif; ?>

        <?php if ($company || !empty($p['duration_' . $lang])): ?>
            <span class="project-card-company"><?= htmlspecialchars($company ?: $p['duration_' . $lang]) ?></span>
        <?php endif; ?>

        <h3 class="project-card-title-new"><a href="/projects/<?= htmlspecialchars($p['slug']) ?>" class="card-link"><?= htmlspecialchars($title) ?></a></h3>
        <p class="project-card-description"><?= htmlspecialchars($desc) ?></p>

        <?php if ($variant === 'building' && (int)$p['completion_percentage'] < 100): ?>
            <div class="building-progress-container">
                <div class="building-progress-text">
                    <span><?= t('card_progress') ?></span>
                    <span><?= (int)$p['completion_percentage'] ?>%</span>
                </div>
                <div class="building-progress-bar-bg"><div class="building-progress-bar-fill" style="width: <?= (int)$p['completion_percentage'] ?>%;"></div></div>
            </div>
        <?php endif; ?>

        <?php if ($pTechs): ?>
            <div class="project-card-tech-badges">
                <?php foreach (array_slice($pTechs, 0, 4) as $t): ?>
                    <span class="tech-badge"><i class="<?= htmlspecialchars($t['icon']) ?>" style="color: <?= htmlspecialchars($t['color']) ?>"></i> <?= htmlspecialchars($t['name']) ?></span>
                <?php endforeach; ?>
                <?php if ($extraTechs): ?><span class="tech-badge tech-badge--more">+<?= $extraTechs ?></span><?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="project-card-actions">
            <span class="card-cta"><?= t('card_cta') ?> <i class="fas fa-arrow-<?= $ar ? 'left' : 'right' ?>"></i></span>
            <span class="card-links">
                <?php if (!empty($p['project_url'])): ?>
                    <a href="<?= htmlspecialchars($p['project_url']) ?>" target="_blank" rel="noopener" aria-label="<?= htmlspecialchars(translate('card_live')) ?>" title="<?= htmlspecialchars(translate('card_live')) ?>"><i class="fas fa-arrow-up-right-from-square"></i></a>
                <?php endif; ?>
                <?php if (!empty($p['github_url'])): ?>
                    <a href="<?= htmlspecialchars($p['github_url']) ?>" target="_blank" rel="noopener" aria-label="GitHub" title="GitHub"><i class="fab fa-github"></i></a>
                <?php endif; ?>
            </span>
        </div>
    </div>
</article>
