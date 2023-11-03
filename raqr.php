<?php
  ini_set('display_errors','1');
  ini_set('display_startup_errors','1');
  error_reporting(E_ALL);
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: GET, POST");
  header("Access-Control-Allow-Headers: X-Requested-With");
var_dump($_POST);
  require "Exception.php";
  require "PHPMailer.php";
  require "SMTP.php";
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  $mail = new PHPMailer(true);
  try
  {
    $mail->isSMTP();
    $mail->Host = "smtp.email.me-jeddah-1.oci.oraclecloud.com";
    $mail->SMTPAuth = true;
    $mail->Username = "ocid1.user.oc1..aaaaaaaara5smvdjgixpzmqoqhrzp6vpyd4so6a3was6gxv2rssi3fnrebdq@ocid1.tenancy.oc1..aaaaaaaascuf5gpzat2we3uwbsukr2ockwbos4ivsppjul5qpl7odb2halfa.b4.com";
    $mail->Password = "Lq&pN7)UQDk.9ZH6Vsnt";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->addAddress($_POST['email']);
    $mail->setFrom("no-reply@riyadhair.com","Riyadh Air");
    $mail->isHTML(true);
    $mail->addStringEmbeddedImage(base64_decode($_POST['qrpng']),"qrpng","qr.png","base64","image/png");
    $mail->Subject = "Welcome to Riyadh Air at the Dubai Air Show 2023";
    $mail->Body = "Hello {$_POST['firstname']} {$_POST['lastname']},<br/><br/>Thank you for registering at our Dubai Air Show venue.<br/><br/>Riyadh Air welcomes you to a brand-new chapter in the history of air travel.<br/><br/>We hope you enjoy our curated walkthrough and we can’t wait to watch you see the future take flight.<br/><br/>Enclosed below is the personalized QR code for your admission.<br/><br/>Warm regards,<br/><br/>Team Riyadh Air<br/><br/><img src='cid:qrpng' alt='' /><br/>";
    $mail->send();
  }
    catch (Exception $e)
  {
    echo "Mailer Error: {$mail->ErrorInfo}";
  }
  finally
  {
    http_response_code(200);
  }
  echo "done";
?>
