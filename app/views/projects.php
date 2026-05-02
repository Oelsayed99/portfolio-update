<?php 
include '../partials/header.php'; 
use app\models\Project;

$proProjects = Project::getByType('pro');
$liveProjects = Project::getByType('live');
$lang = get_current_lang();
?>

<!-- ── PROJECTS HEADER ── -->
<section class="projects-header" id="projects-header">
    <div class="container">
        <h1 class="projects-heading"><?= translate('projects_heading') ?></h1>
        <p class="projects-subtitle"><?= translate('projects_subtitle') ?></p>
    </div>
</section>

<!-- ── PROFESSIONAL SYSTEMS ── -->
<section class="projects-section" id="professional-systems">
    <div class="container">
        <h2 class="projects-section-title"><?= translate('projects_pro_title') ?></h2>
        <div class="pro-grid">
            <?php foreach ($proProjects as $p): ?>
            <div class="pro-card">
                <div class="pro-card-icons">
                    <?php 
                    $icons = explode(',', $p['icons']);
                    $brands = ['linux', 'docker', 'github', 'linkedin', 'facebook', 'twitter', 'instagram', 'youtube', 'free-code-camp', 'google', 'aws', 'python', 'js', 'react', 'node-js', 'angular', 'php', 'npm', 'yarn', 'bootstrap', 'sass', 'figma'];
                    
                    foreach ($icons as $icon): 
                        $icon = trim($icon);
                        if (empty($icon)) continue;

                        // Check if it already has a prefix (fas, fab, far)
                        $hasPrefix = preg_match('/^(fas|fab|far|fa)\s+/', $icon) || preg_match('/^(fas|fab|far|fa)-/', $icon);
                        
                        if (!$hasPrefix) {
                            // Add fa- if missing
                            if (strpos($icon, 'fa-') !== 0) {
                                $iconName = $icon;
                                $icon = 'fa-' . $icon;
                            } else {
                                $iconName = substr($icon, 3);
                            }

                            // Determine if it should be fab or fas
                            $isBrand = false;
                            foreach ($brands as $brand) {
                                if (strpos($iconName, $brand) !== false) {
                                    $isBrand = true;
                                    break;
                                }
                            }
                            $icon = ($isBrand ? 'fab ' : 'fas ') . $icon;
                        }
                    ?>
                        <i class="<?= $icon ?>"></i>
                    <?php endforeach; ?>
                </div>
                <h3 class="pro-card-title"><?= $p['title_'.$lang] ?></h3>

                <p class="pro-card-tech"><?= $p['tech_'.$lang] ?></p>
                <span class="pro-card-badge"><?= translate('projects_restricted') ?></span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ── LIVE PROJECTS ── -->
<section class="projects-section" id="live-projects">
    <div class="container">
        <h2 class="projects-section-title"><?= translate('projects_live_title') ?></h2>
        <div class="live-grid">
            <?php foreach ($liveProjects as $p): ?>
            <div class="live-card">
                <div class="live-card-image">
                    <img src="<?= $p['image'] ?>" alt="<?= $p['title_'.$lang] ?>">
                </div>
                <div class="live-card-info">
                    <h3><?= $p['title_'.$lang] ?></h3>
                    <p><?= $p['description_'.$lang] ?></p>
                    <a href="<?= $p['link'] ?>" class="btn btn-accent btn-sm"><?= translate('btn_view_live') ?></a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<?php include '../partials/footer.php'; ?>
