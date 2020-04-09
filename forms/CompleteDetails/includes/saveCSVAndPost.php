<?PHP
/*
What if you want to post the form data to another page/form?
This extension module shows how to do that. 
This module collects the form data and posts to another form/API end point.

Note that this module requires some advanced programming concepts. See if you can make the modifications and get it working. Else, get help from a programmer.

### Steps
Open the module and update the url and the vaues to send to the next form. Make sure you are sending all the variables that the other script is expecting.

*/
class SaveCSVtoServer extends FM_ExtensionModule
{
    function releaseDWP($dwpHost, $dwpPort, $procCorr){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://".$dwpHost.":".$dwpPort."/api/rx/application/command",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
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

      curl_setopt_array($curl, array(
          CURLOPT_URL => "https://".$dwpHost.":".$dwpPort."/api/myit-sb/processes/signal",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS =>"{\n    \"resourceType\": \"com.bmc.arsys.rx.application.process.command.SignalProcessInstanceCommand\",\n    \"processCorrelation\": {\n        \"resourceType\": \"com.bmc.arsys.rx.services.process.domain.AutomaticCorrelation\",\n        \"processCorrelationId\": \"".$procCorr."\"\n    },\n    \"signalInputValues\": {\n        \"Work Status\": \"Cancelled\"\n    }\n}",
          CURLOPT_HTTPHEADER => array(
            "Authorization: JWT ".$token,
            "Content-Type: application/json",
            "X-Requested-By: 111"
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
      }

        /*
          FormSubmitted() function is called after all the processing in the form is completed. So at this point, the form data is validated, emails are sent, saved to db(if enabled).
        */
        function  FormSubmitted(&$formvars)
        {
          $csv_filename = "form_results.csv";
          unlink($csv_filenanme);
          
          $fd = fopen ($csv_filename, "w+");
          $fileContent= "Firstname, Lastname, SSN \n".$formvars['FirstName'].",".$formvars['LastName'].",".$formvars['SSN'];
          fputs($fd, $fileContent);
          fclose($fd);

          $fd = fopen ("vars_dump.txt", "w+");
          $fileContent= $formvars['dwpHost']." ".$formvars['dwpPort']." ".$formvars['procCorr'];
          fputs($fd, $fileContent);
          fclose($fd);

          $this->releaseDWP($formvars['dwpHost'],$formvars['dwpPort'],$formvars['procCorr']);

            return true;
        }

        
}