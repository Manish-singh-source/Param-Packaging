<?php
session_start();

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require __DIR__ . '/vendor/phpmailer/Exception.php';
require __DIR__ . '/vendor/phpmailer/PHPMailer.php';
require __DIR__ . '/vendor/phpmailer/SMTP.php';

$config = require __DIR__ . '/config/smtp.php';

function cleanInput($value) {
    return trim(str_replace(["\r", "\n"], ' ', (string) $value));
}

function redirectWithStatus($status) {
    header('Location: index.php?mail=' . urlencode($status) . '#contact-page');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirectWithStatus('invalid');
}

if (!empty($_POST['website'])) {
    redirectWithStatus('success');
}

$name = cleanInput($_POST['name'] ?? '');
$email = cleanInput($_POST['email'] ?? '');
$subject = cleanInput($_POST['subject'] ?? '');
$message = trim((string) ($_POST['message'] ?? ''));

if ($name === '' || $email === '' || $subject === '' || $message === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    redirectWithStatus('invalid');
}

$isConfigured = !str_contains($config['host'], 'example.com')
    && !str_contains($config['username'], 'example.com')
    && $config['password'] !== 'smtp-password';

if (!$isConfigured) {
    redirectWithStatus('smtp_not_configured');
}

$safeName = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
$safeEmail = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
$safeSubject = htmlspecialchars($subject, ENT_QUOTES, 'UTF-8');
$safeMessage = nl2br(htmlspecialchars($message, ENT_QUOTES, 'UTF-8'));
$submittedAt = date('d M Y, h:i A');

$emailHtml = <<<HTML
<!doctype html>
<html>
<body style="margin:0;background:#f2f2f2;font-family:Arial,Helvetica,sans-serif;color:#333;">
  <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:#f2f2f2;padding:28px 0;">
    <tr>
      <td align="center">
        <table role="presentation" width="620" cellspacing="0" cellpadding="0" style="width:620px;max-width:96%;background:#fff;border:1px solid #e5e5e5;">
          <tr>
            <td style="padding:22px 28px;border-top:5px solid #bc0000;text-align:center;">
              <img src="cid:param_logo" alt="Param Packaging" style="max-height:68px;width:auto;">
              <h1 style="margin:18px 0 4px;font-size:24px;line-height:1.2;color:#bc0000;">New Website Inquiry</h1>
              <p style="margin:0;color:#777;font-size:13px;">Submitted from Param Packaging contact form</p>
            </td>
          </tr>
          <tr>
            <td style="padding:0 28px 24px;">
              <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;font-size:14px;">
                <tr><td style="padding:12px;border:1px solid #eee;background:#fafafa;font-weight:bold;width:160px;">Name</td><td style="padding:12px;border:1px solid #eee;">{$safeName}</td></tr>
                <tr><td style="padding:12px;border:1px solid #eee;background:#fafafa;font-weight:bold;">Email</td><td style="padding:12px;border:1px solid #eee;"><a href="mailto:{$safeEmail}" style="color:#bc0000;">{$safeEmail}</a></td></tr>
                <tr><td style="padding:12px;border:1px solid #eee;background:#fafafa;font-weight:bold;">Subject</td><td style="padding:12px;border:1px solid #eee;">{$safeSubject}</td></tr>
                <tr><td style="padding:12px;border:1px solid #eee;background:#fafafa;font-weight:bold;vertical-align:top;">Message</td><td style="padding:12px;border:1px solid #eee;line-height:1.6;">{$safeMessage}</td></tr>
                <tr><td style="padding:12px;border:1px solid #eee;background:#fafafa;font-weight:bold;">Submitted</td><td style="padding:12px;border:1px solid #eee;">{$submittedAt}</td></tr>
              </table>
            </td>
          </tr>
          <tr>
            <td style="padding:14px 28px;background:#202020;color:#fff;text-align:center;font-size:12px;">
              Param Packaging Pvt Ltd | PineTree Packaging Pvt Ltd
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
HTML;

$plainText = "New Website Inquiry\n\nName: {$name}\nEmail: {$email}\nSubject: {$subject}\nMessage:\n{$message}\n\nSubmitted: {$submittedAt}";

try {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = $config['host'];
    $mail->SMTPAuth = true;
    $mail->Username = $config['username'];
    $mail->Password = $config['password'];
    $mail->Port = (int) $config['port'];
    if (!empty($config['secure'])) {
        $mail->SMTPSecure = $config['secure'];
    }

    $mail->setFrom($config['from_email'], $config['from_name']);
    $mail->addAddress($config['admin_email'], $config['admin_name']);
    $mail->addReplyTo($email, $name);

    $logoPath = __DIR__ . '/assets/theme/img/logo-param.jpg';
    if (is_file($logoPath)) {
        $mail->addEmbeddedImage($logoPath, 'param_logo', 'logo-param.jpg');
    }

    $mail->isHTML(true);
    $mail->Subject = 'New Inquiry: ' . $subject;
    $mail->Body = $emailHtml;
    $mail->AltBody = $plainText;
    $mail->send();

    redirectWithStatus('success');
} catch (Exception $e) {
    $_SESSION['mail_error'] = $mail->ErrorInfo ?: $e->getMessage();
    redirectWithStatus('error');
}
