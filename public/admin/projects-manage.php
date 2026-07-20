<?php
require_once 'layout.php';

use app\models\Project;
use app\models\ProjectSection;
use app\models\ProjectStatus;
use app\models\Technology;
use app\models\Tag;

$msg = '';
$err = '';

// Handle actions
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    Project::delete($id);
    $msg = 'Project deleted successfully.';
}

if (isset($_GET['duplicate'])) {
    $id = (int)$_GET['duplicate'];
    if (Project::duplicate($id)) {
        $msg = 'Project duplicated successfully.';
    } else {
        $err = 'Failed to duplicate project.';
    }
}

if (isset($_GET['archive'])) {
    $id = (int)$_GET['archive'];
    Project::archive($id);
    $msg = 'Project archived successfully.';
}

if (isset($_GET['remove_image']) && isset($_GET['edit'])) {
    $imageId = (int)$_GET['remove_image'];
    $editId = (int)$_GET['edit'];
    $img = Project::connect()->query("SELECT image FROM project_images WHERE id = " . $imageId)->fetch();
    if ($img) {
        $filepath = $img['image'];
        if (!empty($filepath) && strpos($filepath, 'http') !== 0) {
            $fullPath = dirname(dirname(__DIR__)) . '/public' . $filepath;
            if (is_file($fullPath)) {
                @unlink($fullPath);
            }
        }
    }
    Project::connect()->query("DELETE FROM project_images WHERE id = " . $imageId);
    header("Location: ?edit=" . $editId);
    exit;
}

// Handle Form Submission (Create or Update)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_project'])) {
    try {
        $projectId = isset($_POST['id']) ? (int)$_POST['id'] : null;

        // Process file uploads
        $thumbnail = $_POST['thumbnail_url'] ?? '';
        if (isset($_FILES['thumbnail_file']) && $_FILES['thumbnail_file']['error'] === UPLOAD_ERR_OK) {
            $thumbnail = handle_upload($_FILES['thumbnail_file'], 'projects');
        }

        $heroImage = $_POST['hero_image_url'] ?? '';
        if (isset($_FILES['hero_image_file']) && $_FILES['hero_image_file']['error'] === UPLOAD_ERR_OK) {
            $heroImage = handle_upload($_FILES['hero_image_file'], 'projects');
        }

        $showcaseVideo = $_POST['showcase_video_url'] ?? '';
        if (isset($_FILES['showcase_video_file']) && $_FILES['showcase_video_file']['error'] === UPLOAD_ERR_OK) {
            $showcaseVideo = handle_upload($_FILES['showcase_video_file'], 'projects');
        }

        // Build data array
        $data = [
            'title_en' => $_POST['title_en'] ?? '',
            'title_ar' => $_POST['title_ar'] ?? '',
            'slug' => $_POST['slug'] ?? '',
            'section_id' => (int)$_POST['section_id'],
            'status_id' => (int)$_POST['status_id'],
            'featured_order' => !empty($_POST['featured_order']) ? (int)$_POST['featured_order'] : null,
            'visibility' => $_POST['visibility'] ?? 'published',
            'thumbnail' => $thumbnail,
            'hero_image' => $heroImage,
            'showcase_video' => $showcaseVideo,
            'description_en' => $_POST['description_en'] ?? '',
            'description_ar' => $_POST['description_ar'] ?? '',
            'short_description_en' => $_POST['short_description_en'] ?? '',
            'short_description_ar' => $_POST['short_description_ar'] ?? '',
            'problem_en' => $_POST['problem_en'] ?? '',
            'problem_ar' => $_POST['problem_ar'] ?? '',
            'solution_en' => $_POST['solution_en'] ?? '',
            'solution_ar' => $_POST['solution_ar'] ?? '',
            'architecture_en' => $_POST['architecture_en'] ?? '',
            'architecture_ar' => $_POST['architecture_ar'] ?? '',
            'challenges_en' => $_POST['challenges_en'] ?? '',
            'challenges_ar' => $_POST['challenges_ar'] ?? '',
            'lessons_learned_en' => $_POST['lessons_learned_en'] ?? '',
            'lessons_learned_ar' => $_POST['lessons_learned_ar'] ?? '',
            'my_role_en' => $_POST['my_role_en'] ?? '',
            'my_role_ar' => $_POST['my_role_ar'] ?? '',
            'company_en' => $_POST['company_en'] ?? '',
            'company_ar' => $_POST['company_ar'] ?? '',
            'client_en' => $_POST['client_en'] ?? '',
            'client_ar' => $_POST['client_ar'] ?? '',
            'duration_en' => $_POST['duration_en'] ?? '',
            'duration_ar' => $_POST['duration_ar'] ?? '',
            'team_size' => (int)($_POST['team_size'] ?? 1),
            'contribution_percentage' => (int)($_POST['contribution_percentage'] ?? 100),
            'countries_used' => $_POST['countries_used'] ?? '',
            'user_count' => (int)($_POST['user_count'] ?? 0),
            'performance_score' => (int)($_POST['performance_score'] ?? 90),
            'completion_percentage' => (int)($_POST['completion_percentage'] ?? 100),
            'display_order' => (int)($_POST['display_order'] ?? 0),
            'seo_title_en' => $_POST['seo_title_en'] ?? '',
            'seo_title_ar' => $_POST['seo_title_ar'] ?? '',
            'seo_description_en' => $_POST['seo_description_en'] ?? '',
            'seo_description_ar' => $_POST['seo_description_ar'] ?? '',
            'canonical_url' => $_POST['canonical_url'] ?? '',
            'og_image' => $_POST['og_image'] ?? '',
            'twitter_image' => $_POST['twitter_image'] ?? '',
            'keywords' => $_POST['keywords'] ?? '',
            'structured_data' => $_POST['structured_data'] ?? '',
            'project_url' => $_POST['project_url'] ?? '',
            'github_url' => $_POST['github_url'] ?? '',
            'case_study_url' => $_POST['case_study_url'] ?? '',
            'demo_url' => $_POST['demo_url'] ?? '',
            'docs_url' => $_POST['docs_url'] ?? '',
            'figma_url' => $_POST['figma_url'] ?? '',
            'video_url' => $_POST['video_url'] ?? '',
            'technologies' => $_POST['technologies'] ?? [],
            'tags' => $_POST['tags'] ?? []
        ];

        if ($projectId) {
            Project::update($projectId, $data);
            
            // Sync GitHub automatically if URL is provided
            Project::syncGitHub($projectId);
            
            $msg = 'Project updated successfully.';
        } else {
            $newId = Project::create($data);
            Project::syncGitHub($newId);
            $msg = 'Project created successfully.';
        }

        // Handle Gallery Uploads
        $savedId = $projectId ?: $newId;
        if (isset($_FILES['gallery_files'])) {
            $files = $_FILES['gallery_files'];
            for ($i = 0; $i < count($files['name']); $i++) {
                if ($files['error'][$i] === UPLOAD_ERR_OK) {
                    $fakeFile = [
                        'name' => $files['name'][$i],
                        'type' => $files['type'][$i],
                        'tmp_name' => $files['tmp_name'][$i],
                        'error' => $files['error'][$i],
                        'size' => $files['size'][$i]
                    ];
                    $path = handle_upload($fakeFile, 'projects');
                    if ($path) {
                        Project::addImage($savedId, ['image' => $path, 'display_order' => $i]);
                    }
                }
            }
        }

    } catch (Exception $e) {
        $err = 'Error: ' . $e->getMessage();
    }
}

// Fetch current project to edit
$editProject = null;
if (isset($_GET['edit'])) {
    $editProject = Project::find((int)$_GET['edit']);
}

$projects = Project::all();
$sections = ProjectSection::all();
$statuses = ProjectStatus::all();
$technologies = Technology::all();
$tags = Tag::all();

admin_header("Project Management", "projects");
?>

<?php if ($msg): ?>
    <div style="padding:1rem; background:rgba(34,197,94,0.15); color:var(--admin-success); border:1px solid var(--admin-success); border-radius:8px; margin-bottom:1.5rem;"><?= $msg ?></div>
<?php endif; ?>
<?php if ($err): ?>
    <div style="padding:1rem; background:rgba(239,68,68,0.15); color:var(--admin-danger); border:1px solid var(--admin-danger); border-radius:8px; margin-bottom:1.5rem;"><?= $err ?></div>
<?php endif; ?>

<?php if ($editProject || isset($_GET['new'])): 
    $p = $editProject ?: [];
    $pTechIds = isset($p['technologies']) ? array_column($p['technologies'], 'id') : [];
    $pTagIds = isset($p['tags']) ? array_column($p['tags'], 'id') : [];
?>
    <!-- ── EDIT / CREATE VIEW ── -->
    <div class="admin-card">
        <h3><?= $editProject ? 'Edit Project: ' . htmlspecialchars($p['title_en']) : 'Add New Project' ?></h3>
        
        <form method="POST" enctype="multipart/form-data">
            <?php if ($editProject): ?>
                <input type="hidden" name="id" value="<?= $p['id'] ?>">
            <?php endif; ?>

            <!-- Tab Navigation -->
            <div class="tab-nav">
                <button type="button" class="tab-btn active" onclick="switchTab('tab-general')">General</button>
                <button type="button" class="tab-btn" onclick="switchTab('tab-content')">Content</button>
                <button type="button" class="tab-btn" onclick="switchTab('tab-casestudy')">Case Study</button>
                <button type="button" class="tab-btn" onclick="switchTab('tab-gallery')">Gallery</button>
                <button type="button" class="tab-btn" onclick="switchTab('tab-techs')">Tech & Tags</button>
                <button type="button" class="tab-btn" onclick="switchTab('tab-links')">Links</button>
                <button type="button" class="tab-btn" onclick="switchTab('tab-metrics')">Metrics</button>
                <button type="button" class="tab-btn" onclick="switchTab('tab-seo')">SEO</button>
            </div>

            <!-- Tab panes -->
            <!-- 1. GENERAL -->
            <div id="tab-general" class="tab-pane active">
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:1.5rem;">
                    <div class="admin-form-group">
                        <label>Title (English)</label>
                        <input type="text" name="title_en" class="admin-form-control" value="<?= htmlspecialchars($p['title_en'] ?? '') ?>" required>
                    </div>
                    <div class="admin-form-group">
                        <label>Title (Arabic)</label>
                        <input type="text" name="title_ar" class="admin-form-control" value="<?= htmlspecialchars($p['title_ar'] ?? '') ?>" required>
                    </div>
                    <div class="admin-form-group">
                        <label>Slug (Leave empty to auto-generate)</label>
                        <input type="text" name="slug" class="admin-form-control" value="<?= htmlspecialchars($p['slug'] ?? '') ?>">
                    </div>
                    <div class="admin-form-group">
                        <label>Visibility</label>
                        <select name="visibility" class="admin-form-control">
                            <option value="published" <?= ($p['visibility'] ?? '') === 'published' ? 'selected' : '' ?>>Published</option>
                            <option value="draft" <?= ($p['visibility'] ?? '') === 'draft' ? 'selected' : '' ?>>Draft</option>
                            <option value="archived" <?= ($p['visibility'] ?? '') === 'archived' ? 'selected' : '' ?>>Archived</option>
                        </select>
                    </div>
                    <div class="admin-form-group">
                        <label>Project Section</label>
                        <select name="section_id" class="admin-form-control" required>
                            <?php foreach ($sections as $sec): ?>
                                <option value="<?= $sec['id'] ?>" <?= ($p['section_id'] ?? '') == $sec['id'] ? 'selected' : '' ?>><?= htmlspecialchars($sec['name_en']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="admin-form-group">
                        <label>Status</label>
                        <select name="status_id" class="admin-form-control" required>
                            <?php foreach ($statuses as $stat): ?>
                                <option value="<?= $stat['id'] ?>" <?= ($p['status_id'] ?? '') == $stat['id'] ? 'selected' : '' ?>><?= htmlspecialchars($stat['name_en']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="admin-form-group">
                        <label>Featured Order (Leave empty if not featured)</label>
                        <input type="number" name="featured_order" class="admin-form-control" value="<?= htmlspecialchars($p['featured_order'] ?? '') ?>">
                    </div>
                    <div class="admin-form-group">
                        <label>Display Order</label>
                        <input type="number" name="display_order" class="admin-form-control" value="<?= htmlspecialchars($p['display_order'] ?? 0) ?>">
                    </div>
                </div>
            </div>

            <!-- 2. CONTENT -->
            <div id="tab-content" class="tab-pane">
                <div class="admin-form-group">
                    <label>Short Description (English - displayed in project card listings)</label>
                    <textarea name="short_description_en" class="admin-form-control" rows="2"><?= htmlspecialchars($p['short_description_en'] ?? '') ?></textarea>
                </div>
                <div class="admin-form-group">
                    <label>Short Description (Arabic - displayed in project card listings)</label>
                    <textarea name="short_description_ar" class="admin-form-control" rows="2" dir="rtl"><?= htmlspecialchars($p['short_description_ar'] ?? '') ?></textarea>
                </div>
                <div class="admin-form-group">
                    <label>Description / Overview (English - full case study details)</label>
                    <textarea name="description_en" class="admin-form-control" rows="5"><?= htmlspecialchars($p['description_en'] ?? '') ?></textarea>
                </div>
                <div class="admin-form-group">
                    <label>Description / Overview (Arabic - full case study details)</label>
                    <textarea name="description_ar" class="admin-form-control" rows="5" dir="rtl"><?= htmlspecialchars($p['description_ar'] ?? '') ?></textarea>
                </div>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:1.5rem;">
                    <div class="admin-form-group">
                        <label>My Role (English)</label>
                        <input type="text" name="my_role_en" class="admin-form-control" value="<?= htmlspecialchars($p['my_role_en'] ?? '') ?>">
                    </div>
                    <div class="admin-form-group">
                        <label>My Role (Arabic)</label>
                        <input type="text" name="my_role_ar" class="admin-form-control" value="<?= htmlspecialchars($p['my_role_ar'] ?? '') ?>">
                    </div>
                    <div class="admin-form-group">
                        <label>Company (English)</label>
                        <input type="text" name="company_en" class="admin-form-control" value="<?= htmlspecialchars($p['company_en'] ?? '') ?>">
                    </div>
                    <div class="admin-form-group">
                        <label>Company (Arabic)</label>
                        <input type="text" name="company_ar" class="admin-form-control" value="<?= htmlspecialchars($p['company_ar'] ?? '') ?>">
                    </div>
                </div>
            </div>

            <!-- 3. CASE STUDY -->
            <div id="tab-casestudy" class="tab-pane">
                <div class="admin-form-group">
                    <label>Business Problem (English)</label>
                    <textarea name="problem_en" class="admin-form-control" rows="4"><?= htmlspecialchars($p['problem_en'] ?? '') ?></textarea>
                </div>
                <div class="admin-form-group">
                    <label>Business Problem (Arabic)</label>
                    <textarea name="problem_ar" class="admin-form-control" rows="4" dir="rtl"><?= htmlspecialchars($p['problem_ar'] ?? '') ?></textarea>
                </div>
                <div class="admin-form-group">
                    <label>Proposed Solution (English)</label>
                    <textarea name="solution_en" class="admin-form-control" rows="4"><?= htmlspecialchars($p['solution_en'] ?? '') ?></textarea>
                </div>
                <div class="admin-form-group">
                    <label>Proposed Solution (Arabic)</label>
                    <textarea name="solution_ar" class="admin-form-control" rows="4" dir="rtl"><?= htmlspecialchars($p['solution_ar'] ?? '') ?></textarea>
                </div>
                <div class="admin-form-group">
                    <label>System Architecture (English)</label>
                    <textarea name="architecture_en" class="admin-form-control" rows="4"><?= htmlspecialchars($p['architecture_en'] ?? '') ?></textarea>
                </div>
                <div class="admin-form-group">
                    <label>System Architecture (Arabic)</label>
                    <textarea name="architecture_ar" class="admin-form-control" rows="4" dir="rtl"><?= htmlspecialchars($p['architecture_ar'] ?? '') ?></textarea>
                </div>
                <div class="admin-form-group">
                    <label>Technical Challenges (English)</label>
                    <textarea name="challenges_en" class="admin-form-control" rows="4"><?= htmlspecialchars($p['challenges_en'] ?? '') ?></textarea>
                </div>
                <div class="admin-form-group">
                    <label>Technical Challenges (Arabic)</label>
                    <textarea name="challenges_ar" class="admin-form-control" rows="4" dir="rtl"><?= htmlspecialchars($p['challenges_ar'] ?? '') ?></textarea>
                </div>
                <div class="admin-form-group">
                    <label>Lessons Learned (English)</label>
                    <textarea name="lessons_learned_en" class="admin-form-control" rows="4"><?= htmlspecialchars($p['lessons_learned_en'] ?? '') ?></textarea>
                </div>
                <div class="admin-form-group">
                    <label>Lessons Learned (Arabic)</label>
                    <textarea name="lessons_learned_ar" class="admin-form-control" rows="4" dir="rtl"><?= htmlspecialchars($p['lessons_learned_ar'] ?? '') ?></textarea>
                </div>
            </div>

            <!-- 4. GALLERY -->
            <div id="tab-gallery" class="tab-pane">
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:1.5rem;">
                    <div class="admin-form-group">
                        <label>Thumbnail Image URL</label>
                        <input type="text" name="thumbnail_url" class="admin-form-control" value="<?= htmlspecialchars($p['thumbnail'] ?? '') ?>">
                        <label style="margin-top:0.5rem;">Or Upload File</label>
                        <input type="file" name="thumbnail_file" class="admin-form-control">
                    </div>
                    <div class="admin-form-group">
                        <label>Hero Banner Image URL</label>
                        <input type="text" name="hero_image_url" class="admin-form-control" value="<?= htmlspecialchars($p['hero_image'] ?? '') ?>">
                        <label style="margin-top:0.5rem;">Or Upload File</label>
                        <input type="file" name="hero_image_file" class="admin-form-control">
                    </div>
                </div>

                <div class="admin-form-group" style="margin-top:2rem;">
                    <label>Upload Gallery Images (Select Multiple)</label>
                    <input type="file" name="gallery_files[]" class="admin-form-control" multiple>
                </div>

                <div class="admin-form-group" style="margin-top:2rem; border-top:1px dashed var(--admin-border); padding-top:1.5rem;">
                    <label>Showcase Video (MP4/MOV)</label>
                    <input type="text" name="showcase_video_url" class="admin-form-control" value="<?= htmlspecialchars($p['showcase_video'] ?? '') ?>" placeholder="Video Path or URL">
                    <label style="margin-top:0.5rem;">Or Upload Video</label>
                    <input type="file" name="showcase_video_file" class="admin-form-control" accept="video/*">
                </div>

                <?php if (!empty($p['images'])): ?>
                    <label style="font-weight:600; color:var(--admin-text-muted); margin-top:1.5rem; display:block;">Active Gallery Images</label>
                    <div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(120px, 1fr)); gap: 1rem; margin-top:0.5rem;">
                        <?php foreach ($p['images'] as $img): ?>
                            <div style="position:relative; border:1px solid var(--admin-border); border-radius:8px; overflow:hidden; background:#000;">
                                <img src="<?= $img['image'] ?>" style="width:100%; height:100px; object-fit:cover;">
                                <a href="?edit=<?= $p['id'] ?>&remove_image=<?= $img['id'] ?>" style="position:absolute; top:4px; right:4px; background:red; color:#fff; border-radius:50%; width:20px; height:20px; display:flex; justify-content:center; align-items:center; text-decoration:none; font-size:0.75rem;">&times;</a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- 5. TECHS & TAGS -->
            <div id="tab-techs" class="tab-pane">
                <div class="admin-form-group">
                    <label>Select Technologies Used</label>
                    <div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 0.5rem; margin-top:0.5rem;">
                        <?php foreach ($technologies as $t): ?>
                            <label style="display:flex; align-items:center; gap:0.5rem; font-size:0.85rem; cursor:pointer;">
                                <input type="checkbox" name="technologies[]" value="<?= $t['id'] ?>" <?= in_array($t['id'], $pTechIds) ? 'checked' : '' ?>>
                                <i class="<?= $t['icon'] ?>" style="color: <?= $t['color'] ?>"></i> <?= htmlspecialchars($t['name']) ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="admin-form-group" style="margin-top:2rem;">
                    <label>Select Tags</label>
                    <div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 0.5rem; margin-top:0.5rem;">
                        <?php foreach ($tags as $t): ?>
                            <label style="display:flex; align-items:center; gap:0.5rem; font-size:0.85rem; cursor:pointer;">
                                <input type="checkbox" name="tags[]" value="<?= $t['id'] ?>" <?= in_array($t['id'], $pTagIds) ? 'checked' : '' ?>>
                                <?= htmlspecialchars($t['name_en']) ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- 6. LINKS -->
            <div id="tab-links" class="tab-pane">
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:1.5rem;">
                    <div class="admin-form-group">
                        <label>Live Demo Website URL</label>
                        <input type="text" name="project_url" class="admin-form-control" value="<?= htmlspecialchars($p['project_url'] ?? '') ?>">
                    </div>
                    <div class="admin-form-group">
                        <label>GitHub Repository URL</label>
                        <input type="text" name="github_url" class="admin-form-control" value="<?= htmlspecialchars($p['github_url'] ?? '') ?>">
                    </div>
                    <div class="admin-form-group">
                        <label>Documentation URL</label>
                        <input type="text" name="docs_url" class="admin-form-control" value="<?= htmlspecialchars($p['docs_url'] ?? '') ?>">
                    </div>
                    <div class="admin-form-group">
                        <label>Figma Design URL</label>
                        <input type="text" name="figma_url" class="admin-form-control" value="<?= htmlspecialchars($p['figma_url'] ?? '') ?>">
                    </div>

                </div>
            </div>

            <!-- 7. METRICS -->
            <div id="tab-metrics" class="tab-pane">
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:1.5rem;">
                    <div class="admin-form-group">
                        <label>Team Size</label>
                        <input type="number" name="team_size" class="admin-form-control" value="<?= htmlspecialchars($p['team_size'] ?? 1) ?>">
                    </div>
                    <div class="admin-form-group">
                        <label>My Contribution %</label>
                        <input type="number" name="contribution_percentage" class="admin-form-control" value="<?= htmlspecialchars($p['contribution_percentage'] ?? 100) ?>">
                    </div>
                    <div class="admin-form-group">
                        <label>Performance Score (Lighthouse 0-100)</label>
                        <input type="number" name="performance_score" class="admin-form-control" value="<?= htmlspecialchars($p['performance_score'] ?? 95) ?>">
                    </div>
                    <div class="admin-form-group">
                        <label>Active Users Count</label>
                        <input type="number" name="user_count" class="admin-form-control" value="<?= htmlspecialchars($p['user_count'] ?? 0) ?>">
                    </div>
                    <div class="admin-form-group">
                        <label>Completion Percentage %</label>
                        <input type="number" name="completion_percentage" class="admin-form-control" value="<?= htmlspecialchars($p['completion_percentage'] ?? 100) ?>">
                    </div>
                    <div class="admin-form-group">
                        <label>Duration (English)</label>
                        <input type="text" name="duration_en" class="admin-form-control" value="<?= htmlspecialchars($p['duration_en'] ?? '') ?>" placeholder="e.g. 3 Months">
                    </div>
                </div>
            </div>

            <!-- 8. SEO -->
            <div id="tab-seo" class="tab-pane">
                <div class="admin-form-group">
                    <label>SEO Title (English)</label>
                    <input type="text" name="seo_title_en" class="admin-form-control" value="<?= htmlspecialchars($p['seo_title_en'] ?? '') ?>">
                </div>
                <div class="admin-form-group">
                    <label>SEO Description (English)</label>
                    <textarea name="seo_description_en" class="admin-form-control" rows="3"><?= htmlspecialchars($p['seo_description_en'] ?? '') ?></textarea>
                </div>
                <div class="admin-form-group">
                    <label>Canonical URL</label>
                    <input type="text" name="canonical_url" class="admin-form-control" value="<?= htmlspecialchars($p['canonical_url'] ?? '') ?>">
                </div>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:1.5rem;">
                    <div class="admin-form-group">
                        <label>OpenGraph Image URL</label>
                        <input type="text" name="og_image" class="admin-form-control" value="<?= htmlspecialchars($p['og_image'] ?? '') ?>">
                    </div>
                    <div class="admin-form-group">
                        <label>Twitter Card Image URL</label>
                        <input type="text" name="twitter_image" class="admin-form-control" value="<?= htmlspecialchars($p['twitter_image'] ?? '') ?>">
                    </div>
                </div>
                <div class="admin-form-group">
                    <label>Keywords (Comma separated)</label>
                    <input type="text" name="keywords" class="admin-form-control" value="<?= htmlspecialchars($p['keywords'] ?? '') ?>">
                </div>
            </div>

            <!-- Form Actions -->
            <div style="margin-top:2rem; display:flex; gap:1rem; justify-content:flex-end;">
                <a href="/admin/projects-manage.php" class="admin-btn admin-btn-secondary">Cancel</a>
                <button type="submit" name="save_project" class="admin-btn admin-btn-primary">Save Project</button>
            </div>
        </form>
    </div>

<?php else: ?>
    <!-- ── LISTING VIEW ── -->
    <div class="admin-card">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem;">
            <h3>CMS Projects Inventory</h3>
            <a href="?new=1" class="admin-btn admin-btn-primary"><i class="fas fa-plus"></i> Add Project</a>
        </div>

        <div class="admin-table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Display Order</th>
                        <th>Title</th>
                        <th>Section</th>
                        <th>Status</th>
                        <th>Visibility</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($projects as $p): ?>
                        <tr>
                            <td>
                                <strong style="color: var(--admin-primary); font-size:1rem;">#<?= $p['display_order'] ?></strong>
                            </td>
                            <td>
                                <strong><?= htmlspecialchars($p['title_en']) ?></strong>
                                <div style="font-size:0.75rem; color:var(--admin-text-muted);"><?= htmlspecialchars($p['slug']) ?></div>
                            </td>
                            <td><?= htmlspecialchars($p['section_name_en'] ?: 'N/A') ?></td>
                            <td>
                                <span class="admin-badge admin-badge-success">
                                    <?= htmlspecialchars($p['status_name_en']) ?>
                                </span>
                            </td>
                            <td>
                                <span class="admin-badge <?= $p['visibility'] === 'published' ? 'admin-badge-success' : ($p['visibility'] === 'draft' ? 'admin-badge-warning' : 'admin-badge-danger') ?>">
                                    <?= htmlspecialchars($p['visibility']) ?>
                                </span>
                            </td>
                            <td>
                                <div class="listing-actions-cell">
                                    <a href="?edit=<?= $p['id'] ?>" class="admin-btn admin-btn-secondary" style="padding:0.4rem; font-size:0.8rem;" title="Edit"><i class="fas fa-edit"></i></a>
                                    <a href="?duplicate=<?= $p['id'] ?>" class="admin-btn admin-btn-secondary" style="padding:0.4rem; font-size:0.8rem; color:var(--admin-success);" title="Duplicate"><i class="fas fa-copy"></i></a>
                                    <a href="?archive=<?= $p['id'] ?>" class="admin-btn admin-btn-secondary" style="padding:0.4rem; font-size:0.8rem; color:var(--admin-warning);" title="Archive"><i class="fas fa-box-archive"></i></a>
                                    <a href="?delete=<?= $p['id'] ?>" class="admin-btn admin-btn-danger" style="padding:0.4rem; font-size:0.8rem;" onclick="return confirm('Are you sure you want to delete this project?')" title="Delete"><i class="fas fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php endif; ?>

<!-- Tabs Switcher JS -->
<script>
function switchTab(tabId) {
    // Hide all panes
    document.querySelectorAll('.tab-pane').forEach(pane => {
        pane.classList.remove('active');
    });
    // Deactivate all buttons
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    // Activate target
    document.getElementById(tabId).classList.add('active');
    // Find matching button
    event.currentTarget.classList.add('active');
}
</script>

<?php
admin_footer();
?>
