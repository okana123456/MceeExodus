<?php
declare(strict_types=1);

$site = [
    'name' => 'MC Exodus',
    'tagline' => 'MC. Comedian. Event Host.',
    'base_url' => 'https://mcexodus.rudderdatanalytics.co.ke',
    'notification_email' => 'admin@rudderdatanalytics.co.ke',
    'socials' => [
        'facebook' => 'https://www.facebook.com/Mcexodus254/',
        'instagram' => 'https://www.instagram.com/mcexodus/',
        'youtube' => 'https://www.youtube.com/@mcexoduscomedy',
        'tiktok' => 'https://www.tiktok.com/@mcexodus',
    ],
];

$localConfig = __DIR__ . '/config.local.php';
if (is_file($localConfig)) {
    $overrides = require $localConfig;
    if (is_array($overrides)) {
        $site = array_replace_recursive($site, $overrides);
    }
}

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function site_url(string $path = ''): string
{
    global $site;
    return rtrim($site['base_url'], '/') . '/' . ltrim($path, '/');
}

function csrf_token(): string
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(24));
    }
    return $_SESSION['csrf_token'];
}

function valid_csrf(?string $token): bool
{
    return is_string($token) && hash_equals(csrf_token(), $token);
}

function send_site_mail(string $subject, array $fields, string $replyTo): bool
{
    global $site;
    $lines = [];
    foreach ($fields as $label => $value) {
        $clean = trim(preg_replace('/[\r\n]+/', ' ', (string) $value));
        $lines[] = $label . ': ' . $clean;
    }
    $headers = [
        'MIME-Version: 1.0',
        'Content-Type: text/plain; charset=UTF-8',
        'From: MC Exodus Website <' . $site['notification_email'] . '>',
    ];
    if (filter_var($replyTo, FILTER_VALIDATE_EMAIL)) {
        $headers[] = 'Reply-To: ' . $replyTo;
    }
    return mail($site['notification_email'], $subject, implode("\n", $lines), implode("\r\n", $headers));
}
