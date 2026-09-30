<?php
declare(strict_types=1);
require_once dirname(__DIR__) . '/includes/config.php';

$destinations = [
    'booking' => site_url('book.php'),
    'tickets' => site_url('tickets.php'),
    'events' => site_url('events.php'),
    'youtube' => $site['socials']['youtube'],
    'instagram' => $site['socials']['instagram'],
    'facebook' => $site['socials']['facebook'],
    'tiktok' => $site['socials']['tiktok'],
];

$key = 'booking';
$dataFile = dirname(__DIR__) . '/data/live.json';
if (is_file($dataFile)) {
    $data = json_decode((string) file_get_contents($dataFile), true);
    if (is_array($data) && isset($data['destination']) && array_key_exists($data['destination'], $destinations)) {
        $key = $data['destination'];
    }
}

header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Location: ' . $destinations[$key], true, 302);
exit;
