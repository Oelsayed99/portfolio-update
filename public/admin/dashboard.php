<?php
require_once 'layout.php';

use app\models\Project;
use app\models\Technology;
use app\models\ProjectSection;

// Fetch stats
$db = app\models\Project::connect();
$totalProjects = $db->query("SELECT COUNT(*) FROM projects")->fetchColumn();
$publishedCount = $db->query("SELECT COUNT(*) FROM projects WHERE visibility = 'published'")->fetchColumn();
$draftCount = $db->query("SELECT COUNT(*) FROM projects WHERE visibility = 'draft'")->fetchColumn();
$featuredCount = $db->query("SELECT COUNT(*) FROM projects WHERE featured_order IS NOT NULL")->fetchColumn();
$techCount = $db->query("SELECT COUNT(*) FROM technologies")->fetchColumn();
$sectionsCount = $db->query("SELECT COUNT(*) FROM project_sections")->fetchColumn();

// Fetch recently updated projects
$recentProjects = $db->query("SELECT p.*, s.name_en AS section_name_en FROM projects p LEFT JOIN project_sections s ON p.section_id = s.id ORDER BY p.updated_at DESC LIMIT 5")->fetchAll();

admin_header("Overview Dashboard", "dashboard");
?>

<div class="admin-stats-grid">
    <div class="stat-card">
        <div class="stat-icon-wrapper"><i class="fas fa-briefcase"></i></div>
        <div class="stat-info">
            <span class="stat-value"><?= $totalProjects ?></span>
            <span class="stat-label">Total Projects</span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon-wrapper" style="color:var(--admin-success); background:rgba(34, 197, 94, 0.1);"><i class="fas fa-circle-check"></i></div>
        <div class="stat-info">
            <span class="stat-value"><?= $publishedCount ?></span>
            <span class="stat-label">Published</span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon-wrapper" style="color:var(--admin-warning); background:rgba(245, 158, 11, 0.1);"><i class="fas fa-file-signature"></i></div>
        <div class="stat-info">
            <span class="stat-value"><?= $draftCount ?></span>
            <span class="stat-label">Drafts</span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon-wrapper" style="color:var(--admin-primary); background:rgba(168, 85, 247, 0.1);"><i class="fas fa-star"></i></div>
        <div class="stat-info">
            <span class="stat-value"><?= $featuredCount ?></span>
            <span class="stat-label">Featured Showcase</span>
        </div>
    </div>
</div>

<div class="admin-stats-grid" style="grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));">

    <div class="stat-card">
        <div class="stat-icon-wrapper"><i class="fas fa-code"></i></div>
        <div class="stat-info">
            <span class="stat-value"><?= $techCount ?></span>
            <span class="stat-label">Technologies</span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon-wrapper"><i class="fas fa-list"></i></div>
        <div class="stat-info">
            <span class="stat-value"><?= $sectionsCount ?></span>
            <span class="stat-label">Custom Sections</span>
        </div>
    </div>
</div>

<div class="admin-card">
    <h3>Recently Updated Projects</h3>
    <div class="admin-table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Section</th>
                    <th>Status</th>
                    <th>Visibility</th>
                    <th>Last Update</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recentProjects as $p): ?>
                    <tr>
                        <td><strong><?= htmlspecialchars($p['title_en']) ?></strong></td>
                        <td><?= htmlspecialchars($p['section_name_en'] ?: 'N/A') ?></td>
                        <td>
                            <span class="admin-badge admin-badge-success">Active</span>
                        </td>
                        <td>
                            <span class="admin-badge <?= $p['visibility'] === 'published' ? 'admin-badge-success' : 'admin-badge-warning' ?>">
                                <?= htmlspecialchars($p['visibility']) ?>
                            </span>
                        </td>
                        <td><?= htmlspecialchars($p['updated_at']) ?></td>
                        <td>
                            <a href="/admin/projects-manage.php?edit=<?= $p['id'] ?>" class="admin-btn admin-btn-secondary" style="padding:0.3rem 0.6rem; font-size:0.8rem;"><i class="fas fa-edit"></i> Edit</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
admin_footer();
?>
