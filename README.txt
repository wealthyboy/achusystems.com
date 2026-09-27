ACHU SYSTEMS VANILLA PHP WEBSITE

Requirements:
- PHP 8+ (also works on most standard PHP shared hosting)
- No database required
- No Composer or npm required

Files:
- index.php       Home page
- about.php       About us page
- contact.php     Contact page
- privacy.php     Privacy policy
- includes/       Shared header/footer
- assets/         CSS and small navigation JS

Deployment:
1. Upload all contents of this folder to the document root for achusystems.com (often public_html).
2. Point achusystems.com to that hosting account.
3. Enable HTTPS/SSL.
4. Ensure PHP mail is configured if you want the contact form to send mail.
   If mail() is not available, the visible info@achusystems.com mail links still work.

Recommended for Apple/account verification:
- Keep achusystems.com publicly accessible over HTTPS.
- Keep the About, Contact and Privacy pages accessible without login.
- Make sure info@achusystems.com is active and monitored.

Note:
The site currently uses the domain spelling "karossey.online" exactly as supplied. If the intended domain is different, update the link/text in index.php before publishing.
