<?php 
include PARTIAL_PATH . '/header.php'; 
use app\models\Skill;

$lang = get_current_lang();
$skills = Skill::getGrouped();
$is_admin = isset($_SESSION['admin_user_id']) && isset($_SESSION['admin_editor_active']);
?>

<?php
// All copy below lives in translations (about_*), so it is editable in the Visual Editor.
$ar = $lang === 'ar';
$stats = [[2024, 'about_stat_1'], [count(app\models\Project::all(false)), 'about_stat_2'], [4, 'about_stat_3'], [3, 'about_stat_4']];
$principles = [1 => 'fa-layer-group', 2 => 'fa-shield-halved', 3 => 'fa-code-branch', 4 => 'fa-language'];
$experience = [1 => true, 2 => false, 3 => true, 4 => false, 5 => false]; // n => still active (green dot)
$gallery = ['/assets/images/journey/01-egypt.webp' => 'story_1_place', '/assets/images/journey/02-india.webp' => 'story_2_place',
            '/assets/images/journey/04-dubai.webp' => 'story_4_place', '/assets/images/journey/05-now.webp' => 'story_5_place'];
$languages = [1 => 100, 2 => 90, 3 => 25];
$categories = ['ai' => 'skill_ai', 'backend' => 'skill_backend', 'frontend' => 'skill_frontend', 'database' => 'skill_database', 'devops' => 'skill_devops'];
?>

<!-- ── ABOUT HERO ── -->
<section class="about-hero-v2">
    <div class="container about-hero-grid">
        <div class="about-hero-copy reveal">
            <span class="hero-chip"><?= t('about_chip') ?></span>
            <h1 class="about-title"><?= t('about_heading') ?></h1>
            <p class="about-lead"><?= t('about_subtitle') ?></p>
            <div class="about-facts">
                <span><i class="fas fa-location-dot"></i> <?= t('footer_location') ?></span>
                <span><i class="fas fa-briefcase"></i> <?= t('about_fact_role') ?></span>
                <span><i class="fas fa-language"></i> <?= t('about_fact_langs') ?></span>
            </div>
            <div class="hero-btns">
                <a href="/contact" class="btn btn-primary"><?= t('btn_hire') ?></a>
                <a href="/projects" class="btn btn-outline"><?= t('btn_projects') ?></a>
            </div>
        </div>
        <div class="about-portrait reveal">
            <div class="about-portrait-glow"></div>
            <img src="/assets/images/about_portrait.webp" alt="<?= htmlspecialchars(translate('hero_name')) ?>" width="896" height="1200">
            <div class="about-badge about-badge--top"><i class="fas fa-robot"></i> <?= t('about_badge_ai') ?></div>
            <div class="about-badge about-badge--bottom"><i class="fas fa-server"></i> <?= t('about_badge_stack') ?></div>
        </div>
    </div>
</section>

<!-- ── STATS ── -->
<section class="about-stats">
    <div class="container about-stats-grid">
        <?php foreach ($stats as [$n, $label]): ?>
            <div class="about-stat reveal">
                <span class="about-stat-num" data-count="<?= $n ?>"><?= $n ?></span>
                <span class="about-stat-label"><?= t($label) ?></span>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<div class="container">
    <!-- ── STORY + PHOTOS ── -->
    <section class="about-block about-story-grid">
        <div class="reveal">
            <h2 class="about-block-title"><?= t('about_pro_story_title') ?></h2>
            <div class="about-story-text"><?= t_lines('about_pro_story') ?></div>
            <a href="/blog" class="card-cta about-story-link"><?= t('about_story_link') ?> <i class="fas fa-arrow-<?= $ar ? 'left' : 'right' ?>"></i></a>
        </div>
        <div class="about-gallery reveal">
            <?php foreach ($gallery as $src => $cap): ?>
                <figure><img src="<?= $src ?>" alt="<?= htmlspecialchars(translate($cap)) ?>" loading="lazy"><figcaption><?= t($cap) ?></figcaption></figure>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- ── PRINCIPLES ── -->
    <section class="about-block">
        <h2 class="about-block-title reveal"><?= t('about_how_title') ?></h2>
        <div class="principles-grid">
            <?php foreach ($principles as $n => $icon): ?>
                <div class="principle-card reveal">
                    <span class="project-card-icon"><i class="fas <?= $icon ?>"></i></span>
                    <h3><?= t("about_p{$n}_title") ?></h3>
                    <p><?= t("about_p{$n}_text") ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- ── EXPERIENCE ── -->
    <section class="about-block">
        <h2 class="about-block-title reveal"><?= t('about_exp_title') ?></h2>
        <div class="exp-list">
            <?php foreach ($experience as $n => $current): ?>
                <details class="exp-item reveal"<?= $n === 1 ? ' open' : '' ?>>
                    <summary>
                        <span class="exp-dot<?= $current ? ' exp-dot--live' : '' ?>"></span>
                        <span class="exp-head">
                            <span class="exp-role"><?= t("about_exp{$n}_role") ?></span>
                            <span class="exp-org"><?= t("about_exp{$n}_org") ?> · <?= t("about_exp{$n}_where") ?></span>
                        </span>
                        <span class="exp-when"><?= t("about_exp{$n}_when") ?></span>
                        <i class="fas fa-chevron-down exp-chevron"></i>
                    </summary>
                    <ul><?= t_lines("about_exp{$n}_points", 'li') ?></ul>
                </details>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- ── SKILLS & EXPERTISE ── -->
    <section class="about-block about-skills-section" id="about-skills">
        <h2 class="about-block-title reveal"><?= t('about_skills_title') ?></h2>
        <div class="skill-tabs" role="tablist">
            <button class="filter-btn active" data-skill-tab="all"><?= t('filter_all') ?></button>
            <?php foreach ($categories as $catKey => $catMsgId): ?>
                <button class="filter-btn" data-skill-tab="<?= $catKey ?>"><?= t($catMsgId) ?></button>
            <?php endforeach; ?>
        </div>
        <div class="skills-grid-new">
            <?php foreach ($categories as $catKey => $catMsgId): ?>
            <div class="skill-card" data-category="<?= $catKey ?>">
                <h3 class="skill-category"><?= t($catMsgId) ?></h3>
                <ul class="skill-list-new" id="skill-list-<?= $catKey ?>">
                    <?php foreach ($skills[$catKey] ?? [] as $skill): ?>
                        <li data-skill-id="<?= $skill['id'] ?>">
                            <?= htmlspecialchars($skill['name_' . $lang] ?: $skill['name_en']) ?>
                            <?php if ($is_admin): ?>
                                <button class="skill-remove-btn" onclick="removeSkill(<?= $skill['id'] ?>, this)" title="Remove skill">&times;</button>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <?php if ($is_admin): ?>
                <div class="skill-add-row">
                    <input type="text" class="skill-add-input" id="skill-input-<?= $catKey ?>" placeholder="New skill name...">
                    <button class="skill-add-btn" onclick="addSkill('<?= $catKey ?>', this)">
                        <i class="fas fa-plus"></i> Add
                    </button>
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- ── LANGUAGES + CTA ── -->
    <section class="about-block about-bottom-grid">
        <div class="about-languages reveal">
            <h2 class="about-block-title"><?= t('about_lang_title') ?></h2>
            <?php foreach ($languages as $n => $pct): ?>
                <div class="lang-row">
                    <div class="lang-row-head"><span><?= t("about_lang{$n}_name") ?></span><span><?= t("about_lang{$n}_level") ?></span></div>
                    <div class="building-progress-bar-bg"><div class="building-progress-bar-fill lang-fill" style="--w: <?= $pct ?>%"></div></div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="home-cta-card about-cta reveal">
            <h2><?= t('about_cta_title') ?></h2>
            <p><?= t('about_cta_text') ?></p>
            <a href="/contact" class="btn btn-primary"><?= t('btn_hire') ?></a>
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Skill tabs
    document.querySelectorAll('[data-skill-tab]').forEach(btn => btn.addEventListener('click', () => {
        document.querySelectorAll('[data-skill-tab]').forEach(b => b.classList.toggle('active', b === btn));
        const tab = btn.dataset.skillTab;
        document.querySelectorAll('.skill-card').forEach(c => c.hidden = tab !== 'all' && c.dataset.category !== tab);
    }));
});
</script>

<?php if ($is_admin): ?>
<script>
async function addSkill(category, btn) {
    const input = document.getElementById('skill-input-' + category);
    const name = input.value.trim();
    if (!name) return;

    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

    try {
        const res = await fetch('/admin/api/skills.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ category, name_en: name, name_ar: name })
        });
        const data = await res.json();

        if (data.success) {
            const list = document.getElementById('skill-list-' + category);
            const li = document.createElement('li');
            li.setAttribute('data-skill-id', data.id);
            li.innerHTML = `${data.name_en} <button class="skill-remove-btn" onclick="removeSkill(${data.id}, this)" title="Remove skill">&times;</button>`;
            list.appendChild(li);
            input.value = '';
        } else {
            alert('Error: ' + (data.error || 'Unknown error'));
        }
    } catch (err) {
        alert('Failed: ' + err.message);
    } finally {
        btn.disabled = false;
        btn.innerHTML = '<i class="fas fa-plus"></i> Add';
    }
}

async function removeSkill(id, btn) {
    if (!confirm('Remove this skill?')) return;

    const li = btn.closest('li');
    li.style.opacity = '0.5';

    try {
        const res = await fetch('/admin/api/skills.php', {
            method: 'DELETE',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id })
        });
        const data = await res.json();

        if (data.success) {
            li.remove();
        } else {
            li.style.opacity = '1';
            alert('Error: ' + (data.error || 'Unknown error'));
        }
    } catch (err) {
        li.style.opacity = '1';
        alert('Failed: ' + err.message);
    }
}
</script>
<?php endif; ?>

<?php include PARTIAL_PATH . '/footer.php'; ?>
