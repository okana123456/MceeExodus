</main>
<footer class="site-footer">
    <div class="footer-main">
        <div>
            <a class="brand brand-footer" href="/index.php"><img class="brand-mark-image" src="/assets/img/mc-exodus-icon.png" alt=""><span><strong>MC EXODUS</strong><small>MC · COMEDIAN · HOST</small></span></a>
            <p>Confident hosting, quick wit and a room that stays connected from the opening line to the final applause.</p>
        </div>
        <div>
            <h2>Explore</h2>
            <a href="/about.php">About MC Exodus</a>
            <a href="/services.php">Services</a>
            <a href="/media.php">Videos and media</a>
            <a href="/events.php">Upcoming events</a>
        </div>
        <div>
            <h2>Plan an event</h2>
            <a href="/book.php">Request a booking</a>
            <a href="/tickets.php">Buy tickets</a>
            <a href="/contact.php">Contact the team</a>
            <a href="/live/">Current live link</a>
        </div>
        <div>
            <h2>Contact</h2>
            <a href="tel:<?= e($site['preferred_phone_href']) ?>"><?= e($site['preferred_phone']) ?></a>
            <a href="<?= e($site['whatsapp_href']) ?>" target="_blank" rel="noopener"><i class="bi bi-whatsapp" aria-hidden="true"></i> WhatsApp bookings</a>
            <a href="mailto:<?= e($site['booking_email']) ?>"><?= e($site['booking_email']) ?></a>
            <a href="mailto:<?= e($site['partnership_email']) ?>"><?= e($site['partnership_email']) ?></a>
            <p><?= e($site['office']) ?></p>
            <h2 class="footer-follow-title">Follow</h2>
            <div class="social-links">
                <a href="<?= e($site['socials']['whatsapp']) ?>" target="_blank" rel="noopener" aria-label="WhatsApp" title="WhatsApp"><i class="bi bi-whatsapp" aria-hidden="true"></i></a>
                <a href="<?= e($site['socials']['facebook']) ?>" target="_blank" rel="noopener" aria-label="Facebook" title="Facebook"><i class="bi bi-facebook" aria-hidden="true"></i></a>
                <a href="<?= e($site['socials']['instagram']) ?>" target="_blank" rel="noopener" aria-label="Instagram" title="Instagram"><i class="bi bi-instagram" aria-hidden="true"></i></a>
                <a href="<?= e($site['socials']['youtube']) ?>" target="_blank" rel="noopener" aria-label="YouTube" title="YouTube"><i class="bi bi-youtube" aria-hidden="true"></i></a>
                <a href="<?= e($site['socials']['tiktok']) ?>" target="_blank" rel="noopener" aria-label="TikTok" title="TikTok"><i class="bi bi-tiktok" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>
    <div class="footer-base"><span>&copy; <?= date('Y') ?> MC Exodus. All rights reserved.</span><span>Built for memorable rooms and meaningful moments.</span></div>
</footer>
<script src="/assets/js/site.js?v=1"></script>
</body>
</html>
