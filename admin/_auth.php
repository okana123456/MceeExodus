<?php
declare(strict_types=1);
session_start();

function admin_config(): ?array
{
    $path = __DIR__ . '/config.php';
    if (!is_file($path)) return null;
    $config = require $path;
    return is_array($config) ? $config : null;
}

function admin_is_authenticated(): bool
{
    return !empty($_SESSION['mcexodus_admin']);
}

function require_admin(): void
{
    if (!admin_is_authenticated()) {
        header('Location: /admin/');
        exit;
    }
}
