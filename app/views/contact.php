<?php include PARTIAL_PATH . '/header.php';
// All copy lives in translations (contact_*), so it is editable in the Visual Editor.
$email = translate('contact_email');
$methods = [
    ['fas fa-envelope', 'mailto:' . $email, 'contact_email', true],
    ['fab fa-linkedin-in', 'https://' . translate('contact_linkedin'), 'contact_linkedin', false],
    ['fab fa-github', 'https://' . translate('contact_github'), 'contact_github', false],
];
?>

<section class="contact-v2">
    <div class="container contact-v2-grid">
        <!-- ── LEFT: intro + direct channels ── -->
        <div class="contact-intro reveal">
            <span class="hero-chip"><?= t('contact_chip') ?></span>
            <h1 class="svc-hero-title"><?= t('contact_heading') ?></h1>
            <p class="about-lead"><?= t('contact_subtitle') ?></p>

            <p class="contact-status"><span class="exp-dot exp-dot--live"></span> <?= t('contact_status') ?></p>

            <h2 class="contact-or"><?= t('contact_or') ?></h2>
            <div class="contact-methods">
                <?php foreach ($methods as [$icon, $href, $key, $copy]): ?>
                    <div class="contact-method">
                        <a href="<?= htmlspecialchars($href) ?>"<?= $copy ? '' : ' target="_blank" rel="noopener"' ?> class="contact-method-link">
                            <span class="project-card-icon"><i class="<?= $icon ?>"></i></span>
                            <span class="contact-method-text"><?= t($key) ?></span>
                        </a>
                        <?php if ($copy): ?>
                            <button type="button" class="contact-copy" data-copy="<?= htmlspecialchars($email) ?>" data-done="<?= htmlspecialchars(translate('contact_copied')) ?>" aria-label="<?= htmlspecialchars(translate('contact_copy')) ?>" title="<?= htmlspecialchars(translate('contact_copy')) ?>"><i class="far fa-copy"></i></button>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="about-facts contact-facts">
                <span><i class="fas fa-location-dot"></i> <?= t('footer_location') ?></span>
                <span><i class="fas fa-clock"></i> <?= t('contact_reply') ?></span>
            </div>
        </div>

        <!-- ── RIGHT: form ── -->
        <div class="contact-form-card reveal">
            <div class="contact-form-head">
                <img src="/assets/images/contact_portrait.webp" alt="<?= htmlspecialchars(translate('hero_name')) ?>" width="56" height="56">
                <div>
                    <h2><?= t('contact_form_title') ?></h2>
                    <p><?= t('contact_reply') ?></p>
                </div>
            </div>

            <?php if (isset($_GET['success'])): ?>
                <div class="alert-success" id="contact-success"><i class="fas fa-check-circle"></i> <?= t('contact_success') ?></div>
            <?php elseif (isset($_GET['error'])): ?>
                <div class="alert-error"><i class="fas fa-circle-exclamation"></i> <?= t('contact_error') ?></div>
            <?php endif; ?>

            <form action="/contact/submit" method="POST" id="contact-form">
                <fieldset class="contact-topics">
                    <legend><?= t('contact_topic_label') ?></legend>
                    <?php for ($n = 1; $n <= 5; $n++): $topic = translate("contact_topic_$n"); ?>
                        <label class="topic-chip">
                            <input type="radio" name="topic" value="<?= htmlspecialchars($topic) ?>"<?= $n === 1 ? ' checked' : '' ?>>
                            <span><?= t("contact_topic_$n") ?></span>
                        </label>
                    <?php endfor; ?>
                </fieldset>

                <div class="contact-row">
                    <div class="form-group">
                        <label for="name"><?= t('form_name') ?></label>
                        <input type="text" id="name" name="name" autocomplete="name" placeholder="<?= htmlspecialchars(translate('form_name_placeholder')) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email"><?= t('form_email') ?></label>
                        <input type="email" id="email" name="email" autocomplete="email" placeholder="<?= htmlspecialchars(translate('form_email_placeholder')) ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="message"><?= t('form_message') ?></label>
                    <textarea id="message" name="message" rows="6" placeholder="<?= htmlspecialchars(translate('form_message_placeholder')) ?>" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary contact-submit" id="btn-submit"><?= t('form_submit') ?> <i class="fas fa-paper-plane"></i></button>
            </form>
        </div>
    </div>
</section>

<script>
document.querySelectorAll('.contact-copy').forEach(btn => btn.addEventListener('click', async () => {
    try {
        await navigator.clipboard.writeText(btn.dataset.copy);
        const icon = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check"></i>';
        btn.title = btn.dataset.done;
        setTimeout(() => { btn.innerHTML = icon; }, 1800);
    } catch (e) { location.href = 'mailto:' + btn.dataset.copy; }
}));
</script>

<?php include PARTIAL_PATH . '/footer.php'; ?>
