<?php
require_once __DIR__ . '/../includes/config.php';
$pageTitle = 'Post an Advert | MC Exodus Market Place';
$pageDescription = 'Submit your product, property, vehicle or service for review and advertising on MC Exodus Market Place.';
$pageKey = 'market';
$canonicalPath = 'market/post.php';
$errors = [];
$success = false;
$notificationWarning = '';
$validUploads = [];
$selectedPackage = trim((string)($_GET['package'] ?? $_POST['package'] ?? 'weekly'));
if (!isset($marketplace['packages'][$selectedPackage])) $selectedPackage = 'weekly';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fields = [
        'Seller name' => trim((string)($_POST['seller_name'] ?? '')),
        'Business name' => trim((string)($_POST['business_name'] ?? '')),
        'Email' => trim((string)($_POST['email'] ?? '')),
        'Phone or WhatsApp' => trim((string)($_POST['phone'] ?? '')),
        'Advert title' => trim((string)($_POST['title'] ?? '')),
        'Category' => trim((string)($_POST['category'] ?? '')),
        'Condition' => trim((string)($_POST['condition'] ?? '')),
        'Price' => trim((string)($_POST['price'] ?? '')),
        'County and location' => trim((string)($_POST['location'] ?? '')),
        'Description' => trim((string)($_POST['description'] ?? '')),
        'Package' => $marketplace['packages'][$selectedPackage]['name'] . ' - KSh ' . number_format($marketplace['packages'][$selectedPackage]['price']),
    ];
    if (!valid_csrf($_POST['csrf'] ?? null)) $errors[] = 'Your session expired. Please refresh the page and try again.';
    if (!empty($_POST['website'])) $errors[] = 'The advert could not be accepted.';
    if ($fields['Seller name'] === '') $errors[] = 'Please enter the seller name.';
    if (!filter_var($fields['Email'], FILTER_VALIDATE_EMAIL)) $errors[] = 'Please provide a valid email address.';
    if ($fields['Phone or WhatsApp'] === '') $errors[] = 'Please provide a telephone or WhatsApp number.';
    if (strlen($fields['Advert title']) < 8 || strlen($fields['Advert title']) > 100) $errors[] = 'The advert title should be between 8 and 100 characters.';
    if (!in_array($fields['Category'], $marketplace['categories'], true)) $errors[] = 'Please select a valid category.';
    if (!is_numeric($fields['Price']) || (float)$fields['Price'] < 0) $errors[] = 'Please enter a valid selling price.';
    if ($fields['County and location'] === '') $errors[] = 'Please provide the county and location.';
    if (strlen($fields['Description']) < 30 || strlen($fields['Description']) > 2500) $errors[] = 'The description should be between 30 and 2,500 characters.';
    if (empty($_POST['seller_declaration'])) $errors[] = 'Please confirm that the advert is accurate and lawful.';

    $photos = $_FILES['photos'] ?? null;
    if (!is_array($photos) || !isset($photos['name']) || !is_array($photos['name'])) {
        $errors[] = 'Please upload at least one clear product photograph.';
    } else {
        $allowedTypes = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];
        $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
        foreach ($photos['name'] as $index => $originalName) {
            $uploadError = (int)($photos['error'][$index] ?? UPLOAD_ERR_NO_FILE);
            if ($uploadError === UPLOAD_ERR_NO_FILE) continue;
            if ($uploadError !== UPLOAD_ERR_OK) {
                $errors[] = 'One of the photographs could not be uploaded. Please try again.';
                continue;
            }
            $size = (int)($photos['size'][$index] ?? 0);
            $temporaryPath = (string)($photos['tmp_name'][$index] ?? '');
            $mimeType = $fileInfo ? (string)finfo_file($fileInfo, $temporaryPath) : '';
            if ($size < 1 || $size > 5 * 1024 * 1024) {
                $errors[] = 'Each photograph must be smaller than 5 MB.';
            } elseif (!isset($allowedTypes[$mimeType])) {
                $errors[] = 'Photographs must be JPG, PNG or WebP files.';
            } else {
                $validUploads[] = ['tmp' => $temporaryPath, 'extension' => $allowedTypes[$mimeType]];
            }
        }
        if ($fileInfo) finfo_close($fileInfo);
        if (count($validUploads) < 1) $errors[] = 'Please upload at least one clear product photograph.';
        if (count($validUploads) > 8) $errors[] = 'Please upload no more than eight photographs.';
    }

    if (empty($errors)) {
        $reference = 'MXM-' . date('ymd') . '-' . strtoupper(bin2hex(random_bytes(2)));
        $storageDirectory = dirname(__DIR__) . '/data/marketplace-submissions/' . $reference;
        if (!is_dir($storageDirectory) && !mkdir($storageDirectory, 0750, true)) {
            $errors[] = 'The photographs could not be stored. Please contact the marketplace team.';
        }
        $storedPhotos = [];
        if (empty($errors)) {
            foreach ($validUploads as $index => $upload) {
                $fileName = 'photo-' . ($index + 1) . '-' . bin2hex(random_bytes(5)) . '.' . $upload['extension'];
                if (!move_uploaded_file($upload['tmp'], $storageDirectory . '/' . $fileName)) {
                    $errors[] = 'One of the photographs could not be stored. Please try again.';
                    break;
                }
                $storedPhotos[] = $fileName;
            }
        }
        $fields['Reference'] = $reference;
        $fields['Payment status'] = 'Pending payment activation';
        $fields['Photographs received'] = (string)count($storedPhotos);
        if (empty($errors)) {
            $submission = [
                'reference' => $reference,
                'submitted_at' => date(DATE_ATOM),
                'status' => 'pending_review',
                'payment_status' => 'not_requested',
                'package_key' => $selectedPackage,
                'details' => $fields,
                'photos' => $storedPhotos,
            ];
            if (file_put_contents($storageDirectory . '/submission.json', json_encode($submission, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)) === false) {
                $errors[] = 'The advert record could not be stored. Please contact the marketplace team.';
            } else {
                $success = true;
            }
        }
        if ($success && !send_site_mail('New marketplace advert ' . $reference, $fields, $fields['Email'], $site['marketplace_email'])) {
            $notificationWarning = ' Keep this reference and contact the team if you do not receive a response.';
        }
    }
}
require __DIR__ . '/../includes/header.php';
?>
<section class="page-hero market-post-hero"><div class="container"><p class="eyebrow">Sell with MC Exodus</p><h1>Put your offer in front of the audience.</h1><p>Complete the details carefully. The team reviews every advert before payment and publication.</p></div></section>
<section class="band"><div class="container content-grid market-post-layout">
    <div>
        <?php if ($success): ?>
            <div class="notice"><strong>Advert received.</strong> Your reference is <?= e($reference) ?>. The marketplace team will review the information and contact you with payment and publication instructions.<?= e($notificationWarning) ?></div>
        <?php endif; ?>
        <?php if ($errors): ?><div class="notice error"><strong>Please check the form.</strong><br><?= e(implode(' ', $errors)) ?></div><?php endif; ?>
        <?php if (!$success): ?>
        <form method="post" action="/market/post.php" class="form-grid market-post-form" enctype="multipart/form-data" novalidate>
            <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
            <div class="honeypot"><label>Website<input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>
            <div class="form-section-title field-full"><span>01</span><div><h2>Seller details</h2><p>These details are used for review and communication.</p></div></div>
            <div class="field"><label for="seller_name">Full name *</label><input id="seller_name" name="seller_name" required value="<?= e((string)($_POST['seller_name'] ?? '')) ?>"></div>
            <div class="field"><label for="business_name">Business name</label><input id="business_name" name="business_name" value="<?= e((string)($_POST['business_name'] ?? '')) ?>"></div>
            <div class="field"><label for="email">Email address *</label><input id="email" name="email" type="email" required value="<?= e((string)($_POST['email'] ?? '')) ?>"></div>
            <div class="field"><label for="phone">Telephone or WhatsApp *</label><input id="phone" name="phone" type="tel" required value="<?= e((string)($_POST['phone'] ?? '')) ?>"></div>

            <div class="form-section-title field-full"><span>02</span><div><h2>Advert information</h2><p>Use clear, truthful information that a buyer can understand.</p></div></div>
            <div class="field field-full"><label for="title">Advert title *</label><input id="title" name="title" maxlength="100" required placeholder="Example: Clean 2020 Toyota Fielder in Nairobi" value="<?= e((string)($_POST['title'] ?? '')) ?>"></div>
            <div class="field"><label for="category">Category *</label><select id="category" name="category" required><option value="">Select category</option><?php foreach ($marketplace['categories'] as $option): ?><option <?= (($_POST['category'] ?? '') === $option) ? 'selected' : '' ?>><?= e($option) ?></option><?php endforeach; ?></select></div>
            <div class="field"><label for="condition">Condition</label><select id="condition" name="condition"><?php foreach (['New','Used - like new','Used - good','Used - fair','Not applicable'] as $option): ?><option <?= (($_POST['condition'] ?? '') === $option) ? 'selected' : '' ?>><?= e($option) ?></option><?php endforeach; ?></select></div>
            <div class="field"><label for="price">Price in KSh *</label><input id="price" name="price" type="number" min="0" step="1" required value="<?= e((string)($_POST['price'] ?? '')) ?>"></div>
            <div class="field"><label for="location">County and location *</label><input id="location" name="location" required placeholder="Example: Nairobi, Utawala" value="<?= e((string)($_POST['location'] ?? '')) ?>"></div>
            <div class="field field-full"><label for="description">Description *</label><textarea id="description" name="description" minlength="30" maxlength="2500" required placeholder="Describe the item, important features, ownership, known issues and collection or viewing arrangements."><?= e((string)($_POST['description'] ?? '')) ?></textarea></div>
            <div class="field field-full market-photo-upload"><label for="photos">Product photographs *</label><input id="photos" name="photos[]" type="file" accept="image/jpeg,image/png,image/webp" multiple required><p>Upload 1–8 original JPG, PNG or WebP photographs. Maximum 5 MB per photograph.</p></div>

            <div class="form-section-title field-full"><span>03</span><div><h2>Choose a package</h2><p>Payment is requested only after the advert passes the initial review.</p></div></div>
            <div class="field field-full market-package-options">
                <?php foreach ($marketplace['packages'] as $key => $package): ?>
                    <label class="package-option"><input type="radio" name="package" value="<?= e($key) ?>" <?= $selectedPackage === $key ? 'checked' : '' ?>><span><strong><?= e($package['name']) ?></strong><small><?= e($package['duration']) ?> · KSh <?= number_format($package['price']) ?></small></span></label>
                <?php endforeach; ?>
            </div>
            <div class="field field-full declaration"><label><input type="checkbox" name="seller_declaration" value="1" <?= !empty($_POST['seller_declaration']) ? 'checked' : '' ?> required><span>I confirm that I am authorised to advertise this offer, the information is accurate, and the item or service is lawful under the <a href="/market/terms.php" target="_blank">marketplace rules</a>.</span></label></div>
            <div class="field field-full"><button class="button" type="submit">Submit advert for review</button><p class="form-note">No payment is collected at this stage. Approved sellers will receive official payment instructions from the MC Exodus team.</p></div>
        </form>
        <?php endif; ?>
    </div>
    <aside class="side-panel market-side-panel"><p class="eyebrow">Before you submit</p><h3>Clear adverts earn more trust.</h3><p>Use recent photographs, a realistic price and an honest description. State any faults or limitations clearly.</p><div class="market-side-list"><span>Original photos only</span><span>One product per advert</span><span>Accurate seller contacts</span><span>No prohibited products</span></div><p><strong>Marketplace enquiries</strong><br><a href="mailto:<?= e($site['marketplace_email']) ?>"><?= e($site['marketplace_email']) ?></a></p></aside>
</div></section>
<?php require __DIR__ . '/../includes/footer.php'; ?>
