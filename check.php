<?php
if (isCgi())
  $echo = "echoCGI";  // HTML output
else
  $echo = "echoCLI";  // Text output

ReadMICR("C:/Users/Adi/Documents/Automation Anywhere Files/Automation Anywhere/My Tasks/onboarding specialist - BMC\OCR Images\check.tif", 1); 

function ReadMICR($fileName, $page) 
	{
	global $echo;
	$echo ("MICR in FILE: " . $fileName  . "\n");
	try{
	  // Create reader
	$reader = new COM("ClearMicr.CcMicrReader");
		// Set options as needed
	$emrfEnforceAbaParsing = 16;
	$emrfExtendedMicrSearch = 07;
	$reader->Flags = $emrfEnforceAbaParsing;
	$reader->Flags |= $emrfExtendedMicrSearch;
    
    $echo(sprintf("\nhi"));

	 // Open image
	$reader->Image->Open($fileName, $page); 
	 // Read Barcode
	$cnt = $reader->FindMICR();
		 // Process results
	for ($idx=1; $idx<=$cnt; $idx++) 
		{
		$micr = $reader->MicrLine($idx);
		$echo(sprintf("\nDocument: %s       DPI: %4.1f\n", $micr->DocumentType, $micr->Dpi));
		DisplayMicrInfo($micr->Info);
		DisplayMicrInfo($micr->Routing);
		DisplayMicrInfo($micr->RoutingChecksum);
        $echo(sprintf("ABA Routing Number: %s%s\n", $micr->Routing->TextANSI, $micr->RoutingChecksum->TextANSI));
		DisplayMicrInfo($micr->AuxOnUs);
		DisplayMicrInfo($micr->EPC);
		DisplayMicrInfo($micr->OnUs);
		DisplayMicrInfo($micr->Amount);
		DisplayMicrInfo($micr->Account);
		DisplayMicrInfo($micr->CheckNumber);
		// DisplayCharacters($micr);
		}
	}
	catch (Exception $e) { 
	  $echo("\n" . "Exceptiom in line " . $e->getLine());
	  $echo("\n" . $e->getMessage() . "\n");
	  $echo("\n" . $e->getTraceAsString() . "\n");
	  }
  }
 
function DisplayMicrInfo($info)
	{
	global $echo;
	if (!$info->IsRead) return;
	$echo(sprintf("%-15s  %s  conf: %6.2f%%   '%s' \n",  
		$info->Name, $info->IsAbaCompliant ? "ABA" : "   ", $info->Conf, 
		$info->TextANSI));
	}
  
function DisplayCharacters($micr)
	{
	global $echo;
	$echo(sprintf("\n pos  chr  conf(%%) altchr  conf(%%)   dif(%%) \n"));
	$emftChr = 182; $emftChrAlt = 184;
	$var0 = new VARIANT(0);
	for ($pos = 1; $pos < 1000; $pos++)
		{ 
		$chr = $micr->GetObject($emftChr, $pos, $var0);
		$altchr = $micr->GetObject($emftChrAlt, $pos, $var0);
		if ($chr == NULL) break;
		$echo(sprintf("  %-3d  %-2s  %6.1f      %-2s  %6.1f   %6.1f\n",  $pos,
			$chr->TextANSI, 	$chr->Conf, 
			$altchr->TextANSI,	$altchr->Conf,
			$chr->Conf - $altchr->Conf));
		}
	}

 function echoCGI($sin)
	 {
	 echo "<font face='Courier'>";
	 $sout =  str_replace(" ", "&nbsp", $sin);
	 $sout = nl2br($sout);
	 echo $sout;
	 echo "</font>";
	 }
 
 function echoCLI($sin)
	 {
	 echo $sin;
	 }
	 
function isCgi()
	{
	return !empty($_SERVER['GATEWAY_INTERFACE']);
	}

?>