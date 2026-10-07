<?php
require_once __DIR__ . '/includes/config.php';
$pageTitle = 'Contact MC Exodus | Bookings and Partnerships';
$pageDescription = 'Contact the MC Exodus team about bookings, comedy, content partnerships, event promotion and media enquiries.';
$pageKey = 'contact';
$canonicalPath = 'contact.php';
$success = false;
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fields = ['Name' => trim((string)($_POST['name'] ?? '')), 'Email' => trim((string)($_POST['email'] ?? '')), 'Phone' => trim((string)($_POST['phone'] ?? '')), 'Enquiry type' => trim((string)($_POST['enquiry_type'] ?? '')), 'Message' => trim((string)($_POST['message'] ?? ''))];
    if (!valid_csrf($_POST['csrf'] ?? null) || !empty($_POST['website'])) $errors[] = 'The form session could not be verified. Please refresh and try again.';
    if ($fields['Name'] === '' || !filter_var($fields['Email'], FILTER_VALIDATE_EMAIL) || $fields['Message'] === '') $errors[] = 'Please provide your name, a valid email address and your message.';
    if (strlen($fields['Message']) > 3000) $errors[] = 'Please shorten the message to 3,000 characters.';
    if (empty($errors)) {
        $success = send_site_mail('New MC Exodus website enquiry', $fields, $fields['Email'], $site['partnership_email']);
        if (!$success) $errors[] = 'The message could not be sent while the email connection is being checked.';
    }
}
require __DIR__ . '/includes/header.php';
?>
<section class="page-hero"><div class="container"><p class="eyebrow">Contact</p><h1>Start the right conversation.</h1><p>For bookings, use the structured booking form. For media, partnerships and general enquiries, send a message here.</p></div></section>
<section class="band"><div class="container content-grid"><div><?php if ($success): ?><div class="notice"><strong>Message received.</strong> The MC Exodus team will respond using the contact details supplied.</div><?php endif; ?><?php if ($errors): ?><div class="notice error"><?= e(implode(' ', $errors)) ?></div><?php endif; ?><form method="post" action="/contact.php" class="form-grid"><input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>"><div class="honeypot"><label>Website<input name="website" tabindex="-1"></label></div><div class="field"><label for="name">Name *</label><input id="name" name="name" required value="<?= e((string)($_POST['name'] ?? '')) ?>"></div><div class="field"><label for="email">Email *</label><input id="email" name="email" type="email" required value="<?= e((string)($_POST['email'] ?? '')) ?>"></div><div class="field"><label for="phone">Phone</label><input id="phone" name="phone" type="tel" value="<?= e((string)($_POST['phone'] ?? '')) ?>"></div><div class="field"><label for="enquiry_type">Enquiry type</label><select id="enquiry_type" name="enquiry_type"><option>General enquiry</option><option>Media enquiry</option><option>Content partnership</option><option>Event promotion</option><option>Sponsorship</option></select></div><div class="field field-full"><label for="message">Message *</label><textarea id="message" name="message" maxlength="3000" required><?= e((string)($_POST['message'] ?? '')) ?></textarea></div><div class="field field-full"><button class="button" type="submit">Send message</button></div></form></div><aside class="side-panel"><p class="eyebrow">Contact the team</p><h3>Bookings and partnerships.</h3><p><strong>Preferred number</strong><br><a href="tel:<?= e($site['preferred_phone_href']) ?>"><?= e($site['preferred_phone']) ?></a></p><p><strong>Booking line</strong><br><a href="tel:<?= e($site['booking_phone_href']) ?>"><?= e($site['booking_phone']) ?></a></p><p><strong>WhatsApp</strong><br><a href="<?= e($site['whatsapp_href']) ?>" target="_blank" rel="noopener"><?= e($site['whatsapp']) ?></a></p><p><strong>Email</strong><br><a href="mailto:<?= e($site['partnership_email']) ?>"><?= e($site['partnership_email']) ?></a></p><p><strong>Office</strong><br><?= e($site['office']) ?></p><a class="button button-secondary" href="/book.php">Open booking form</a></aside></div></section>
<?php require __DIR__ . '/includes/footer.php'; ?>
