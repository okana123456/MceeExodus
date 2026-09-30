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
            <h2>Follow</h2>
            <div class="social-links"><?php foreach ($site['socials'] as $network => $url): ?><a href="<?= e($url) ?>" target="_blank" rel="noopener"><?= e(ucfirst($network)) ?></a><?php endforeach; ?></div>
        </div>
    </div>
    <div class="footer-base"><span>&copy; <?= date('Y') ?> MC Exodus. All rights reserved.</span><span>Built for memorable rooms and meaningful moments.</span></div>
</footer>
<script src="/assets/js/site.js?v=1"></script>
</body>
</html>
