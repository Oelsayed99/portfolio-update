<?php 
include '../partials/header.php'; 
use app\models\Skill;

$lang = get_current_lang();
$skills = Skill::getGrouped();
$is_admin = isset($_SESSION['admin_user_id']) && isset($_SESSION['admin_editor_active']);

// Define categories with their translation keys
$categories = [
    'backend' => 'skill_backend',
    'frontend' => 'skill_frontend',
    'database' => 'skill_database',
];
?>

<!-- ── ABOUT HERO ── -->
<section class="about-hero" id="about-hero">
    <div class="container about-hero-container">
        <div class="about-hero-content">
            <h1 class="about-heading"><?= t('about_heading') ?></h1>
            <p class="about-subtitle accent-text"><?= t('about_subtitle') ?></p>
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
        <h2 class="about-section-title"><?= t('about_pro_story_title') ?></h2>
        <p class="about-section-text"><?= t('about_pro_story') ?></p>
    </section>

    <!-- ── ARCHITECTURE & PERFORMANCE ── -->
    <section class="about-section" id="about-arch">
        <h2 class="about-section-title"><?= t('about_arch_title') ?></h2>
        <p class="about-section-text"><?= t('about_arch_desc') ?></p>
    </section>

    <!-- ── SKILLS & EXPERTISE ── -->
    <section class="about-section about-skills-section" id="about-skills">
        <h2 class="about-section-title"><?= t('about_skills_title') ?></h2>
        <div class="skills-grid-new">
            <?php foreach ($categories as $catKey => $catMsgId): ?>
            <div class="skill-card" data-category="<?= $catKey ?>">
                <h3 class="skill-category"><?= t($catMsgId) ?></h3>
                <ul class="skill-list-new" id="skill-list-<?= $catKey ?>">
                    <?php if (isset($skills[$catKey])): ?>
                        <?php foreach ($skills[$catKey] as $skill): ?>
                        <li data-skill-id="<?= $skill['id'] ?>">
                            <?= htmlspecialchars($skill['name_' . $lang]) ?>
                            <?php if ($is_admin): ?>
                                <button class="skill-remove-btn" onclick="removeSkill(<?= $skill['id'] ?>, this)" title="Remove skill">&times;</button>
                            <?php endif; ?>
                        </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
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
</div>

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

<?php include '../partials/footer.php'; ?>
