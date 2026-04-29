    </main>

    <!-- ── FOOTER ── -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-bottom">
                    <p>&copy; <?= date('Y') ?> <?= translate('hero_name') ?>. <?= translate('footer_rights') ?></p>
                </div>
                <div class="footer-socials">
                    <a href="https://instagram.com/omarelsayed" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="https://facebook.com/omarelsayed" target="_blank" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                    <a href="https://github.com/omarelsayed" target="_blank" aria-label="GitHub"><i class="fab fa-github"></i></a>
                    <a href="https://linkedin.com/in/omarelsayed" target="_blank" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
                    <a href="https://youtube.com/@omarelsayed" target="_blank" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Main JavaScript -->
    <script src="/assets/js/main.js"></script>

    <?php if (isset($_SESSION['admin_user_id']) && isset($_GET['admin_editor'])): ?>
        <!-- Admin Interaction Logic -->
        <script src="/assets/js/admin.js"></script>
    <?php endif; ?>
</body>
</html>
