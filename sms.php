<?php
  
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;
  use Twilio\Rest\Client;
  
  require 'vendor/autoload.php';

  header('Content-Type: application/json');

  $config = parse_ini_file("config.ini.php",true);  

  $response = array( 
    "result"=>"result"); 


  function send_welcome_sms($recipientNumber,$recipientFirstName, $recipientLastName, $urlToClick,$twilio_info,$cuttly_info)
  {
    $twilio = new Client($twilio_info['sid'], $twilio_info['token']); 
    $url = urlencode($urlToClick);
    $cuttly_json = file_get_contents("https://cutt.ly/api/api.php?key=".$cuttly_info['apikey']."&short=".$url);
    $cuttly_data = json_decode ($cuttly_json, true);
    
    if($cuttly_data["url"]["status"] == 7)
    {
      $message = $twilio->messages 
                      ->create($recipientNumber, // to 
                               array( 
                                   "from" => $twilio_info['twilio_number'], 
                                   "messagingServiceSid" => $twilio_info['messagingServiceSid'],      
                                   "body" => "Hi ".$recipientFirstName.". Please click here to get started with your onboarding: ".$cuttly_data["url"]["shortLink"]
                               ) 
                      ); 
     
      return $message->sid;
    }
    else
    {
      return "Cuttly Status: ".$cuttly_data["url"]["status"]." url was ".$url;
    }
    
  }

// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$input = json_decode(file_get_contents('php://input'));
$dwpHost = $config['dwpc']['dwpHost'];
$dwpPort = $config['dwpc']['dwpPort'];
$urltoClick = $config['laragon']['check_form_url']."FirstName=".$input->firstName."&LastName=".$input->lastName."&procCorr=".$input->procID."&dwpHost=".$dwpHost."&dwpPort=".$dwpPort;
  
switch ($method) {
  case 'GET':
    $response['result'] = "Unsupported Method";
  case 'PUT':
    $response['result'] = "Unsupported Method";
  case 'POST':
    $response['result'] = send_welcome_sms($input->number,$input->firstName,$input->lastName,$urltoClick,$config['twilio'],$config['cuttly']);
    echo json_encode($response);
  case 'DELETE':
    $response['result'] = "Unsupported Method";
}

?>