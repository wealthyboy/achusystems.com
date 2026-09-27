<?php
$pageTitle = 'Contact';
$currentPage = 'contact';
$sent = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || $message === '') {
        $error = 'Please complete all fields with a valid email address.';
    } else {
        $subject = 'Achu Systems website enquiry from ' . $name;
        $body = "Name: {$name}\nEmail: {$email}\n\n{$message}";
        $headers = "From: website@achusystems.com\r\nReply-To: {$email}\r\n";
        $sent = @mail('info@achusystems.com', $subject, $body, $headers);
        if (!$sent) {
            $error = 'Your message could not be sent from the server. Please email info@achusystems.com directly.';
        }
    }
}

require __DIR__ . '/includes/header.php';
?>
<section class="page-hero compact">
    <div class="container narrow">
        <span class="eyebrow">Contact</span>
        <h1>Let’s talk about what you’re building.</h1>
        <p class="lead">For product enquiries, partnerships or support, reach Achu Systems at <a href="mailto:info@achusystems.com">info@achusystems.com</a>.</p>
    </div>
</section>

<section class="section">
    <div class="container contact-grid">
        <div class="contact-panel">
            <span class="section-kicker">Get in touch</span>
            <h2>Start a conversation.</h2>
            <p>Tell us a little about your project, product or integration and we’ll get back to you.</p>
            <div class="contact-detail">
                <span>Email</span>
                <a href="mailto:info@achusystems.com">info@achusystems.com</a>
            </div>
            <div class="contact-detail">
                <span>Website</span>
                <strong>achusystems.com</strong>
            </div>
        </div>

        <form class="contact-form" method="post" action="contact.php">
            <?php if ($sent): ?>
                <div class="alert success">Thank you. Your message has been sent.</div>
            <?php elseif ($error): ?>
                <div class="alert error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <label>
                <span>Name</span>
                <input type="text" name="name" required value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
            </label>
            <label>
                <span>Email</span>
                <input type="email" name="email" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
            </label>
            <label>
                <span>How can we help?</span>
                <textarea name="message" rows="6" required><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
            </label>
            <button class="btn btn-primary" type="submit">Send message</button>
            <p class="form-note">If your server does not support PHP mail, contact us directly at <a href="mailto:info@achusystems.com">info@achusystems.com</a>.</p>
        </form>
    </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
