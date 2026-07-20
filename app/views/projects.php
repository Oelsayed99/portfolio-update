<?php 
include PARTIAL_PATH . '/header.php'; 
$lang = get_current_lang();
?>

<!-- ── PROJECTS HEADER ── -->
<section class="projects-header" id="projects-header">
    <div class="container">
        <h1 class="projects-heading"><?= translate('projects_heading') ?></h1>
        <p class="projects-subtitle"><?= translate('projects_subtitle') ?></p>
    </div>
</section>

<section class="projects-section-container" style="padding-top: 0;">
    <div class="container">
        <!-- ── TOOLBAR (SEARCH & FILTERS) ── -->
        <div class="projects-toolbar">
            <div class="projects-filters" id="projects-filters">
                <button class="filter-btn active" data-section="all"><?= $lang === 'ar' ? 'الكل' : 'All' ?></button>
                <?php foreach ($sections as $sec): ?>
                    <button class="filter-btn" data-section="<?= htmlspecialchars($sec['slug']) ?>">
                        <?= htmlspecialchars($sec['name_' . $lang]) ?>
                    </button>
                <?php endforeach; ?>
            </div>
            <div class="projects-search-wrapper">
                <i class="fas fa-search"></i>
                <input type="text" id="projects-search" class="projects-search-input" placeholder="<?= $lang === 'ar' ? 'بحث عن المشاريع...' : 'Search projects...' ?>">
            </div>
        </div>

        <!-- ── PROJECTS CONTAINER ── -->
        <div class="projects-container" id="projects-container">
            <?php foreach ($sections as $sec): 
                $secSlug = $sec['slug'];
                $secProjects = $projectsBySection[$secSlug] ?? [];
                if (empty($secProjects)) continue;
            ?>
                <div class="projects-grid-container" id="sec-container-<?= $secSlug ?>" data-section-slug="<?= $secSlug ?>">
                    <!-- Section Title -->
                    <div class="projects-sec-header">
                        <h2 class="projects-sec-title"><?= htmlspecialchars($sec['name_' . $lang]) ?></h2>
                        <p class="projects-sec-desc"><?= htmlspecialchars($sec['description_' . $lang]) ?></p>
                    </div>

                    <!-- Custom Layout by Section -->
                    <?php if ($secSlug === 'featured'): ?>
                        <!-- Featured Large Layout -->
                        <div class="featured-grid-new">
                            <?php foreach ($secProjects as $p): 
                                $pTechs = app\models\Project::getTechnologies($p['id']);
                                $pTags = app\models\Project::getTags($p['id']);
                            ?>
                                <div class="project-card-new featured-card-new" 
                                     data-title="<?= htmlspecialchars(strtolower($p['title_en'] . ' ' . $p['title_ar'])) ?>"
                                     data-techs="<?= htmlspecialchars(strtolower(implode(' ', array_column($pTechs, 'name')))) ?>"
                                     data-tags="<?= htmlspecialchars(strtolower(implode(' ', array_column($pTags, 'name_en')))) ?>"
                                     data-company="<?= htmlspecialchars(strtolower($p['company_en'])) ?>">
                                    <div class="project-card-image">
                                        <img src="<?= $p['thumbnail'] ?: '/assets/images/default_project.png' ?>" alt="<?= htmlspecialchars($p['title_' . $lang]) ?>">
                                        <div class="card-badges-top">
                                            <span class="badge-sec"><?= htmlspecialchars($sec['name_' . $lang]) ?></span>
                                            <span class="badge-status-wrap">
                                                <span class="badge-status-dot" style="background: <?= $p['status_color'] ?: '#fff' ?>"></span>
                                                <?= htmlspecialchars($p['status_name_' . $lang]) ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="project-card-body">
                                        <?php if (!empty($p['company_' . $lang])): ?>
                                            <span class="project-card-company"><?= htmlspecialchars($p['company_' . $lang]) ?></span>
                                        <?php endif; ?>
                                        <h3 class="project-card-title-new"><?= htmlspecialchars($p['title_' . $lang]) ?></h3>
                                        <p class="project-card-description"><?= htmlspecialchars($p['short_description_' . $lang] ?: $p['description_' . $lang]) ?></p>
                                        <div class="project-card-tech-badges">
                                            <?php foreach ($pTechs as $t): ?>
                                                <span class="tech-badge" style="border-color: <?= $t['color'] ?>33; background: <?= $t['color'] ?>11;">
                                                    <i class="<?= $t['icon'] ?>"></i> <?= htmlspecialchars($t['name']) ?>
                                                </span>
                                            <?php endforeach; ?>
                                        </div>
                                        <div class="project-card-actions">
                                            <a href="/projects/<?= $p['slug'] ?>" class="btn btn-primary"><?= $lang === 'ar' ? 'عرض التفاصيل' : 'View Details' ?></a>
                                            <?php if (!empty($p['project_url'])): ?>
                                                <a href="<?= $p['project_url'] ?>" target="_blank" class="btn btn-outline"><i class="fas fa-external-link-alt"></i> <?= $lang === 'ar' ? 'رابط مباشر' : 'Live Demo' ?></a>
                                            <?php elseif (!empty($p['github_url'])): ?>
                                                <a href="<?= $p['github_url'] ?>" target="_blank" class="btn btn-outline"><i class="fab fa-github"></i> GitHub</a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                    <?php elseif ($secSlug === 'professional'): ?>
                        <!-- Professional Layout -->
                        <div class="pro-grid-new">
                            <?php foreach ($secProjects as $p): 
                                $pTechs = app\models\Project::getTechnologies($p['id']);
                                $pTags = app\models\Project::getTags($p['id']);
                            ?>
                                <div class="project-card-new" 
                                     data-title="<?= htmlspecialchars(strtolower($p['title_en'] . ' ' . $p['title_ar'])) ?>"
                                     data-techs="<?= htmlspecialchars(strtolower(implode(' ', array_column($pTechs, 'name')))) ?>"
                                     data-tags="<?= htmlspecialchars(strtolower(implode(' ', array_column($pTags, 'name_en')))) ?>"
                                     data-company="<?= htmlspecialchars(strtolower($p['company_en'])) ?>">
                                    <div class="project-card-image">
                                        <img src="<?= $p['thumbnail'] ?: '/assets/images/default_project.png' ?>" alt="<?= htmlspecialchars($p['title_' . $lang]) ?>">
                                        <div class="card-badges-top">
                                            <span class="badge-sec"><?= htmlspecialchars($p['my_role_' . $lang] ?: 'Engineer') ?></span>
                                        </div>
                                    </div>
                                    <div class="project-card-body">
                                        <span class="project-card-company"><?= htmlspecialchars($p['company_' . $lang]) ?></span>
                                        <h3 class="project-card-title-new"><?= htmlspecialchars($p['title_' . $lang]) ?></h3>
                                        <p class="project-card-description"><?= htmlspecialchars($p['short_description_' . $lang] ?: $p['description_' . $lang]) ?></p>
                                        <div class="project-card-tech-badges">
                                            <?php foreach ($pTechs as $t): ?>
                                                <span class="tech-badge" style="border-color: <?= $t['color'] ?>33; background: <?= $t['color'] ?>11;">
                                                    <i class="<?= $t['icon'] ?>"></i> <?= htmlspecialchars($t['name']) ?>
                                                </span>
                                            <?php endforeach; ?>
                                        </div>
                                        <div class="project-card-actions">
                                            <a href="/projects/<?= $p['slug'] ?>" class="btn btn-primary"><?= $lang === 'ar' ? 'عرض التفاصيل' : 'View Details' ?></a>
                                            <?php if (!empty($p['project_url'])): ?>
                                                <a href="<?= $p['project_url'] ?>" target="_blank" class="btn btn-outline" title="Live Website"><i class="fas fa-external-link-alt"></i> Live App</a>
                                            <?php elseif (!empty($p['github_url'])): ?>
                                                <a href="<?= $p['github_url'] ?>" target="_blank" class="btn btn-outline" title="GitHub"><i class="fab fa-github"></i> GitHub</a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                    <?php elseif ($secSlug === 'personal'): ?>
                        <!-- Personal Layout -->
                        <div class="personal-grid-new">
                            <?php foreach ($secProjects as $p): 
                                $pTechs = app\models\Project::getTechnologies($p['id']);
                                $pTags = app\models\Project::getTags($p['id']);
                            ?>
                                <div class="project-card-new" 
                                     data-title="<?= htmlspecialchars(strtolower($p['title_en'] . ' ' . $p['title_ar'])) ?>"
                                     data-techs="<?= htmlspecialchars(strtolower(implode(' ', array_column($pTechs, 'name')))) ?>"
                                     data-tags="<?= htmlspecialchars(strtolower(implode(' ', array_column($pTags, 'name_en')))) ?>"
                                     data-company="">
                                    <div class="project-card-image">
                                        <img src="<?= $p['thumbnail'] ?: '/assets/images/default_project.png' ?>" alt="<?= htmlspecialchars($p['title_' . $lang]) ?>">
                                    </div>
                                    <div class="project-card-body">
                                        <h3 class="project-card-title-new"><?= htmlspecialchars($p['title_' . $lang]) ?></h3>
                                        <p class="project-card-description"><?= htmlspecialchars($p['short_description_' . $lang] ?: $p['description_' . $lang]) ?></p>
                                        <div class="project-card-tech-badges">
                                            <?php foreach ($pTechs as $t): ?>
                                                <span class="tech-badge" style="border-color: <?= $t['color'] ?>33; background: <?= $t['color'] ?>11;">
                                                    <i class="<?= $t['icon'] ?>"></i> <?= htmlspecialchars($t['name']) ?>
                                                </span>
                                            <?php endforeach; ?>
                                        </div>
                                        <div class="project-card-actions">
                                            <a href="/projects/<?= $p['slug'] ?>" class="btn btn-primary"><?= $lang === 'ar' ? 'التفاصيل' : 'Details' ?></a>
                                            <?php if (!empty($p['project_url'])): ?>
                                                <a href="<?= $p['project_url'] ?>" target="_blank" class="btn btn-outline"><i class="fas fa-external-link-alt"></i> <?= $lang === 'ar' ? 'الموقع' : 'Live App' ?></a>
                                            <?php elseif (!empty($p['github_url'])): ?>
                                                <a href="<?= $p['github_url'] ?>" target="_blank" class="btn btn-outline"><i class="fab fa-github"></i> GitHub</a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                    <?php elseif ($secSlug === 'opensource'): ?>
                        <!-- Open Source Layout -->
                        <div class="opensource-grid-new">
                            <?php foreach ($secProjects as $p): 
                                $pTechs = app\models\Project::getTechnologies($p['id']);
                                $pTags = app\models\Project::getTags($p['id']);
                                $gh = json_decode($p['structured_data'] ?? '{}', true);
                            ?>
                                <div class="project-card-new" 
                                     data-title="<?= htmlspecialchars(strtolower($p['title_en'] . ' ' . $p['title_ar'])) ?>"
                                     data-techs="<?= htmlspecialchars(strtolower(implode(' ', array_column($pTechs, 'name')))) ?>"
                                     data-tags="<?= htmlspecialchars(strtolower(implode(' ', array_column($pTags, 'name_en')))) ?>"
                                     data-company="">
                                    <div class="project-card-body">
                                        <h3 class="project-card-title-new" style="font-size: 1.15rem;"><i class="fab fa-github"></i> <?= htmlspecialchars($p['title_' . $lang]) ?></h3>
                                        <p class="project-card-description"><?= htmlspecialchars($p['short_description_' . $lang] ?: $p['description_' . $lang]) ?></p>
                                        
                                        <?php if (!empty($gh)): ?>
                                            <div class="opensource-stats">
                                                <span><i class="fas fa-circle" style="color: <?= $pTechs[0]['color'] ?? '#fff' ?>"></i> <?= htmlspecialchars($gh['language'] ?? 'N/A') ?></span>
                                                <span><i class="fas fa-star"></i> <?= htmlspecialchars($gh['stars'] ?? 0) ?></span>
                                                <span><i class="fas fa-code-branch"></i> <?= htmlspecialchars($gh['forks'] ?? 0) ?></span>
                                            </div>
                                        <?php endif; ?>

                                        <div class="project-card-actions">
                                            <?php if (!empty($p['project_url'])): ?>
                                                <a href="<?= $p['project_url'] ?>" target="_blank" class="btn btn-primary"><i class="fas fa-external-link-alt"></i> <?= $lang === 'ar' ? 'الموقع' : 'Live App' ?></a>
                                            <?php elseif (!empty($p['github_url'])): ?>
                                                <a href="<?= $p['github_url'] ?>" target="_blank" class="btn btn-primary"><i class="fab fa-github"></i> Repository</a>
                                            <?php endif; ?>
                                            <a href="/projects/<?= $p['slug'] ?>" class="btn btn-outline"><?= $lang === 'ar' ? 'دراسة حالة' : 'Case Study' ?></a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                    <?php elseif ($secSlug === 'building'): ?>
                        <!-- Currently Building Layout -->
                        <div class="building-grid-new">
                            <?php foreach ($secProjects as $p): 
                                $pTechs = app\models\Project::getTechnologies($p['id']);
                                $pTags = app\models\Project::getTags($p['id']);
                            ?>
                                <div class="project-card-new" 
                                     data-title="<?= htmlspecialchars(strtolower($p['title_en'] . ' ' . $p['title_ar'])) ?>"
                                     data-techs="<?= htmlspecialchars(strtolower(implode(' ', array_column($pTechs, 'name')))) ?>"
                                     data-tags="<?= htmlspecialchars(strtolower(implode(' ', array_column($pTags, 'name_en')))) ?>"
                                     data-company="">
                                    <div class="project-card-image">
                                        <img src="<?= $p['thumbnail'] ?: '/assets/images/default_project.png' ?>" alt="<?= htmlspecialchars($p['title_' . $lang]) ?>">
                                    </div>
                                    <div class="project-card-body">
                                        <h3 class="project-card-title-new"><?= htmlspecialchars($p['title_' . $lang]) ?></h3>
                                        
                                        <!-- Progress Bar -->
                                        <div class="building-progress-container">
                                            <div class="building-progress-text">
                                                <span>Development Progress</span>
                                                <span><?= $p['completion_percentage'] ?>%</span>
                                            </div>
                                            <div class="building-progress-bar-bg">
                                                <div class="building-progress-bar-fill" style="width: <?= $p['completion_percentage'] ?>%;"></div>
                                            </div>
                                        </div>

                                        <?php if (!empty($p['challenges_' . $lang])): ?>
                                            <div class="building-milestone">
                                                <strong>Current Milestone:</strong> <?= htmlspecialchars($p['challenges_' . $lang]) ?>
                                            </div>
                                        <?php endif; ?>

                                        <p class="project-card-description"><?= htmlspecialchars($p['short_description_' . $lang] ?: $p['description_' . $lang]) ?></p>
                                        <div class="project-card-actions">
                                            <a href="/projects/<?= $p['slug'] ?>" class="btn btn-primary"><?= $lang === 'ar' ? 'التفاصيل' : 'Details' ?></a>
                                            <?php if (!empty($p['project_url'])): ?>
                                                <a href="<?= $p['project_url'] ?>" target="_blank" class="btn btn-outline"><i class="fas fa-external-link-alt"></i> <?= $lang === 'ar' ? 'الموقع' : 'Live App' ?></a>
                                            <?php elseif (!empty($p['github_url'])): ?>
                                                <a href="<?= $p['github_url'] ?>" target="_blank" class="btn btn-outline"><i class="fab fa-github"></i> GitHub</a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                    <?php else: ?>
                        <!-- Default / Experiments Layout -->
                        <div class="experiments-grid-new">
                            <?php foreach ($secProjects as $p): 
                                $pTechs = app\models\Project::getTechnologies($p['id']);
                                $pTags = app\models\Project::getTags($p['id']);
                            ?>
                                <div class="project-card-new experiment-card-new" 
                                     data-title="<?= htmlspecialchars(strtolower($p['title_en'] . ' ' . $p['title_ar'])) ?>"
                                     data-techs="<?= htmlspecialchars(strtolower(implode(' ', array_column($pTechs, 'name')))) ?>"
                                     data-tags="<?= htmlspecialchars(strtolower(implode(' ', array_column($pTags, 'name_en')))) ?>"
                                     data-company="">
                                    <div class="project-card-body">
                                        <h3 class="project-card-title-new" style="font-size: 1.1rem;"><?= htmlspecialchars($p['title_' . $lang]) ?></h3>
                                        <p class="project-card-description" style="font-size: 0.8rem;"><?= htmlspecialchars($p['short_description_' . $lang] ?: $p['description_' . $lang]) ?></p>
                                        <div class="project-card-tech-badges">
                                            <?php foreach ($pTechs as $t): ?>
                                                <span class="tech-badge" style="font-size: 0.65rem; border-color: <?= $t['color'] ?>33; background: <?= $t['color'] ?>11;">
                                                    <i class="<?= $t['icon'] ?>"></i> <?= htmlspecialchars($t['name']) ?>
                                                </span>
                                            <?php endforeach; ?>
                                        </div>
                                        <div class="project-card-actions">
                                            <?php if (!empty($p['project_url'])): ?>
                                                <a href="<?= $p['project_url'] ?>" target="_blank" class="btn btn-primary btn-sm"><i class="fas fa-external-link-alt"></i> <?= $lang === 'ar' ? 'الموقع' : 'Live App' ?></a>
                                            <?php elseif (!empty($p['github_url'])): ?>
                                                <a href="<?= $p['github_url'] ?>" target="_blank" class="btn btn-outline btn-sm"><i class="fab fa-github"></i> GitHub</a>
                                            <?php endif; ?>
                                            <a href="/projects/<?= $p['slug'] ?>" class="btn btn-outline btn-sm"><?= $lang === 'ar' ? 'تفاصيل النموذج' : 'Prototype Details' ?></a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ── INTERACTIVE FILTERING & SEARCH SCRIPT ── -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const searchInput = document.getElementById('projects-search');
    const projectContainer = document.getElementById('projects-container');
    const sectionContainers = document.querySelectorAll('.projects-grid-container');
    const projectCards = document.querySelectorAll('.project-card-new');

    let currentSection = 'all';
    let searchQuery = '';

    function updateShowcase() {
        projectContainer.classList.add('filtering');

        setTimeout(() => {
            sectionContainers.forEach(sec => {
                const secSlug = sec.getAttribute('data-section-slug');
                const isSecVisible = (currentSection === 'all' || currentSection === secSlug);
                let visibleCardsInSection = 0;

                const cards = sec.querySelectorAll('.project-card-new');
                cards.forEach(card => {
                    const title = card.getAttribute('data-title') || '';
                    const techs = card.getAttribute('data-techs') || '';
                    const tags = card.getAttribute('data-tags') || '';
                    const company = card.getAttribute('data-company') || '';
                    
                    const query = searchQuery.toLowerCase().trim();
                    const matchesSearch = !query || 
                        title.includes(query) || 
                        techs.includes(query) || 
                        tags.includes(query) || 
                        company.includes(query);

                    if (isSecVisible && matchesSearch) {
                        card.style.display = '';
                        visibleCardsInSection++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                if (isSecVisible && visibleCardsInSection > 0) {
                    sec.classList.remove('hidden');
                } else {
                    sec.classList.add('hidden');
                }
            });

            projectContainer.classList.remove('filtering');
        }, 150);
    }

    // Filter Buttons click handler
    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            filterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            currentSection = btn.getAttribute('data-section');
            updateShowcase();
        });
    });

    // Live Search input handler
    searchInput.addEventListener('input', (e) => {
        searchQuery = e.target.value;
        updateShowcase();
    });
});
</script>

<?php include PARTIAL_PATH . '/footer.php'; ?>
