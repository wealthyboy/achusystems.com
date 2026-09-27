<?php
$pageTitle = $pageTitle ?? 'Achu Systems';
$currentPage = $currentPage ?? '';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Achu Systems builds and supports digital products and technology platforms across travel, mobility, entertainment and hospitality.">
    <meta name="theme-color" content="#0b1020">
    <title><?= htmlspecialchars($pageTitle) ?> | Achu Systems</title>
    <link rel="icon" type="image/png" sizes="64x64" href="favicon.png">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/apple-touch-icon.png">
    <link rel="stylesheet" href="assets/css/style.css?v=<?= filemtime(__DIR__ . '/../assets/css/style.css') ?>">
</head>
<body>
<header class="site-header">
    <div class="container nav-wrap">
        <a class="brand" href="index.php" aria-label="Achu Systems home">
            <img class="brand-mark" src="assets/images/achu-systems-logo.png" alt="" width="38" height="38">
            <span class="brand-text">ACHU <strong>SYSTEMS</strong></span>
        </a>
        <button class="nav-toggle" type="button" aria-label="Toggle navigation" aria-expanded="false">Menu</button>
        <nav class="site-nav" aria-label="Primary navigation">
            <a class="<?= $currentPage === 'home' ? 'active' : '' ?>" href="index.php">Home</a>
            <a class="<?= $currentPage === 'about' ? 'active' : '' ?>" href="about.php">About</a>
            <a class="<?= $currentPage === 'contact' ? 'active' : '' ?>" href="contact.php">Contact</a>
            <a class="<?= $currentPage === 'privacy' ? 'active' : '' ?>" href="privacy.php">Privacy</a>
        </nav>
    </div>
</header>
<main>
