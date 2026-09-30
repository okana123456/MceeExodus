<?php
$pageTitle = 'Upcoming MC Exodus Events and Appearances';
$pageDescription = 'See upcoming MC Exodus comedy shows, hosted events, public appearances and special announcements.';
$pageKey = 'events';
$canonicalPath = 'events.php';
require __DIR__ . '/includes/header.php';
?>
<section class="page-hero"><div class="container"><p class="eyebrow">Upcoming events</p><h1>See where MC Exodus is appearing next.</h1><p>Public shows, appearances and ticketed events will be announced here and through official social channels.</p></div></section>
<section class="band"><div class="container"><div class="empty-state reveal"><i data-lucide="calendar-days"></i><h2>New dates are being prepared.</h2><p>There are no public events listed at the moment. Follow the official channels for announcements, or return here when the next event is released.</p><div class="action-row" style="justify-content:center"><a class="button" href="<?= e($site['socials']['instagram']) ?>" target="_blank" rel="noopener">Follow on Instagram</a><a class="button button-outline" href="/live/">Open current live link</a></div></div></div></section>
<?php require __DIR__ . '/includes/footer.php'; ?>
