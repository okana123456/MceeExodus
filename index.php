<?php
$pageTitle = 'MC Exodus | Professional MC, Comedian and Event Host in Kenya';
$pageDescription = 'Book MC Exodus for corporate events, weddings, comedy, launches, moderation and energetic live experiences across Kenya.';
$pageKey = 'home';
$canonicalPath = '';
require __DIR__ . '/includes/header.php';
?>
<section class="hero">
    <div class="hero-content">
        <p class="eyebrow">Kenya's MC, comedian and event host</p>
        <h1>Every room deserves the right energy.</h1>
        <p class="hero-copy">MC Exodus brings confident hosting, sharp comedy and thoughtful crowd engagement to corporate functions, weddings, launches and live campaigns.</p>
        <div class="action-row">
            <a class="button" href="/book.php">Check availability <i data-lucide="arrow-up-right"></i></a>
            <a class="button button-secondary" href="/media.php">Watch MC Exodus <i data-lucide="play"></i></a>
        </div>
        <div class="hero-proof">
            <span><i data-lucide="mic-2"></i> Corporate and social events</span>
            <span><i data-lucide="message-circle"></i> English and Swahili delivery</span>
            <span><i data-lucide="map-pin"></i> Available across Kenya</span>
        </div>
    </div>
</section>

<section class="band">
    <div class="container">
        <div class="section-head reveal">
            <div><p class="eyebrow">What MC Exodus does</p><h2>Professional when the moment demands it. Effortless when the room needs to breathe.</h2></div>
            <a class="text-link" href="/services.php">View all services <i data-lucide="arrow-right"></i></a>
        </div>
        <div class="service-grid reveal">
            <article class="service-card"><i class="service-icon" data-lucide="building-2"></i><h3>Corporate MC</h3><p>Clear programme management, speaker transitions and audience engagement for professional functions.</p></article>
            <article class="service-card"><i class="service-icon" data-lucide="party-popper"></i><h3>Weddings</h3><p>A warm, lively celebration that respects the couple, their families and the rhythm of the day.</p></article>
            <article class="service-card"><i class="service-icon" data-lucide="laugh"></i><h3>Comedy</h3><p>Live comedy and tailored entertainment built around the audience, occasion and brand environment.</p></article>
            <article class="service-card"><i class="service-icon" data-lucide="messages-square"></i><h3>Moderation</h3><p>Confident panels, interviews and conversations that stay focused while still feeling human.</p></article>
        </div>
    </div>
</section>

<section class="band band-soft">
    <div class="container split">
        <div class="split-image portrait reveal"><img src="/assets/img/wedding-mc.jpg" alt="MC Exodus entertaining guests during a wedding celebration" loading="lazy"></div>
        <div class="reveal">
            <p class="eyebrow">More than announcements</p>
            <h2>A host who understands the room.</h2>
            <p class="lead">Good hosting is timing, preparation and the confidence to respond naturally when the programme changes.</p>
            <p>MC Exodus works with organisers before the event to understand the audience, objectives, speakers and key moments. On stage, that preparation becomes a programme that feels smooth, lively and unmistakably personal.</p>
            <div class="fact-list">
                <div class="fact"><strong>01</strong><span>Prepare the programme and understand the audience</span></div>
                <div class="fact"><strong>02</strong><span>Guide every transition with clarity and pace</span></div>
                <div class="fact"><strong>03</strong><span>Read the room and keep people genuinely involved</span></div>
            </div>
            <div class="action-row"><a class="button button-outline" href="/about.php">Meet MC Exodus</a></div>
        </div>
    </div>
</section>

<section class="band">
    <div class="container">
        <div class="section-head reveal"><div><p class="eyebrow">Seen in the room</p><h2>Real events. Real audiences. Real connection.</h2></div><a class="text-link" href="/media.php">Explore the media hub <i data-lucide="arrow-right"></i></a></div>
        <div class="media-strip reveal">
            <a class="media-tile" href="/services.php#weddings"><img src="/assets/img/wedding-crowd-one.jpg" alt="Guests enjoying an event hosted by MC Exodus" loading="lazy"><span>Wedding celebrations</span></a>
            <a class="media-tile" href="/media.php"><img src="/assets/img/studio-appearance.jpg" alt="MC Exodus during a studio appearance" loading="lazy"><span>Studio appearances</span></a>
            <a class="media-tile" href="/services.php#comedy"><img src="/assets/img/comedy-scene-two.jpg" alt="MC Exodus performing a comedy scene" loading="lazy"><span>Comedy and content</span></a>
            <a class="media-tile" href="/about.php"><img src="/assets/img/portrait-corporate.jpg" alt="Portrait of MC Exodus" loading="lazy"><span>Behind the performer</span></a>
        </div>
    </div>
</section>

<section class="band band-dark">
    <div class="container">
        <div class="section-head reveal"><div><p class="eyebrow">Follow the story</p><h2>New performances, clips and announcements.</h2></div></div>
        <div class="social-panel reveal">
            <a href="<?= e($site['socials']['youtube']) ?>" target="_blank" rel="noopener"><i data-lucide="youtube"></i><strong>YouTube</strong></a>
            <a href="<?= e($site['socials']['tiktok']) ?>" target="_blank" rel="noopener"><i data-lucide="music-2"></i><strong>TikTok</strong></a>
            <a href="<?= e($site['socials']['instagram']) ?>" target="_blank" rel="noopener"><i data-lucide="instagram"></i><strong>Instagram</strong></a>
            <a href="<?= e($site['socials']['facebook']) ?>" target="_blank" rel="noopener"><i data-lucide="facebook"></i><strong>Facebook</strong></a>
        </div>
    </div>
</section>

<section class="cta-band"><div class="container cta-inner"><h2>Planning an event? Let us shape the right hosting experience.</h2><a class="button button-secondary" href="/book.php">Start a booking request</a></div></section>
<?php require __DIR__ . '/includes/footer.php'; ?>
