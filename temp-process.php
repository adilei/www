<?php
require_once 'HTTP/Request2.php';
$request = new HTTP_Request2();
$request->setUrl('https://mobility270-dsom-dwpc.trybmc.com/api/myit-sb/processes/signal');
$request->setMethod(HTTP_Request2::METHOD_POST);
$request->setConfig(array(
  'follow_redirects' => TRUE
));
$request->setHeader(array(
  'Authorization' => 'JWT eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJtYXhQaUJcL2NcL1I2NUtBTG1vME9qSlBSTjlPVFpuRXlua0lWSUtFSWw0bm9pTXRHMkJzdVRcL1JjUDNRMnlMWXVPdzVtdUpuVGxaUHY4MkVicWVBWVwvRTM0Q2dEam9kNHJFcUlObUlUOXdFblEwU0YwdG9tSDRuZz09IiwibmJmIjoxNTg2MDkyNTgwLCJpc3MiOiJkd3BjLXNiLTAuZHdwYy1zYi5pbm5vc3R1ZGlvLnN2Yy5jbHVzdGVyLmxvY2FsIiwiX2F1dGhTdHJpbmciOiJVb0JxQnF4WkhoWTJrc0UweEdCbnczanlmdzRwVmE1QjJQUHpnalZtaTVQb1pLenVcL0VmRnl6VUtycU1scVg2REljUGFza2MyeWJSOSs1aUtWQ2VMengxQjZkbUUrMEU3blFMMXRPQ1NOYTI4b1lSVmI5OUpMQT09IiwiZXhwIjoxNTg2MDk2MzAwLCJfY2FjaGVJZCI6NDYwNzIsImlhdCI6MTU4NjA5MjcwMCwianRpIjoiSURHRlBJMVpHTTBFUUFRSTE2WUtRSDM3SjRaNTZWIiwiX2Fic29sdXRlRXhwaXJhdGlvblRpbWUiOjE1ODYxNzkxMDB9.u8EvM-DrdpnZ6k1BJVJGdf9va_nhU_Z2DzZzo18_mgQ',
  'Content-Type' => 'application/json',
  'X-Requested-By' => '111',
  'Content-Type' => 'application/json',
  'Cookie' => 'AR-JWT=eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJtYXhQaUJcL2NcL1I2NUtBTG1vME9qSlBSTjlPVFpuRXlua0lWSUtFSWw0bm9pTXRHMkJzdVRcL1JjUDNRMnlMWXVPdzVtdUpuVGxaUHY4MkVicWVBWVwvRTM0Q2dEam9kNHJFcUlObUlUOXdFblEwU0YwdG9tSDRuZz09IiwibmJmIjoxNTg2MDkyODkwLCJpc3MiOiJkd3BjLXNiLTAuZHdwYy1zYi5pbm5vc3R1ZGlvLnN2Yy5jbHVzdGVyLmxvY2FsIiwiX2F1dGhTdHJpbmciOiJVb0JxQnF4WkhoWTJrc0UweEdCbnczanlmdzRwVmE1QjJQUHpnalZtaTVQb1pLenVcL0VmRnl6VUtycU1scVg2REljUGFza2MyeWJSOSs1aUtWQ2VMengxQjZkbUUrMEU3blFMMXRPQ1NOYTI4b1lSVmI5OUpMQT09IiwiZXhwIjoxNTg2MDk2NjEwLCJfY2FjaGVJZCI6NDYwNzIsImlhdCI6MTU4NjA5MzAxMCwianRpIjoiSURHRlBJMVpHTTBFUUFRSTE2WUtRSDM3SjRaNTZWIiwiX2Fic29sdXRlRXhwaXJhdGlvblRpbWUiOjE1ODYxNzkxMDB9.8VGGgpeYOhLwpVhXUEevZLTYbNe0s0cQoBQE66I14DQ; route=1586077186.617.1151.18411; _cacheId=46072'
));
$request->setBody('{\n    "resourceType": "com.bmc.arsys.rx.application.process.command.SignalProcessInstanceCommand",\n    "processCorrelation": {\n        "resourceType": "com.bmc.arsys.rx.services.process.domain.AutomaticCorrelation",\n        "processCorrelationId": "rx-3f370925-6577-4020-856e-5a3a6776ddb6|IDGFPI1ZGM0EQAQIJ0JRQIJ0JRYFCQ||IDGFPI1ZGM0EQAQIJ0JRQIJ0JRYFCQ"\n    },\n    "signalInputValues": {\n        "Work Status": "Cancelled"\n    }\n}');
try {
  $response = $request->send();
  if ($response->getStatus() == 200) {
    echo $response->getBody();
  }
  else {
    echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
    $response->getReasonPhrase();
  }
}
catch(HTTP_Request2_Exception $e) {
  echo 'Error: ' . $e->getMessage();
}