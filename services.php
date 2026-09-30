<?php
$pageTitle = 'MC and Entertainment Services in Kenya | MC Exodus';
$pageDescription = 'Corporate MC, weddings, comedy, moderation, product launches, team building, event promotion and content partnerships from MC Exodus.';
$pageKey = 'services';
$canonicalPath = 'services.php';
require __DIR__ . '/includes/header.php';
$services = [
    ['building-2', 'Corporate MC services', 'Professional hosting for conferences, dinners, awards, staff functions and stakeholder events, with clear coordination from briefing to closing.'],
    ['heart', 'Weddings and celebrations', 'Warm, respectful and energetic hosting that works with the couple, planner, families and service providers to keep the day flowing.'],
    ['laugh', 'Comedy performances', 'Audience-aware comedy for live shows, private events and brand environments, shaped around the occasion and agreed boundaries.'],
    ['messages-square', 'Event moderation', 'Focused panels, fireside conversations, interviews and audience questions guided with confidence and good time management.'],
    ['rocket', 'Product launches', 'Launch hosting that communicates the product story, coordinates demonstrations and keeps customers, media and partners engaged.'],
    ['users', 'Team-building events', 'Lively facilitation for staff days and retreats, with participation, humour and transitions that support the programme objectives.'],
    ['clapperboard', 'Content partnerships', 'On-camera collaborations, branded entertainment and campaign content developed with a clear audience and distribution plan.'],
    ['megaphone', 'Event promotion', 'Social-led event visibility, announcements and performance content designed to help organisers build attention before event day.'],
];
?>
<section class="page-hero"><div class="container"><p class="eyebrow">Services</p><h1>The right host changes how an event feels.</h1><p>Choose an individual service or ask the team to shape a hosting and entertainment package around your programme.</p></div></section>
<section class="band"><div class="container"><div class="service-grid reveal"><?php foreach ($services as $service): ?><article class="service-card"><i class="service-icon" data-lucide="<?= e($service[0]) ?>"></i><h3><?= e($service[1]) ?></h3><p><?= e($service[2]) ?></p><a class="text-link" href="/book.php?service=<?= urlencode($service[1]) ?>">Request this service <i data-lucide="arrow-right"></i></a></article><?php endforeach; ?></div></div></section>
<section class="band band-soft" id="weddings"><div class="container split"><div class="split-image reveal"><img src="/assets/img/wedding-crowd-two.jpg" alt="Wedding guests participating during a programme hosted by MC Exodus" loading="lazy"></div><div class="reveal"><p class="eyebrow">Weddings</p><h2>Joyful, organised and true to the couple.</h2><p class="lead">A wedding MC should create energy without becoming the centre of someone else's day.</p><p>MC Exodus coordinates with the planner and couple, understands the programme, welcomes both families and helps guests participate naturally. The result is a celebration with momentum, personality and room for the moments that matter.</p><div class="action-row"><a class="button" href="/book.php?service=Weddings">Enquire about a wedding</a></div></div></div></section>
<section class="band" id="comedy"><div class="container split"><div class="reveal"><p class="eyebrow">Comedy and content</p><h2>Humour shaped for the audience.</h2><p class="lead">From social clips to live comedy, the material should feel timely, recognisable and appropriate to its setting.</p><p>Book a comedy appearance or discuss a content partnership for a campaign, product or event. Every commercial collaboration is reviewed before it is accepted.</p><div class="action-row"><a class="button button-outline" href="/contact.php">Discuss a partnership</a></div></div><div class="split-image reveal"><img src="/assets/img/comedy-scene-one.jpg" alt="MC Exodus acting in a comedy scene" loading="lazy"></div></div></section>
<section class="cta-band"><div class="container cta-inner"><h2>Not sure which service fits? Share the event brief with the team.</h2><a class="button button-secondary" href="/book.php">Start your request</a></div></section>
<?php require __DIR__ . '/includes/footer.php'; ?>
