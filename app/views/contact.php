<?php include '../partials/header.php'; ?>

<!-- ── CONTACT SECTION ── -->
<section class="contact-section" id="contact">
    <div class="container">
        <div class="contact-card">
            <!-- Left side: Image + Info -->
            <div class="contact-left">
                <div class="contact-portrait-wrapper">
                    <div class="contact-glow"></div>
                    <img src="/assets/images/contact_portrait.png" alt="<?= translate('hero_name') ?>" class="contact-portrait">
                </div>
                <div class="contact-info">
                    <h1 class="contact-heading"><?= t('contact_heading') ?></h1>
                    <p class="contact-subtitle"><?= t('contact_subtitle') ?></p>
                    <div class="contact-links">
                        <a href="mailto:<?= translate('contact_email') ?>" class="contact-link">
                            <i class="fas fa-envelope"></i>
                            <span><?= t('contact_email') ?></span>
                        </a>
                        <a href="https://<?= translate('contact_github') ?>" target="_blank" class="contact-link">
                            <i class="fab fa-github"></i>
                            <span><?= t('contact_github') ?></span>
                        </a>
                        <a href="https://<?= translate('contact_linkedin') ?>" target="_blank" class="contact-link">
                            <i class="fab fa-linkedin"></i>
                            <span><?= t('contact_linkedin') ?></span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right side: Form -->
            <div class="contact-right">
                <?php if (isset($_GET['success'])): ?>
                    <div class="alert-success" id="contact-success">
                        <i class="fas fa-check-circle"></i> <?= translate('contact_success') ?>
                    </div>
                <?php endif; ?>
                
                <form action="/contact/submit" method="POST" id="contact-form">
                    <div class="form-group">
                        <label for="name"><?= translate('form_name') ?></label>
                        <input type="text" id="name" name="name" placeholder="<?= translate('form_name_placeholder') ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email"><?= translate('form_email') ?></label>
                        <input type="email" id="email" name="email" placeholder="<?= translate('form_email_placeholder') ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="message"><?= translate('form_message') ?></label>
                        <textarea id="message" name="message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-submit" id="btn-submit"><?= translate('form_submit') ?></button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include '../partials/footer.php'; ?>
