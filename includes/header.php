<?php
require_once __DIR__ . '/config.php';
$pageTitle = $pageTitle ?? 'MC Exodus | Professional MC and Comedian in Kenya';
$pageDescription = $pageDescription ?? 'Book MC Exodus for corporate events, weddings, comedy, launches and engaging live experiences in Kenya.';
$pageKey = $pageKey ?? '';
$canonicalPath = $canonicalPath ?? basename($_SERVER['PHP_SELF'] ?? 'index.php');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($pageTitle) ?></title>
    <meta name="description" content="<?= e($pageDescription) ?>">
    <meta name="robots" content="index, follow, max-image-preview:large">
    <link rel="canonical" href="<?= e(site_url($canonicalPath)) ?>">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="MC Exodus">
    <meta property="og:title" content="<?= e($pageTitle) ?>">
    <meta property="og:description" content="<?= e($pageDescription) ?>">
    <meta property="og:image" content="<?= e(site_url('assets/img/corporate-partnership.jpg')) ?>">
    <meta property="og:url" content="<?= e(site_url($canonicalPath)) ?>">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= e($pageTitle) ?>">
    <meta name="twitter:description" content="<?= e($pageDescription) ?>">
    <meta name="twitter:image" content="<?= e(site_url('assets/img/corporate-partnership.jpg')) ?>">
    <link rel="icon" type="image/png" sizes="192x192" href="/assets/img/mc-exodus-icon.png">
    <link rel="apple-touch-icon" href="/assets/img/mc-exodus-icon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/site.css?v=1">
    <script type="application/ld+json"><?= json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'Person',
        'name' => 'MC Exodus',
        'url' => $site['base_url'],
        'image' => site_url('assets/img/portrait-corporate.jpg'),
        'jobTitle' => 'Master of Ceremonies and Comedian',
        'sameAs' => array_values($site['socials']),
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
</head>
<body>
<a class="skip-link" href="#main-content">Skip to content</a>
<header class="site-header">
    <div class="nav-wrap">
        <a class="brand" href="/index.php" aria-label="MC Exodus home">
            <img class="brand-mark-image" src="/assets/img/mc-exodus-icon.png" alt="">
            <span><strong>MC EXODUS</strong><small>MC · COMEDIAN · HOST</small></span>
        </a>
        <button class="nav-toggle" type="button" aria-label="Open navigation" aria-expanded="false">Menu</button>
        <nav class="main-nav" aria-label="Main navigation">
            <a class="<?= $pageKey === 'home' ? 'active' : '' ?>" href="/index.php">Home</a>
            <a class="<?= $pageKey === 'about' ? 'active' : '' ?>" href="/about.php">About</a>
            <a class="<?= $pageKey === 'services' ? 'active' : '' ?>" href="/services.php">Services</a>
            <a class="<?= $pageKey === 'media' ? 'active' : '' ?>" href="/media.php">Media</a>
            <a class="<?= $pageKey === 'events' ? 'active' : '' ?>" href="/events.php">Events</a>
            <a class="<?= $pageKey === 'tickets' ? 'active' : '' ?>" href="/tickets.php">Tickets</a>
            <a class="<?= $pageKey === 'contact' ? 'active' : '' ?>" href="/contact.php">Contact</a>
            <a class="button button-small" href="/book.php">Book MC Exodus</a>
        </nav>
    </div>
</header>
<main id="main-content">
