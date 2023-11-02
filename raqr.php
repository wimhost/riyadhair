<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: X-Requested-With");
require "Exception.php";
require "PHPMailer.php";
require "SMTP.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$mail = new PHPMailer(true);
try {
  $mail->isSMTP();
  $mail->Host       = "smtp.email.me-jeddah-1.oci.oraclecloud.com";
  $mail->SMTPAuth   = true;
  $mail->Username   = "ocid1.user.oc1..aaaaaaaara5smvdjgixpzmqoqhrzp6vpyd4so6a3was6gxv2rssi3fnrebdq@ocid1.tenancy.oc1..aaaaaaaascuf5gpzat2we3uwbsukr2ockwbos4ivsppjul5qpl7odb2halfa.b4.com";
  $mail->Password   = "Lq&pN7)UQDk.9ZH6Vsnt";
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
  $mail->Port       = 587;
  $mail->setFrom("no-reply@riyadhair.com");
  $mail->addAddress($_POST["email"]);
  $mail->addReplyTo("no-reply@riyadhair.com");
  $mail->isHTML(true);
  $mail->addStringEmbeddedImage(base64_decode($_POST["qrpng"]),"qrpng","qr.png","base64","image/png");
  $mail->Subject    = "Riyadh Air PHPMailer Test";
  $mail->Body       = "This is the <b>HTML</b> message body with a QR code ;)<br/><img src='cid:qrpng' alt='' /><br/>";
  $mail->AltBody    = "This is the body in plain text for non-HTML mail clients";
  $mail->send();
  echo "Message has been sent";
} catch (Exception $e) {
  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
