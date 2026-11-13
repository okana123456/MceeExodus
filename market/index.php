<?php
$pageTitle = 'MC Exodus Market Place | Buy, Sell and Promote in Kenya';
$pageDescription = 'Discover vehicles, property, electronics, furniture, fashion, farm products and services advertised through MC Exodus Market Place.';
$pageKey = 'market';
$canonicalPath = 'market/';
require __DIR__ . '/../includes/header.php';

$query = trim((string)($_GET['q'] ?? ''));
$category = trim((string)($_GET['category'] ?? ''));
?>
<section class="market-hero">
    <div class="container market-hero-content">
        <p class="eyebrow">MC Exodus Market Place</p>
        <h1>Post it. Promote it. Sell it.</h1>
        <p>One lively marketplace for everyday products, property, vehicles and growing Kenyan businesses.</p>
        <form class="market-search" method="get" action="/market/" role="search">
            <label class="sr-only" for="market-query">What are you looking for?</label>
            <input id="market-query" type="search" name="q" value="<?= e($query) ?>" placeholder="Search cars, phones, houses or services">
            <label class="sr-only" for="market-category">Category</label>
            <select id="market-category" name="category">
                <option value="">All categories</option>
                <?php foreach ($marketplace['categories'] as $option): ?>
                    <option value="<?= e($option) ?>" <?= $category === $option ? 'selected' : '' ?>><?= e($option) ?></option>
                <?php endforeach; ?>
            </select>
            <button class="button" type="submit">Search market</button>
        </form>
        <div class="market-hero-actions">
            <span>Have something to sell?</span>
            <a href="/market/post.php">Post an advert</a>
        </div>
    </div>
</section>

<section class="band market-intro">
    <div class="container">
        <div class="section-head reveal">
            <div><p class="eyebrow">Browse the market</p><h2>Find what you need close to home.</h2></div>
            <a class="text-link" href="/market/post.php">Start selling</a>
        </div>
        <div class="market-category-grid reveal">
            <?php
            $categoryCopy = [
                'Vehicles' => 'Cars, motorbikes, parts and commercial vehicles.',
                'Property' => 'Homes, land, rentals and commercial spaces.',
                'Phones and Electronics' => 'Phones, laptops, TVs and useful technology.',
                'Home and Furniture' => 'Furniture, appliances and home essentials.',
                'Fashion and Beauty' => 'Clothing, footwear, accessories and beauty.',
                'Agriculture' => 'Produce, equipment, livestock and farm supplies.',
                'Services and Business' => 'Professional services and business offers.',
            ];
            foreach ($marketplace['categories'] as $index => $item):
            ?>
                <a class="market-category" href="/market/?category=<?= urlencode($item) ?>">
                    <span><?= str_pad((string)($index + 1), 2, '0', STR_PAD_LEFT) ?></span>
                    <strong><?= e($item) ?></strong>
                    <small><?= e($categoryCopy[$item]) ?></small>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="band band-soft">
    <div class="container">
        <div class="market-results-head reveal">
            <div>
                <p class="eyebrow"><?= ($query !== '' || $category !== '') ? 'Search results' : 'Fresh opportunities' ?></p>
                <h2><?= ($query !== '' || $category !== '') ? 'Listings matching your search' : 'The first listings are coming soon.' ?></h2>
            </div>
            <span class="market-status">Seller applications open</span>
        </div>
        <div class="market-empty reveal">
            <div>
                <p class="market-empty-label">Launch collection</p>
                <h3>Be among the first sellers seen on MC Exodus Market Place.</h3>
                <p>Every advert is reviewed before publication. Choose a package, send the product details and the team will guide you through payment and approval.</p>
                <div class="action-row"><a class="button" href="/market/post.php">Post the first advert</a></div>
            </div>
            <div class="market-empty-points">
                <span><strong>01</strong> Submit your product</span>
                <span><strong>02</strong> Complete payment</span>
                <span><strong>03</strong> Pass the review</span>
                <span><strong>04</strong> Reach the audience</span>
            </div>
        </div>
    </div>
</section>

<section class="band">
    <div class="container">
        <div class="section-head reveal"><div><p class="eyebrow">Advertising packages</p><h2>Choose the attention your advert needs.</h2></div></div>
        <div class="market-package-grid reveal">
            <?php foreach ($marketplace['packages'] as $key => $package): ?>
                <article class="market-package <?= $key === 'weekly' ? 'recommended' : '' ?>">
                    <?php if ($key === 'weekly'): ?><span class="package-flag">Most popular</span><?php endif; ?>
                    <p><?= e($package['duration']) ?></p>
                    <h3><?= e($package['name']) ?></h3>
                    <strong>KSh <?= number_format($package['price']) ?></strong>
                    <p><?= e($package['description']) ?></p>
                    <a class="text-link" href="/market/post.php?package=<?= e($key) ?>">Choose this package</a>
                </article>
            <?php endforeach; ?>
        </div>
        <p class="market-package-note">Live-show mentions and social media spotlight packages will be introduced separately after scheduling and approval by the MC Exodus team.</p>
    </div>
</section>

<section class="market-safety-band">
    <div class="container market-safety-inner">
        <div><p class="eyebrow">Trade thoughtfully</p><h2>Good deals begin with good judgement.</h2></div>
        <div><p>Meet in a safe public place, inspect an item before paying and never share passwords or verification codes. MC Exodus Market Place publishes paid advertisements but does not own the advertised goods or guarantee private transactions.</p><a href="/market/terms.php">Read marketplace rules</a></div>
    </div>
</section>
<?php require __DIR__ . '/../includes/footer.php'; ?>
