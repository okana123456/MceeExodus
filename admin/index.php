<?php
require_once __DIR__ . '/_auth.php';
$config = admin_config();
$error = '';
if (isset($_GET['logout'])) {
    $_SESSION = [];
    session_destroy();
    header('Location: /admin/');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $config) {
    $password = (string)($_POST['password'] ?? '');
    if (isset($config['password_hash']) && password_verify($password, (string)$config['password_hash'])) {
        session_regenerate_id(true);
        $_SESSION['mcexodus_admin'] = true;
        header('Location: /admin/live.php');
        exit;
    }
    $error = 'The password was not accepted.';
}
?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>MC Exodus Website Manager</title><link rel="stylesheet" href="/assets/css/site.css"></head><body><main class="band"><div class="container narrow"><p class="eyebrow">Website manager</p><h1 style="font-size:42px">MC Exodus</h1><?php if (!$config): ?><div class="notice error"><strong>Admin setup is incomplete.</strong> Create <code>admin/config.php</code> on the server using <code>admin/config.example.php</code> as the guide.</div><?php else: ?><?php if ($error): ?><div class="notice error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div><?php endif; ?><form method="post" class="form-grid"><div class="field field-full"><label for="password">Admin password</label><input id="password" name="password" type="password" required autocomplete="current-password"></div><div class="field field-full"><button class="button" type="submit">Sign in</button></div></form><?php endif; ?></div></main></body></html>
