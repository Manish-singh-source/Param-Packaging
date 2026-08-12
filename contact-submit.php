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

$isConfigured = $config['host'] === 'smtp.gmail.com'
    && $config['username'] !== 'your-gmail@gmail.com'
    && $config['password'] !== 'your-gmail-app-password';

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

$userHtml = <<<HTML
<!doctype html>
<html>
<body style="margin:0;background:#f2f2f2;font-family:Arial,Helvetica,sans-serif;color:#333;">
  <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:#f2f2f2;padding:28px 0;">
    <tr>
      <td align="center">
        <table role="presentation" width="620" cellspacing="0" cellpadding="0" style="width:620px;max-width:96%;background:#fff;border:1px solid #e5e5e5;">
          <tr>
            <td style="padding:24px 28px;border-top:5px solid #bc0000;text-align:center;">
              <img src="cid:param_logo" alt="Param Packaging" style="max-height:68px;width:auto;">
              <h1 style="margin:18px 0 8px;font-size:25px;line-height:1.2;color:#bc0000;">Thank You, {$safeName}</h1>
              <p style="margin:0;color:#555;font-size:15px;line-height:1.6;">We have received your inquiry. Our team will review your message and get back to you shortly.</p>
            </td>
          </tr>
          <tr>
            <td style="padding:0 28px 24px;">
              <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;font-size:14px;">
                <tr><td style="padding:12px;border:1px solid #eee;background:#fafafa;font-weight:bold;width:160px;">Subject</td><td style="padding:12px;border:1px solid #eee;">{$safeSubject}</td></tr>
                <tr><td style="padding:12px;border:1px solid #eee;background:#fafafa;font-weight:bold;vertical-align:top;">Your Message</td><td style="padding:12px;border:1px solid #eee;line-height:1.6;">{$safeMessage}</td></tr>
              </table>
            </td>
          </tr>
          <tr>
            <td style="padding:18px 28px;background:#fafafa;border-top:1px solid #eee;font-size:14px;line-height:1.6;">
              <strong style="color:#bc0000;">Param Packaging Pvt. Ltd</strong><br>
              C-1002, Lotus Corporate Park, Ram Mandir Road, Goregaon (E), Mumbai - 400 063, India<br>
              <a href="mailto:info@parampackaging.com" style="color:#bc0000;">info@parampackaging.com</a>
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

$userPlainText = "Thank you, {$name}\n\nWe have received your inquiry and our team will get back to you shortly.\n\nSubject: {$subject}\nMessage:\n{$message}\n\nParam Packaging Pvt. Ltd";

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

    $userMail = new PHPMailer(true);
    $userMail->isSMTP();
    $userMail->Host = $config['host'];
    $userMail->SMTPAuth = true;
    $userMail->Username = $config['username'];
    $userMail->Password = $config['password'];
    $userMail->Port = (int) $config['port'];
    if (!empty($config['secure'])) {
        $userMail->SMTPSecure = $config['secure'];
    }

    $userMail->setFrom($config['from_email'], $config['from_name']);
    $userMail->addAddress($email, $name);
    $userMail->addReplyTo($config['admin_email'], $config['admin_name']);
    if (is_file($logoPath)) {
        $userMail->addEmbeddedImage($logoPath, 'param_logo', 'logo-param.jpg');
    }
    $userMail->isHTML(true);
    $userMail->Subject = 'Thank you for contacting Param Packaging';
    $userMail->Body = $userHtml;
    $userMail->AltBody = $userPlainText;
    $userMail->send();

    redirectWithStatus('success');
} catch (Exception $e) {
    $_SESSION['mail_error'] = $mail->ErrorInfo ?: $e->getMessage();
    redirectWithStatus('error');
}
