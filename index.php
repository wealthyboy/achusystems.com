<?php
$siteUpgradeMode = true;

if ($siteUpgradeMode) {
    require __DIR__ . '/upgrade.php';
    exit;
}

$pageTitle = 'Technology for growing businesses';
$currentPage = 'home';
require __DIR__ . '/includes/header.php';
?>
<section class="hero">
    <div class="hero-orb orb-one"></div>
    <div class="hero-orb orb-two"></div>
    <div class="container hero-grid">
        <div class="hero-copy">
            <span class="eyebrow">Technology • Products • Platforms</span>
            <h1>We build digital products that move businesses forward.</h1>
            <p class="lead">Achu Systems is a technology company creating practical, dependable and beautifully designed platforms across travel, mobility, entertainment and hospitality.</p>
            <div class="hero-actions">
                <a class="btn btn-primary" href="#products">Explore our products</a>
                <a class="btn btn-secondary" href="mailto:info@achusystems.com">Talk to us</a>
            </div>
            <div class="trust-row">
                <span>Product strategy</span>
                <span>Web platforms</span>
                <span>Mobile apps</span>
                <span>Systems integration</span>
            </div>
        </div>
        <div class="hero-card" aria-label="Achu Systems product portfolio">
            <div class="hero-card-top">
                <span>ACHU SYSTEMS</span>
                <span class="status-dot">Active</span>
            </div>
            <div class="metric">
                <strong>6</strong>
                <span>Digital brands & platforms</span>
            </div>
            <div class="mini-list">
                <div><span>Travel</span><b>Karossey</b></div>
                <div><span>Automotive</span><b>AutofactorNG</b></div>
                <div><span>Entertainment</span><b>Nollyflix</b></div>
                <div><span>Hospitality</span><b>Maison BE</b></div>
                <div><span>Hospitality</span><b>Avenue Montaigne</b></div>
                <div><span>Hospitality Tech</span><b>ChannexPro</b></div>
            </div>
        </div>
    </div>
</section>

<section class="section intro-section">
    <div class="container split-copy">
        <div>
            <span class="section-kicker">What we do</span>
            <h2>Technology that works behind the scenes and in front of the customer.</h2>
        </div>
        <div>
            <p>We design, develop and maintain digital products that help businesses operate more efficiently and give customers better experiences. From booking and commerce platforms to streaming, mobile applications and system integrations, our focus is on building technology that is useful, scalable and easy to operate.</p>
        </div>
    </div>
</section>

<section class="section section-dark" id="products">
    <div class="container">
        <div class="section-heading">
            <span class="section-kicker light">Our portfolio</span>
            <h2>Products and platforms powered by Achu Systems.</h2>
            <p>We build across industries, bringing the same focus on usability, reliability and thoughtful product design to every platform.</p>
        </div>
        <div class="product-grid">
            <a class="product-card" href="https://karossey.online" target="_blank" rel="noopener">
                <span class="product-index">01</span>
                <span class="product-tag">Travel</span>
                <h3>Karossey</h3>
                <p>Digital travel experiences designed to make planning and booking trips easier.</p>
                <span class="product-link">karossey.online ↗</span>
            </a>
            <a class="product-card" href="https://autofactorng.com" target="_blank" rel="noopener">
                <span class="product-index">02</span>
                <span class="product-tag">Automotive</span>
                <h3>AutofactorNG</h3>
                <p>An automotive commerce platform connecting customers to parts, products and services.</p>
                <span class="product-link">autofactorng.com ↗</span>
            </a>
            <a class="product-card" href="https://nollyflix.tv" target="_blank" rel="noopener">
                <span class="product-index">03</span>
                <span class="product-tag">Entertainment</span>
                <h3>Nollyflix</h3>
                <p>A streaming and digital entertainment platform built around African film and video experiences.</p>
                <span class="product-link">nollyflix.tv ↗</span>
            </a>
            <a class="product-card" href="https://maisonberesidences.com" target="_blank" rel="noopener">
                <span class="product-index">04</span>
                <span class="product-tag">Hospitality</span>
                <h3>Maison BE Residences</h3>
                <p>A premium hospitality experience supported by modern booking and guest technology.</p>
                <span class="product-link">maisonberesidences.com ↗</span>
            </a>
            <a class="product-card" href="https://avenuemontaigne.ng" target="_blank" rel="noopener">
                <span class="product-index">05</span>
                <span class="product-tag">Hospitality</span>
                <h3>Avenue Montaigne</h3>
                <p>A digital hospitality platform supporting apartment discovery, reservations and guest experiences.</p>
                <span class="product-link">avenuemontaigne.ng ↗</span>
            </a>
            <a class="product-card" href="https://channexpro.com" target="_blank" rel="noopener">
                <span class="product-index">06</span>
                <span class="product-tag">Hospitality Technology</span>
                <h3>ChannexPro</h3>
                <p>A hospitality technology platform for reservations, property operations, channel connectivity and connected guest experiences.</p>
                <span class="product-link">channexpro.com ↗</span>
            </a>
        </div>
    </div>
</section>

<section class="section">
    <div class="container capability-grid">
        <div class="capability-copy">
            <span class="section-kicker">How we build</span>
            <h2>Simple on the surface. Strong underneath.</h2>
            <p>Good technology should make difficult processes feel straightforward. We combine product thinking, software engineering and systems integration to build platforms that can grow with the businesses they support.</p>
        </div>
        <div class="capability-list">
            <div><span>01</span><div><h3>Web Platforms</h3><p>Responsive, secure digital platforms built around real business workflows.</p></div></div>
            <div><span>02</span><div><h3>Mobile Applications</h3><p>Mobile experiences that extend products beyond the browser.</p></div></div>
            <div><span>03</span><div><h3>Systems Integration</h3><p>Connecting third-party services, APIs, payments and operational systems.</p></div></div>
            <div><span>04</span><div><h3>Product Support</h3><p>Continuous improvement, maintenance and technical support as products evolve.</p></div></div>
        </div>
    </div>
</section>

<section class="cta-section">
    <div class="container cta-card">
        <div>
            <span class="section-kicker light">Build with us</span>
            <h2>Have a product or digital platform in mind?</h2>
            <p>Talk to Achu Systems about building, integrating or improving the technology behind your business.</p>
        </div>
        <a class="btn btn-white" href="mailto:info@achusystems.com">info@achusystems.com</a>
    </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
