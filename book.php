<?php
require_once __DIR__ . '/includes/config.php';
$pageTitle = 'Book MC Exodus | Request Event Availability';
$pageDescription = 'Request MC Exodus for a corporate function, wedding, launch, comedy performance, moderation assignment or content partnership.';
$pageKey = 'book';
$canonicalPath = 'book.php';
$success = false;
$errors = [];
$selectedService = trim((string)($_GET['service'] ?? $_POST['service'] ?? ''));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fields = [
        'Name or organisation' => trim((string)($_POST['name'] ?? '')),
        'Email' => trim((string)($_POST['email'] ?? '')),
        'Phone' => trim((string)($_POST['phone'] ?? '')),
        'Event type' => trim((string)($_POST['event_type'] ?? '')),
        'Proposed date' => trim((string)($_POST['event_date'] ?? '')),
        'Proposed time' => trim((string)($_POST['event_time'] ?? '')),
        'Venue and location' => trim((string)($_POST['venue'] ?? '')),
        'Estimated guests' => trim((string)($_POST['guests'] ?? '')),
        'Service required' => trim((string)($_POST['service'] ?? '')),
        'Budget range' => trim((string)($_POST['budget'] ?? '')),
        'Additional information' => trim((string)($_POST['notes'] ?? '')),
    ];
    if (!valid_csrf($_POST['csrf'] ?? null)) $errors[] = 'Your session expired. Please refresh the page and try again.';
    if (!empty($_POST['website'])) $errors[] = 'The request could not be accepted.';
    if ($fields['Name or organisation'] === '') $errors[] = 'Please enter your name or organisation.';
    if (!filter_var($fields['Email'], FILTER_VALIDATE_EMAIL)) $errors[] = 'Please provide a valid email address.';
    if ($fields['Phone'] === '') $errors[] = 'Please provide a phone number.';
    if ($fields['Event type'] === '' || $fields['Proposed date'] === '' || $fields['Venue and location'] === '') $errors[] = 'Please complete the event type, date and location.';
    if (strlen($fields['Additional information']) > 3000) $errors[] = 'Please shorten the additional information to 3,000 characters.';
    if (empty($errors)) {
        $success = send_site_mail('New MC Exodus booking request', $fields, $fields['Email'], $site['booking_email']);
        if (!$success) $errors[] = 'The request could not be sent. Please use the contact page while the email connection is checked.';
    }
}
require __DIR__ . '/includes/header.php';
?>
<section class="page-hero"><div class="container"><p class="eyebrow">Book MC Exodus</p><h1>Tell us about the event.</h1><p>This is an availability request, not an automatic reservation. The team will review the brief and respond privately.</p></div></section>
<section class="band"><div class="container content-grid">
    <div>
        <?php if ($success): ?><div class="notice"><strong>Request received.</strong> The team will review your event details and contact you.</div><?php endif; ?>
        <?php if ($errors): ?><div class="notice error"><strong>Please check the form.</strong><br><?= e(implode(' ', $errors)) ?></div><?php endif; ?>
        <form method="post" action="/book.php" class="form-grid" novalidate>
            <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
            <div class="honeypot"><label>Website<input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>
            <div class="field"><label for="name">Name or organisation *</label><input id="name" name="name" required value="<?= e((string)($_POST['name'] ?? '')) ?>"></div>
            <div class="field"><label for="email">Email address *</label><input id="email" name="email" type="email" required value="<?= e((string)($_POST['email'] ?? '')) ?>"></div>
            <div class="field"><label for="phone">Phone number *</label><input id="phone" name="phone" type="tel" required value="<?= e((string)($_POST['phone'] ?? '')) ?>"></div>
            <div class="field"><label for="event_type">Type of event *</label><select id="event_type" name="event_type" required><option value="">Select event type</option><?php foreach (['Corporate event','Wedding','Comedy event','Conference or panel','Product launch','Team building','Private celebration','Content partnership','Other'] as $option): ?><option <?= (($_POST['event_type'] ?? '') === $option) ? 'selected' : '' ?>><?= e($option) ?></option><?php endforeach; ?></select></div>
            <div class="field"><label for="event_date">Proposed date *</label><input id="event_date" name="event_date" type="date" min="<?= date('Y-m-d') ?>" required value="<?= e((string)($_POST['event_date'] ?? '')) ?>"></div>
            <div class="field"><label for="event_time">Proposed start time</label><input id="event_time" name="event_time" type="time" value="<?= e((string)($_POST['event_time'] ?? '')) ?>"></div>
            <div class="field field-full"><label for="venue">Venue and location *</label><input id="venue" name="venue" required placeholder="Venue, town or county" value="<?= e((string)($_POST['venue'] ?? '')) ?>"></div>
            <div class="field"><label for="guests">Estimated guests</label><input id="guests" name="guests" type="number" min="1" max="100000" value="<?= e((string)($_POST['guests'] ?? '')) ?>"></div>
            <div class="field"><label for="service">Service required</label><select id="service" name="service"><option value="">Select service</option><?php foreach (['Corporate MC services','Weddings and celebrations','Comedy performances','Event moderation','Product launches','Team-building events','Content partnerships','Event promotion'] as $option): ?><option <?= ($selectedService === $option) ? 'selected' : '' ?>><?= e($option) ?></option><?php endforeach; ?></select></div>
            <div class="field field-full"><label for="budget">Budget range</label><select id="budget" name="budget"><option value="">Prefer to discuss</option><?php foreach (['Below KSh 30,000','KSh 30,000 - 60,000','KSh 60,001 - 100,000','Above KSh 100,000'] as $option): ?><option <?= (($_POST['budget'] ?? '') === $option) ? 'selected' : '' ?>><?= e($option) ?></option><?php endforeach; ?></select></div>
            <div class="field field-full"><label for="notes">Additional information</label><textarea id="notes" name="notes" maxlength="3000" placeholder="Programme, audience, theme, timing or any special requirements"><?= e((string)($_POST['notes'] ?? '')) ?></textarea></div>
            <div class="field field-full"><button class="button" type="submit">Send booking request</button><p class="form-note">Submitting this form does not reserve the date. Availability is confirmed by the MC Exodus team.</p></div>
        </form>
    </div>
    <aside class="side-panel"><p class="eyebrow">What happens next</p><h3>A clear response, privately handled.</h3><p>The team reviews the date, location, audience and service requirements. If the event is suitable and the date is available, you will receive the next steps and a quotation.</p><p><strong>Booking line</strong><br><a href="tel:<?= e($site['booking_phone_href']) ?>"><?= e($site['booking_phone']) ?></a></p><p><strong>WhatsApp</strong><br><a href="<?= e($site['whatsapp_href']) ?>" target="_blank" rel="noopener"><?= e($site['whatsapp']) ?></a></p><p><strong>Booking email</strong><br><a href="mailto:<?= e($site['booking_email']) ?>"><?= e($site['booking_email']) ?></a></p><p>Your full calendar and other clients' information are never displayed publicly.</p></aside>
</div></section>
<?php require __DIR__ . '/includes/footer.php'; ?>
