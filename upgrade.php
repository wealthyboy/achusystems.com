<?php
$upgradeStylesheet = __DIR__ . '/assets/css/upgrade.css';
$upgradeStylesheetVersion = is_file($upgradeStylesheet) ? filemtime($upgradeStylesheet) : time();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Achu Systems is upgrading its digital experience. We will be back shortly.">
    <meta name="theme-color" content="#090d1d">
    <title>Experience upgrade | Achu Systems</title>
    <link rel="icon" type="image/png" sizes="64x64" href="favicon.png">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/apple-touch-icon.png">
    <link rel="stylesheet" href="assets/css/upgrade.css?v=<?= $upgradeStylesheetVersion ?>">
</head>
<body class="upgrade-page">
    <main class="upgrade-shell">
        <div class="upgrade-ambient upgrade-ambient-one" aria-hidden="true"></div>
        <div class="upgrade-ambient upgrade-ambient-two" aria-hidden="true"></div>

        <header class="upgrade-header">
            <a class="upgrade-brand" href="index.php" aria-label="Achu Systems home">
                <img class="upgrade-brand-mark" src="assets/images/achu-systems-logo.png" alt="" width="42" height="42">
                <span>ACHU <strong>SYSTEMS</strong></span>
            </a>
            <span class="upgrade-status"><i></i> Experience upgrade in progress</span>
        </header>

        <section class="upgrade-content" aria-labelledby="upgrade-title">
            <div class="upgrade-copy">
                <p class="upgrade-kicker">A better Achu Systems is loading</p>
                <h1 id="upgrade-title">We’re upgrading the experience.</h1>
                <p class="upgrade-lead">We are refining our website to make it faster, clearer and more useful. Our team is putting the final details in place and we’ll be back shortly.</p>

                <div class="upgrade-actions">
                    <a class="upgrade-button" href="mailto:info@achusystems.com">Contact our team <span aria-hidden="true">↗</span></a>
                    <span class="upgrade-email">info@achusystems.com</span>
                </div>

                <div class="upgrade-services" aria-label="Achu Systems capabilities">
                    <span>Product strategy</span>
                    <span>Web platforms</span>
                    <span>Mobile applications</span>
                    <span>Systems integration</span>
                </div>
            </div>

            <div class="upgrade-visual" aria-hidden="true">
                <div class="upgrade-grid"></div>
                <div class="upgrade-orbit upgrade-orbit-one">
                    <span></span>
                </div>
                <div class="upgrade-orbit upgrade-orbit-two">
                    <span></span>
                </div>
                <div class="upgrade-core">
                    <span class="upgrade-core-label">ACHU</span>
                    <strong>Systems</strong>
                    <small>Building what’s next</small>
                </div>
                <span class="upgrade-node node-one">01</span>
                <span class="upgrade-node node-two">02</span>
                <span class="upgrade-node node-three">03</span>
            </div>
        </section>

        <footer class="upgrade-footer">
            <span>&copy; <?= date('Y') ?> Achu Systems</span>
            <span>Technology built with purpose.</span>
        </footer>
    </main>
</body>
</html>
