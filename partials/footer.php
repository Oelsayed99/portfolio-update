    </main>

    <!-- ── FOOTER ── -->
    <footer class="site-footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <a href="/" class="footer-logo"><img src="/assets/images/brand/logo-group.webp" alt="<?= htmlspecialchars(translate('hero_name')) ?>" width="1200" height="575" loading="lazy"></a>
                    <p><?= t('footer_tagline') ?></p>
                    <div class="footer-socials">
                        <a href="https://<?= translate('contact_github') ?>" target="_blank" rel="noopener" aria-label="GitHub"><i class="fab fa-github"></i></a>
                        <a href="https://<?= translate('contact_linkedin') ?>" target="_blank" rel="noopener" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        <a href="https://www.instagram.com/omar_hesham_turbo/" target="_blank" rel="noopener" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="https://www.facebook.com/omar.turboo.1/" target="_blank" rel="noopener" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="mailto:<?= translate('contact_email') ?>" aria-label="Email"><i class="fas fa-envelope"></i></a>
                    </div>
                </div>

                <nav class="footer-col" aria-label="<?= htmlspecialchars(translate('footer_pages')) ?>">
                    <h3><?= t('footer_pages') ?></h3>
                    <a href="/"><?= t('nav_home') ?></a>
                    <a href="/projects"><?= t('nav_projects') ?></a>
                    <a href="/about"><?= t('nav_about') ?></a>
                    <a href="/services"><?= t('nav_services') ?></a>
                    <a href="/blog"><?= t('nav_blog') ?></a>
                    <a href="/contact"><?= t('nav_contact') ?></a>
                </nav>

                <div class="footer-col">
                    <h3><?= t('footer_services') ?></h3>
                    <a href="/services"><?= t('svc_ai_title') ?></a>
                    <a href="/services"><?= t('svc_web_title') ?></a>
                    <a href="/services"><?= t('svc_bilingual_title') ?></a>
                    <a href="/services"><?= t('svc_hosting_title') ?></a>
                </div>

                <div class="footer-col">
                    <h3><?= t('footer_contact') ?></h3>
                    <a href="mailto:<?= translate('contact_email') ?>" class="footer-email"><i class="fas fa-envelope"></i> <?= t('contact_email') ?></a>
                    <span><i class="fas fa-location-dot"></i> <?= t('footer_location') ?></span>
                    <a href="/contact" class="btn btn-primary footer-cta"><?= t('btn_hire') ?></a>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; <?= date('Y') ?> <?= t('hero_name') ?>. <?= t('footer_rights') ?></p>
                <a href="#" class="footer-top"><?= t('footer_back_top') ?> <i class="fas fa-arrow-up"></i></a>
            </div>
        </div>
    </footer>

    <!-- Main JavaScript -->
    <script src="/assets/js/main.js?v=<?= filemtime(BASE_PATH . '/public/assets/js/main.js') ?>"></script>

    <?php if (isset($_SESSION['admin_user_id']) && isset($_SESSION['admin_editor_active'])): ?>
        <!-- Admin Interaction Logic -->
        <script src="/assets/js/admin.js"></script>
    <?php endif; ?>

</body>
</html>
