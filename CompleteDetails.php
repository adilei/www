<?PHP
/*
Simfatic Forms Main Form processor script

This script does all the server side processing. 
(Displaying the form, processing form submissions,
displaying errors, making CAPTCHA image, and so on.) 

All pages (including the form page) are displayed using 
templates in the 'templ' sub folder. 

The overall structure is that of a list of modules. Depending on the 
arguments (POST/GET) passed to the script, the modules process in sequence. 

Please note that just appending  a header and footer to this script won't work.
To embed the form, use the 'Copy & Paste' code in the 'Take the Code' page. 
To extend the functionality, see 'Extension Modules' in the help.

*/

@ini_set("display_errors", 1);//the error handler is added later in FormProc
error_reporting(E_ALL);

require_once(dirname(__FILE__)."/includes/CompleteDetails-lib.php");
$formproc_obj =  new SFM_FormProcessor('CompleteDetails');
$formproc_obj->initTimeZone('Asia/Jerusalem');
$formproc_obj->setFormID('0753471c-5ec2-4ec0-9ca1-e9ba8d93b3a8');
$formproc_obj->setRandKey('42ab87b3-8bfb-477c-bca4-cdae11a6e89c');
$formproc_obj->setFormKey('fc258910-6f0a-469b-9c3b-6f3f07dd649d');
$formproc_obj->setLocale('en-US','M/d/yyyy');
$formproc_obj->setEmailFormatHTML(true);
$formproc_obj->EnableLogging(false);
$formproc_obj->SetDebugMode(false);
$formproc_obj->setIsInstalled(true);
$formproc_obj->SetPrintPreviewPage(sfm_readfile(dirname(__FILE__)."/templ/CompleteDetails_print_preview_file.txt"));
$formproc_obj->SetSingleBoxErrorDisplay(true);
$formproc_obj->setFormPage(0,sfm_readfile(dirname(__FILE__)."/templ/CompleteDetails_form_page_0.txt"));
$formproc_obj->AddElementInfo('SSN','text','');
$formproc_obj->AddElementInfo('marital_status','listbox','');
$formproc_obj->AddElementInfo('FileUpload','file','');
$formproc_obj->setIsInstalled(true);
$formproc_obj->setFormFileFolder('./formdata');
$formproc_obj->SetHiddenInputTrapVarName('t1fad5aa87d04cdb8e960');
$page_renderer =  new FM_FormPageDisplayModule();
$formproc_obj->addModule($page_renderer);

$validator =  new FM_FormValidator();
$validator->addValidation("SSN","required","Please fill in SSN");
$validator->addValidation("SSN","alnum","The input for SSN should be a valid alpha-numeric value");
$validator->addValidation("FileUpload","req_file","File upload is required for FileUpload");
$formproc_obj->addModule($validator);

$upld =  new FM_FileUploadHandler();
$upld->SetFileUploadFields(array('FileUpload'));
$formproc_obj->addModule($upld);

$csv_maker =  new FM_FormDataCSVMaker(1024);
$csv_maker->AddCSVVariable(array('_sfm_form_submision_time_','_sfm_unique_id_','SSN','marital_status','FileUpload','_sfm_visitor_ip_'));
$formproc_obj->addModule($csv_maker);

$tupage =  new FM_ThankYouPage(sfm_readfile(dirname(__FILE__)."/templ/CompleteDetails_thank_u.txt"));
$formproc_obj->addModule($tupage);

$validator->SetFileUploader($upld);
$thumbnail =  new FM_ThumbnailModule();
$formproc_obj->AddExtensionModule($thumbnail);
$csv_maker->SetFileUploader($upld);
$page_renderer->SetFormValidator($validator);
$page_renderer->SetFileUploader($upld);
$formproc_obj->ProcessForm();

?>