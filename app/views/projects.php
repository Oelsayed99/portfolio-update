<?php include '../partials/header.php'; ?>

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
            <!-- Server Management Dashboard -->
            <div class="pro-card" id="proj-server">
                <div class="pro-card-icons">
                    <i class="fab fa-linux"></i>
                    <i class="fab fa-docker"></i>
                    <i class="fas fa-dharmachakra"></i>
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3 class="pro-card-title"><?= translate('proj_server_title') ?></h3>
                <p class="pro-card-tech"><?= translate('proj_server_tech') ?></p>
                <span class="pro-card-badge"><?= translate('projects_restricted') ?></span>
            </div>
            <!-- Secure Webmail Client -->
            <div class="pro-card" id="proj-webmail">
                <div class="pro-card-icons">
                    <i class="fab fa-react"></i>
                    <i class="fab fa-node-js"></i>
                    <i class="fas fa-database"></i>
                    <i class="fas fa-shield-halved"></i>
                </div>
                <h3 class="pro-card-title"><?= translate('proj_webmail_title') ?></h3>
                <p class="pro-card-tech"><?= translate('proj_webmail_tech') ?></p>
                <span class="pro-card-badge"><?= translate('projects_restricted') ?></span>
            </div>
            <!-- Enterprise CRM -->
            <div class="pro-card" id="proj-crm">
                <div class="pro-card-icons">
                    <i class="fab fa-angular"></i>
                    <i class="fab fa-python"></i>
                    <i class="fab fa-aws"></i>
                </div>
                <h3 class="pro-card-title"><?= translate('proj_crm_title') ?></h3>
                <p class="pro-card-tech"><?= translate('proj_crm_tech') ?></p>
                <span class="pro-card-badge"><?= translate('projects_restricted') ?></span>
            </div>
        </div>
    </div>
</section>

<!-- ── LIVE PROJECTS ── -->
<section class="projects-section" id="live-projects">
    <div class="container">
        <h2 class="projects-section-title"><?= translate('projects_live_title') ?></h2>
        <div class="live-grid">
            <!-- Fashion Hub -->
            <div class="live-card" id="proj-fashion">
                <div class="live-card-image">
                    <img src="/assets/images/proj_fashion.png" alt="<?= translate('proj_fashion_title') ?>">
                </div>
                <div class="live-card-info">
                    <h3><?= translate('proj_fashion_title') ?></h3>
                    <p><?= translate('proj_fashion_desc') ?></p>
                    <a href="#" class="btn btn-accent btn-sm"><?= translate('btn_view_live') ?></a>
                </div>
            </div>
            <!-- Travel Booking -->
            <div class="live-card" id="proj-travel">
                <div class="live-card-image">
                    <img src="/assets/images/proj_travel.png" alt="<?= translate('proj_travel_title') ?>">
                </div>
                <div class="live-card-info">
                    <h3><?= translate('proj_travel_title') ?></h3>
                    <p><?= translate('proj_travel_desc') ?></p>
                    <a href="#" class="btn btn-accent btn-sm"><?= translate('btn_view_live') ?></a>
                </div>
            </div>
            <!-- AI Chatbot -->
            <div class="live-card" id="proj-chatbot">
                <div class="live-card-image">
                    <img src="/assets/images/proj_chatbot.png" alt="<?= translate('proj_chatbot_title') ?>">
                </div>
                <div class="live-card-info">
                    <h3><?= translate('proj_chatbot_title') ?></h3>
                    <p><?= translate('proj_chatbot_desc') ?></p>
                    <a href="#" class="btn btn-accent btn-sm"><?= translate('btn_view_live') ?></a>
                </div>
            </div>
            <!-- Data Visualization -->
            <div class="live-card" id="proj-data">
                <div class="live-card-image">
                    <img src="/assets/images/proj_data.png" alt="<?= translate('proj_data_title') ?>">
                </div>
                <div class="live-card-info">
                    <h3><?= translate('proj_data_title') ?></h3>
                    <p><?= translate('proj_data_desc') ?></p>
                    <a href="#" class="btn btn-accent btn-sm"><?= translate('btn_view_live') ?></a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include '../partials/footer.php'; ?>
