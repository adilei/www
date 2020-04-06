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

curl_setopt_array($curl, array(
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
    "Authorization: JWT eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJtYXhQaUJcL2NcL1I2NUtBTG1vME9qSlBSTjlPVFpuRXlua0lWSUtFSWw0bm9pTXRHMkJzdVRcL1JjUDNRMnlMWXVPdzVtdUpuVGxaUHY4MkVicWVBWVwvRTM0Q2dEam9kNHJFcUlObUlUOXdFblEwU0YwdG9tSDRuZz09IiwibmJmIjoxNTg2MDkyNTgwLCJpc3MiOiJkd3BjLXNiLTAuZHdwYy1zYi5pbm5vc3R1ZGlvLnN2Yy5jbHVzdGVyLmxvY2FsIiwiX2F1dGhTdHJpbmciOiJVb0JxQnF4WkhoWTJrc0UweEdCbnczanlmdzRwVmE1QjJQUHpnalZtaTVQb1pLenVcL0VmRnl6VUtycU1scVg2REljUGFza2MyeWJSOSs1aUtWQ2VMengxQjZkbUUrMEU3blFMMXRPQ1NOYTI4b1lSVmI5OUpMQT09IiwiZXhwIjoxNTg2MDk2MzAwLCJfY2FjaGVJZCI6NDYwNzIsImlhdCI6MTU4NjA5MjcwMCwianRpIjoiSURHRlBJMVpHTTBFUUFRSTE2WUtRSDM3SjRaNTZWIiwiX2Fic29sdXRlRXhwaXJhdGlvblRpbWUiOjE1ODYxNzkxMDB9.u8EvM-DrdpnZ6k1BJVJGdf9va_nhU_Z2DzZzo18_mgQ",
    "Content-Type: application/json",
    "X-Requested-By: 111",
    "Content-Type: application/json"
  ),
));

  
  $response = curl_exec($curl);
  
  curl_close($curl);
  echo $response;
