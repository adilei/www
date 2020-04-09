<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://mobility270-dsom-dwpc.trybmc.com/api/rx/application/command",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_SSLVERSION => 6,
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS =>"{\n    \"resourceType\": \"com.bmc.arsys.rx.application.user.command.LoginCommand\",\n    \"username\": \"hannah_admin@petramco.com\",\n    \"password\": \"Password_1234\"\n}",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/json",
    "X-Requested-By: 111"
  ),
));

$token = curl_exec($curl);

if($token === false)
{
    echo 'Curl error: ' . curl_error($curl);
}
else
{
    echo 'Operation completed without any errors';
    echo $token;

}


echo $token;

$curl_signal = curl_init();

curl_setopt_array($curl_signal, array(
  CURLOPT_URL => "https://mobility270-dsom-dwpc.trybmc.com/api/myit-sb/processes/signal",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS =>"{\n    \"resourceType\": \"com.bmc.arsys.rx.application.process.command.SignalProcessInstanceCommand\",\n    \"processCorrelation\": {\n        \"resourceType\": \"com.bmc.arsys.rx.services.process.domain.AutomaticCorrelation\",\n        \"processCorrelationId\": \"rx-3f370925-6577-4020-856e-5a3a6776ddb6|IDGFPI1ZGM0EQAQIJ0JRQIJ0JRYFCQ||IDGFPI1ZGM0EQAQIJ0JRQIJ0JRYFCQ\"\n    },\n    \"signalInputValues\": {\n        \"Work Status\": \"Cancelled\"\n    }\n}",
  CURLOPT_HTTPHEADER => array(
    "Authorization: JWT ".$token,
    "Content-Type: application/json",
    "Accept: application/json",
    "X-Requested-By: 111"
  ),
));

  
  $response = curl_exec($curl_signal);
  
  curl_close($curl_signal);
  echo $response;
