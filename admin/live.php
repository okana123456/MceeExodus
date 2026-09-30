<?php
require_once __DIR__ . '/_auth.php';
require_admin();
$destinations = [
    'booking' => 'Booking request page',
    'tickets' => 'Tickets page',
    'events' => 'Upcoming events page',
    'youtube' => 'Official YouTube channel',
    'instagram' => 'Official Instagram profile',
    'facebook' => 'Official Facebook page',
    'tiktok' => 'Official TikTok profile',
];
$file = dirname(__DIR__) . '/data/live.json';
$current = 'booking';
if (is_file($file)) {
    $data = json_decode((string)file_get_contents($file), true);
    if (is_array($data) && isset($destinations[$data['destination'] ?? ''])) $current = $data['destination'];
}
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $choice = (string)($_POST['destination'] ?? '');
    if (isset($destinations[$choice])) {
        $payload = json_encode(['destination' => $choice, 'updated_at' => gmdate('c')], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        if (file_put_contents($file, $payload . PHP_EOL, LOCK_EX) !== false) {
            $current = $choice;
            $message = 'The live link now points to: ' . $destinations[$choice] . '.';
        } else {
            $message = 'The setting could not be saved. Check that the data folder is writable.';
        }
    }
}
?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Manage Live Link | MC Exodus</title><link rel="stylesheet" href="/assets/css/site.css"></head><body><main class="band"><div class="container narrow"><p class="eyebrow">Website manager</p><h1 style="font-size:42px">Manage the permanent live link</h1><p class="lead"><strong>mcexodus.rudderdatanalytics.co.ke/live/</strong> can safely point only to one of the approved destinations below.</p><?php if ($message): ?><div class="notice"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></div><?php endif; ?><form method="post" class="form-grid"><div class="field field-full"><label for="destination">Current destination</label><select id="destination" name="destination"><?php foreach ($destinations as $key => $label): ?><option value="<?= htmlspecialchars($key, ENT_QUOTES, 'UTF-8') ?>" <?= $current === $key ? 'selected' : '' ?>><?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8') ?></option><?php endforeach; ?></select></div><div class="field field-full"><button class="button" type="submit">Update live link</button></div></form><div class="action-row"><a class="button button-outline" href="/live/" target="_blank">Test live link</a><a class="text-link" href="/admin/?logout=1">Sign out</a></div></div></main></body></html>
