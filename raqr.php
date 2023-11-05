></div>";<?php
//  ini_set('display_errors','1');
//  ini_set('display_startup_errors','1');
//  error_reporting(E_ALL);
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: GET, POST");
  header("Access-Control-Allow-Headers: X-Requested-With");
  try
  {
    $db = new PDO('sqlite:users.db');
    $db->exec("CREATE TABLE IF NOT EXISTS users (firstname TEXT NOT NULL,lastname TEXT NOT NULL,email TEXT NOT NULL,lang TEXT NOT NULL,regdate TIMESTAMP NOT NULL,custom1 TEXT,custom2 TEXT,custom3 TEXT,custom4 TEXT);");
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $lang = $_POST["lang"];
    $regdate = intval($_POST["regdate"]);
    $dbq = $db->prepare("INSERT INTO `users` (firstname,lastname,email,lang,regdate) VALUES (:firstname,:lastname,:email,:lang,:regdate);");
    $dbq->execute(['firstname'=>$firstname,'lastname'=>$lastname,'email'=>$email,'lang'=>$lang,'regdate'=>$regdate,]);
    $db = NULL;
    echo "Database updated";
  }
  catch(PDOException $e)
  {
    echo 'SQLite exception: '.$e->getMessage();
  }
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
    $mail->CharSet = PHPMailer::CHARSET_UTF8;
    $mail->addAddress($email);
    $mail->setFrom("no-reply@riyadhair.com","Riyadh Air");
    $mail->isHTML(true);
    $mail->addStringEmbeddedImage(base64_decode($_POST['qrpng']),"qrpng","qr.png","base64","image/png");
    $mail->addStringEmbeddedImage(base64_decode("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"),"ralogo","ralogo.png","base64","image/png");
    switch ($_POST['lang'])
    {
      case "arabic":
        $mail->Subject = "مرحبا بكم في طيران الرياض في معرض دبي للطيران 2023";
        $mail->Body = "<div dir='rtl' lang='ar'>عزيزنا،<br/><br/>شكراً لتسجيلك معنا من خلال منصّتنا في معرض دبي للطيران.<br/><br/>يسعدنا أن نرحب بانضمامك إلينا في بداية حقبة جديدة في عالم الطيران، ونتمنى أن تستمتع بالرحلة التي صممناها من أجلك، وتشاركنا اللحظة التاريخية التي يبدأ فيها المستقبل.<br/><br/>استخدم رمز الاستجابة السريعة المخصص من أجلك للدخول.<br/><br/>مع أطيب تحياتنا،<br/><br/>فريق عمل طيران الرياض / عائلة طيران الرياض. <br/><br/>";
        break;
      default:
        $mail->Subject = "Welcome to Riyadh Air at the Dubai Air Show 2023";
        $mail->Body = "<div dir='ltr' lang='en'>Hello {$_POST['firstname']} {$_POST['lastname']},<br/><br/>Thank you for registering at our Dubai Air Show venue.<br/><br/>Riyadh Air welcomes you to a brand-new chapter in the history of air travel.<br/><br/>We hope you enjoy our curated walkthrough and we can’t wait to watch you see the future take flight.<br/><br/>Enclosed below is the personalized QR code for your admission.<br/><br/>Warm regards,<br/><br/>Team Riyadh Air<br/><br/>";
    }
    $mail->Body .= "<img src='cid:qrpng' alt='' /><br/><img src='cid:ralogo' alt='' /><br/></div>";
    $mail->send();
  }
    catch (Exception $e)
  {
    echo 'Mailer Error: {$mail->ErrorInfo}';
  }
  finally
  {
    http_response_code(200);
  }
  echo 'Done...';
?>
