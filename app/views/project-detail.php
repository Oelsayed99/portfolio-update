<?php
include PARTIAL_PATH . '/header.php';
$lang = get_current_lang();
$gh = json_decode($project['structured_data'] ?? '{}', true);
?>

<style>
.detail-hero-content {
    position: relative;
}
.hero-video-trigger {
    position: absolute;
    right: 2rem;
    top: 50%;
    transform: translateY(-50%);
    z-index: 10;
    cursor: pointer;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
}
.video-play-btn {
    background: #a855f7;
    border: 2px solid #fff;
    border-radius: 50%;
    width: 64px;
    height: 64px;
    display: flex;
    justify-content: center;
    align-items: center;
    box-shadow: 0 4px 20px rgba(0,0,0,0.4);
    transition: transform 0.2s, background-color 0.2s;
}
.video-play-btn i {
    color: #fff;
    font-size: 1.5rem;
    margin-left: 4px;
}
.hero-video-trigger:hover .video-play-btn {
    transform: scale(1.1);
    background: #9333ea;
}
.hero-video-trigger span {
    font-size: 0.75rem;
    font-weight: 700;
    color: #fff;
    text-shadow: 0 2px 4px rgba(0,0,0,0.8);
    text-transform: uppercase;
    letter-spacing: 1px;
}

@media(max-width: 768px) {
    .hero-video-trigger {
        position: static;
        transform: none;
        margin-top: 1.5rem;
        display: flex;
        flex-direction: row;
        align-items: center;
    }
    .video-play-btn {
        width: 48px;
        height: 48px;
    }
    .video-play-btn i {
        font-size: 1.1rem;
    }
}
</style>

<!-- ── CASE STUDY HERO ── -->
<section class="project-detail-hero" style="background-image: url('<?= $project['hero_image'] ?: ($project['thumbnail'] ?: '/assets/images/default_project.png') ?>');">
    <div class="container detail-hero-content">
        <?php if (!empty($project['showcase_video'])): ?>
            <div class="hero-video-trigger" onclick="handleVideoClick('<?= htmlspecialchars($project['showcase_video']) ?>')">
                <div class="video-play-btn">
                    <i class="fas fa-play"></i>
                </div>
                <span><?= $lang === 'ar' ? 'عرض الفيديو' : 'Watch Showcase' ?></span>
            </div>
        <?php endif; ?>
        
        <a href="/projects" class="detail-back-link"><i class="fas fa-arrow-left"></i> <?= $lang === 'ar' ? 'العودة للمشاريع' : 'Back to Projects' ?></a>
        <h1 class="detail-heading"><?= htmlspecialchars($project['title_' . $lang]) ?></h1>
        
        <div class="detail-hero-meta">
            <?php if (!empty($project['company_' . $lang])): ?>
                <div class="detail-meta-item">
                    <i class="fas fa-building"></i>
                    <span><?= htmlspecialchars($project['company_' . $lang]) ?></span>
                </div>
            <?php endif; ?>
            <div class="detail-meta-item">
                <i class="fas fa-tag"></i>
                <span class="badge-sec" style="position: static;"><?= htmlspecialchars($project['section_name_' . $lang]) ?></span>
            </div>
            <div class="detail-meta-item">
                <i class="fas fa-tasks"></i>
                <span><?= htmlspecialchars($project['status_name_' . $lang]) ?></span>
            </div>
        </div>

        <?php if (!empty($project['tags'])): ?>
            <div class="detail-hero-tags" style="display:flex; gap:0.5rem; flex-wrap:wrap; margin-top:1rem;">
                <?php foreach ($project['tags'] as $tag): ?>
                    <span class="tag-badge" style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.75rem; color: #d4d4d8;">
                        #<?= htmlspecialchars($tag['name_' . $lang]) ?>
                    </span>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<div class="container">
    <div class="project-detail-grid">
        <!-- ── MAIN CASE STUDY CONTENT ── -->
        <main class="detail-main-content">
            
            <!-- Description -->
            <section class="detail-section">
                <h2 class="detail-sec-title"><?= $lang === 'ar' ? 'نظرة عامة' : 'Project Overview' ?></h2>
                <div class="detail-sec-text"><?= nl2br(htmlspecialchars($project['description_' . $lang])) ?></div>
            </section>

            <!-- Business Problem -->
            <?php if (!empty($project['problem_' . $lang])): ?>
                <section class="detail-section">
                    <h2 class="detail-sec-title"><?= $lang === 'ar' ? 'المشكلة التجارية' : 'Business Problem' ?></h2>
                    <div class="detail-sec-text"><?= nl2br(htmlspecialchars($project['problem_' . $lang])) ?></div>
                </section>
            <?php endif; ?>

            <!-- Solution -->
            <?php if (!empty($project['solution_' . $lang])): ?>
                <section class="detail-section">
                    <h2 class="detail-sec-title"><?= $lang === 'ar' ? 'الحل المقترح' : 'Proposed Solution' ?></h2>
                    <div class="detail-sec-text"><?= nl2br(htmlspecialchars($project['solution_' . $lang])) ?></div>
                </section>
            <?php endif; ?>

            <!-- Architecture Diagram / Specs -->
            <?php if (!empty($project['architecture_' . $lang])): ?>
                <section class="detail-section">
                    <h2 class="detail-sec-title"><?= $lang === 'ar' ? 'بنية النظام' : 'System Architecture' ?></h2>
                    <div class="detail-sec-text"><?= nl2br(htmlspecialchars($project['architecture_' . $lang])) ?></div>
                </section>
            <?php endif; ?>

            <!-- Challenges -->
            <?php if (!empty($project['challenges_' . $lang])): ?>
                <section class="detail-section">
                    <h2 class="detail-sec-title"><?= $lang === 'ar' ? 'التحديات الفنية' : 'Technical Challenges' ?></h2>
                    <div class="detail-sec-text"><?= nl2br(htmlspecialchars($project['challenges_' . $lang])) ?></div>
                </section>
            <?php endif; ?>

            <!-- Lessons Learned -->
            <?php if (!empty($project['lessons_learned_' . $lang])): ?>
                <section class="detail-section">
                    <h2 class="detail-sec-title"><?= $lang === 'ar' ? 'الدروس المستفادة' : 'Lessons Learned' ?></h2>
                    <div class="detail-sec-text"><?= nl2br(htmlspecialchars($project['lessons_learned_' . $lang])) ?></div>
                </section>
            <?php endif; ?>

            <!-- Gallery -->
            <?php if (!empty($project['images'])): ?>
                <section class="project-gallery-carousel">
                    <h2 class="detail-sec-title"><?= $lang === 'ar' ? 'معرض الصور' : 'Project Gallery' ?></h2>
                    <div class="gallery-grid-new">
                        <?php foreach ($project['images'] as $img): ?>
                            <div class="gallery-item-new" onclick="openLightbox('<?= $img['image'] ?>')">
                                <img src="<?= $img['image'] ?>" alt="<?= htmlspecialchars($img['alt_text_' . $lang] ?: $project['title_' . $lang]) ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php endif; ?>

        </main>

        <!-- ── SIDEBAR METRICS BOARD ── -->
        <aside class="project-metrics-sidebar">
            <h3 class="sidebar-title"><?= $lang === 'ar' ? 'مؤشرات المشروع' : 'Project Metrics' ?></h3>
            <div class="metrics-list">
                
                <?php if (!empty($project['my_role_' . $lang])): ?>
                    <div class="metric-item">
                        <span class="metric-label"><?= $lang === 'ar' ? 'دوري' : 'My Role' ?></span>
                        <span class="metric-value"><?= htmlspecialchars($project['my_role_' . $lang]) ?></span>
                    </div>
                <?php endif; ?>

                <?php if (!empty($project['duration_' . $lang])): ?>
                    <div class="metric-item">
                        <span class="metric-label"><?= $lang === 'ar' ? 'المدة' : 'Duration' ?></span>
                        <span class="metric-value"><?= htmlspecialchars($project['duration_' . $lang]) ?></span>
                    </div>
                <?php endif; ?>

                <?php if ($project['team_size'] > 0): ?>
                    <div class="metric-item">
                        <span class="metric-label"><?= $lang === 'ar' ? 'حجم الفريق' : 'Team Size' ?></span>
                        <span class="metric-value"><?= $project['team_size'] ?> <?= $lang === 'ar' ? 'أعضاء' : 'Members' ?></span>
                    </div>
                <?php endif; ?>

                <?php if ($project['contribution_percentage'] > 0): ?>
                    <div class="metric-item">
                        <span class="metric-label"><?= $lang === 'ar' ? 'نسبة مساهمتي' : 'My Contribution' ?></span>
                        <span class="metric-value"><?= $project['contribution_percentage'] ?>%</span>
                    </div>
                <?php endif; ?>

                <?php if ($project['performance_score'] > 0): ?>
                    <div class="metric-item">
                        <span class="metric-label"><?= $lang === 'ar' ? 'مؤشر الأداء (Lighthouse)' : 'Performance Score' ?></span>
                        <span class="metric-value" style="color: #22c55e; font-weight: 700;"><i class="fas fa-gauge-high"></i> <?= $project['performance_score'] ?>/100</span>
                    </div>
                <?php endif; ?>

                <?php if ($project['user_count'] > 0): ?>
                    <div class="metric-item">
                        <span class="metric-label"><?= $lang === 'ar' ? 'عدد المستخدمين' : 'Active Users' ?></span>
                        <span class="metric-value"><?= number_format($project['user_count']) ?>+</span>
                    </div>
                <?php endif; ?>
            </div>

            <?php if (!empty($project['technologies'])): ?>
                <div class="sidebar-tech" style="margin-top: 2rem; margin-bottom: 2rem;">
                    <h4 style="font-size: 0.85rem; text-transform: uppercase; color: var(--admin-text-muted); margin-bottom: 0.75rem; font-weight: 700;"><?= $lang === 'ar' ? 'التقنيات المستخدمة' : 'Technologies Used' ?></h4>
                    <div style="display:flex; gap:0.5rem; flex-wrap:wrap;">
                        <?php foreach ($project['technologies'] as $tech): ?>
                            <span class="tech-badge" style="border-color: <?= $tech['color'] ?>33; background: <?= $tech['color'] ?>11; color: var(--text-color); padding: 0.35rem 0.75rem; border-radius: 8px; font-size: 0.8rem; display: inline-flex; align-items: center; gap: 0.4rem; border: 1px solid;">
                                <i class="<?= $tech['icon'] ?>" style="color: <?= $tech['color'] ?>"></i> <?= htmlspecialchars($tech['name']) ?>
                            </span>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Links -->
            <div class="sidebar-links">
                <?php if (!empty($project['project_url'])): ?>
                    <a href="<?= $project['project_url'] ?>" target="_blank" class="btn btn-primary" style="width: 100%; text-align: center;"><i class="fas fa-external-link-alt"></i> <?= $lang === 'ar' ? 'رابط مباشر' : 'Live Website' ?></a>
                <?php endif; ?>

                <?php if (!empty($project['github_url'])): ?>
                    <a href="<?= $project['github_url'] ?>" target="_blank" class="btn btn-outline" style="width: 100%; text-align: center;"><i class="fab fa-github"></i> GitHub Code</a>
                <?php endif; ?>

                <?php if (!empty($project['figma_url'])): ?>
                    <a href="<?= $project['figma_url'] ?>" target="_blank" class="btn btn-outline" style="width: 100%; text-align: center; color: #f24e1e; border-color: #f24e1e33;"><i class="fab fa-figma"></i> Figma Designs</a>
                <?php endif; ?>

                <?php if (!empty($project['docs_url'])): ?>
                    <a href="<?= $project['docs_url'] ?>" target="_blank" class="btn btn-outline" style="width: 100%; text-align: center;"><i class="fas fa-book"></i> Documentation</a>
                <?php endif; ?>
            </div>
        </aside>
    </div>

    <!-- Related Projects -->
    <?php if (!empty($relatedProjects)): ?>
        <section class="projects-section-container" style="border-top: 1px solid var(--border); padding-top: 3.5rem;">
            <h2 class="detail-sec-title" style="margin-bottom: 2rem; border-left: none; padding-left: 0; text-align: center;"><?= $lang === 'ar' ? 'مشاريع ذات صلة' : 'Related Projects' ?></h2>
            <div class="personal-grid-new" style="margin-bottom: 5rem;">
                <?php foreach ($relatedProjects as $p): ?>
                    <div class="project-card-new">
                        <div class="project-card-image">
                            <img src="<?= $p['thumbnail'] ?: '/assets/images/default_project.png' ?>" alt="<?= htmlspecialchars($p['title_' . $lang]) ?>">
                        </div>
                        <div class="project-card-body">
                            <h3 class="project-card-title-new"><?= htmlspecialchars($p['title_' . $lang]) ?></h3>
                            <p class="project-card-description"><?= htmlspecialchars(substr($p['short_description_' . $lang] ?: $p['description_' . $lang], 0, 100)) ?>...</p>
                            <a href="/projects/<?= $p['slug'] ?>" class="btn btn-primary"><?= $lang === 'ar' ? 'عرض دراسة الحالة' : 'View Case Study' ?></a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>
</div>

<!-- Reusable Lightbox -->
<div id="gallery-lightbox" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.9); z-index:9999; justify-content:center; align-items:center;" onclick="closeLightbox()">
    <img id="lightbox-img" src="" style="max-width:90%; max-height:90%; border-radius:8px; border: 1px solid rgba(255,255,255,0.1);">
</div>

<script>
function openLightbox(src) {
    document.getElementById('lightbox-img').src = src;
    document.getElementById('gallery-lightbox').style.display = 'flex';
}
function closeLightbox() {
    document.getElementById('gallery-lightbox').style.display = 'none';
}

function openVideoModal(videoSrc) {
    const modal = document.getElementById('video-showcase-modal');
    const player = document.getElementById('modal-video-player');
    player.src = videoSrc;
    modal.style.display = 'flex';
    player.play().catch(e => console.log("Video autoplay blocked:", e));
}
function closeVideoModal() {
    const modal = document.getElementById('video-showcase-modal');
    const player = document.getElementById('modal-video-player');
    player.pause();
    player.src = '';
    modal.style.display = 'none';
}

function handleVideoClick(videoSrc) {
    if (videoSrc.startsWith('http://') || videoSrc.startsWith('https://')) {
        window.open(videoSrc, '_blank');
    } else {
        openVideoModal(videoSrc);
    }
}
</script>

<!-- Video Showcase Modal -->
<div id="video-showcase-modal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.95); z-index:100000; justify-content:center; align-items:flex-start; padding-top:10vh;" onclick="if(event.target===this) closeVideoModal();">
    <div style="position:relative; width:90%; max-width:850px; background:#000; border-radius:16px; border:1px solid #27272a; overflow:visible; box-shadow:0 25px 50px -12px rgba(0,0,0,0.5);">
        <button onclick="closeVideoModal()" style="position:absolute; top:-48px; right:0; z-index:100001; background:rgba(24,24,27,0.8); color:#fff; border:1px solid #3f3f46; border-radius:50%; width:36px; height:36px; font-size:1.4rem; cursor:pointer; display:flex; justify-content:center; align-items:center; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#ef4444'" onmouseout="this.style.backgroundColor='rgba(24,24,27,0.8)'">&times;</button>
        <video id="modal-video-player" src="" controls preload="metadata" playsinline style="width:100%; display:block; aspect-ratio:16/9; background:#000; border-radius:16px;"></video>
    </div>
</div>

<?php include PARTIAL_PATH . '/footer.php'; ?>
