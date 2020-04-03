<?php
  
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;
  
  require 'vendor/autoload.php';

  header('Content-Type: application/json');

  $config = parse_ini_file("config.ini");

  $emailBody = file_get_contents("email.html");
  

  $response = array( 
    "result"=>"result"); 


  function send_mail($recipientMail,$recipientFirstName, $recipientLastName, $procCorrelation,$gmailUser,$gmailPass,$emailBody)
  {
  
    $mail = new PHPMailer();
    $mail->IsSMTP();
  
    $mail->SMTPDebug  = 0;  
    $mail->SMTPAuth   = TRUE;
    $mail->SMTPSecure = "tls";
    $mail->Port       = 587;
    $mail->Host       = "smtp.gmail.com";
    $mail->Username   = $gmailUser;
    $mail->Password   = $gmailPass;
  
    $mail->IsHTML(true);
    $mail->AddAddress($recipientMail, $recipientFirstName.' '.$recipientLastName);
    $mail->SetFrom("onboarding.rpa@gmail.com", "RPA");
    //$mail->AddReplyTo("reply-to-email", "reply-to-name");
    //$mail->AddCC("cc-recipient-email", "cc-recipient-name");
    $mail->Subject = "Wellcome to ACME, ".$recipientFirstName;
    $content = $emailBody;
  
    $mail->MsgHTML($content); 
    if(!$mail->Send()) {
      return "Error while sending Email.";
      var_dump($mail);
    } else {
      return "Email sent successfully";
    }
  }

  // get the HTTP method, path and body of the request
  $method = $_SERVER['REQUEST_METHOD'];
  $request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
  //$input = json_decode(file_get_contents('php://input'),true);
  $input = json_decode(file_get_contents('php://input'));

  $emailBody = str_replace("firstname",$input->firstName,$emailBody);
  $emailBody = str_replace("lastname",$input->lastName,$emailBody);
  //$urlToClick = $config['check_form_url']."/?FirstName=".$input->firstName."&LastName=".$input->lastName."&dwpHost=".$config['dwpHost']."&dwpPort=".$config['dwpPort']."&procCorr=".$input->procID;
  //$urlToClick = "http:\\/\\/localhost:9090\\/forms\\/CompleteDetails\/CompleteDetails.php\/?FirstName=Adi&LastName=Lei&dwpHost=5e1d590a-227c-4f6b-8a30-58e76cf53551.mock.pstmn.io&dwpPort=443&procCorr=hihi";
  $emailBody = str_replace("http://laragon",$config['check_form_url'].$input->procID,$emailBody);
  

switch ($method) {
  case 'GET':
    echo $input->param1;
  case 'PUT':
  case 'POST':
    $response['result'] = send_mail($input->mail,$input->firstName,$input->lastName,$input->procID,$config['user'],$config['password'],$emailBody);
    echo json_encode($response);
  case 'DELETE':
}

?>