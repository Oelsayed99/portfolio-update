<?php 
include PARTIAL_PATH . '/header.php'; 
$lang = get_current_lang();
?>

<?php
$total = array_sum(array_map('count', $projectsBySection));
$layout = ['featured' => ['featured-grid-new', 'featured'], 'building' => ['building-grid-new', 'building'],
           'opensource' => ['compact-grid-new', 'compact'], 'experiments' => ['compact-grid-new', 'compact']];
?>
<!-- ── PROJECTS HEADER ── -->
<section class="projects-header" id="projects-header">
    <div class="container">
        <span class="hero-chip"><?= $total ?> <?= t('proj_count_label') ?></span>
        <h1 class="projects-heading"><?= t('projects_heading') ?></h1>
        <p class="projects-subtitle"><?= t('projects_subtitle') ?></p>
    </div>
</section>

<section class="projects-section-container" style="padding-top: 0;">
    <div class="container">
        <!-- ── TOOLBAR (SEARCH & FILTERS) ── -->
        <div class="projects-toolbar">
            <div class="projects-filters" id="projects-filters">
                <button class="filter-btn active" data-section="all"><?= t('filter_all') ?> <span class="filter-count"><?= $total ?></span></button>
                <?php foreach ($sections as $sec): if (empty($projectsBySection[$sec['slug']])) continue; ?>
                    <button class="filter-btn" data-section="<?= htmlspecialchars($sec['slug']) ?>">
                        <?= htmlspecialchars($sec['name_' . $lang]) ?> <span class="filter-count"><?= count($projectsBySection[$sec['slug']]) ?></span>
                    </button>
                <?php endforeach; ?>
            </div>
            <div class="projects-search-wrapper">
                <i class="fas fa-search"></i>
                <input type="search" id="projects-search" class="projects-search-input" placeholder="<?= htmlspecialchars(translate('proj_search_ph')) ?>">
            </div>
        </div>

        <!-- ── PROJECTS CONTAINER ── -->
        <div class="projects-container" id="projects-container">
            <?php foreach ($sections as $sec):
                $secSlug = $sec['slug'];
                $secProjects = $projectsBySection[$secSlug] ?? [];
                if (empty($secProjects)) continue;
                [$grid, $variant] = $layout[$secSlug] ?? ['pro-grid-new', 'image'];
            ?>
                <div class="projects-grid-container" id="sec-container-<?= $secSlug ?>" data-section-slug="<?= $secSlug ?>">
                    <div class="projects-sec-header">
                        <h2 class="projects-sec-title"><?= htmlspecialchars($sec['name_' . $lang]) ?> <span class="projects-sec-count"><?= count($secProjects) ?></span></h2>
                        <?php if (!empty($sec['description_' . $lang])): ?><p class="projects-sec-desc"><?= htmlspecialchars($sec['description_' . $lang]) ?></p><?php endif; ?>
                    </div>
                    <div class="<?= $grid ?>">
                        <?php foreach ($secProjects as $p) include PARTIAL_PATH . '/project-card.php'; ?>
                    </div>
                </div>
            <?php endforeach; ?>
            <p class="projects-empty" id="projects-empty" hidden><i class="fas fa-magnifying-glass"></i> <?= t('proj_empty') ?></p>
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
            let anyVisible = false;
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
                anyVisible = anyVisible || visibleCardsInSection > 0;
            });
            document.getElementById('projects-empty').hidden = anyVisible;

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
