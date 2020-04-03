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

require_once(dirname(__FILE__)."/includes/New_Hire-lib.php");
$formproc_obj =  new SFM_FormProcessor('New_Hire');
$formproc_obj->initTimeZone('Asia/Jerusalem');
$formproc_obj->setFormID('6cda7e81-4396-46e4-8632-483acebe80b7');
$formproc_obj->setRandKey('8037188a-8ed9-4eff-b593-b93029d24dfc');
$formproc_obj->setFormKey('2c29c00c-5317-4193-8de5-cb4243c10444');
$formproc_obj->setLocale('en-US','M/d/yyyy');
$formproc_obj->setEmailFormatHTML(true);
$formproc_obj->EnableLogging(false);
$formproc_obj->SetDebugMode(false);
$formproc_obj->setIsInstalled(true);
$formproc_obj->SetPrintPreviewPage(sfm_readfile(dirname(__FILE__)."/templ/New_Hire_print_preview_file.txt"));
$formproc_obj->SetSingleBoxErrorDisplay(true);
$formproc_obj->setFormPage(0,sfm_readfile(dirname(__FILE__)."/templ/New_Hire_form_page_0.txt"));
$formproc_obj->AddElementInfo('Textbox','text','');
$formproc_obj->AddElementInfo('FileUpload','file','');
$formproc_obj->setIsInstalled(true);
$formproc_obj->setFormFileFolder('./formdata');
$formproc_obj->SetHiddenInputTrapVarName('t486f37bdbf36a2f3096d');
$page_renderer =  new FM_FormPageDisplayModule();
$formproc_obj->addModule($page_renderer);

$upld =  new FM_FileUploadHandler();
$upld->SetFileUploadFields(array('FileUpload'));
$formproc_obj->addModule($upld);

$csv_maker =  new FM_FormDataCSVMaker(1024);
$csv_maker->AddCSVVariable(array('_sfm_form_submision_time_','_sfm_unique_id_','Textbox','FileUpload'));
$formproc_obj->addModule($csv_maker);

$tupage =  new FM_ThankYouPage(sfm_readfile(dirname(__FILE__)."/templ/New_Hire_thank_u.txt"));
$formproc_obj->addModule($tupage);

$thumbnail =  new FM_ThumbnailModule();
$formproc_obj->AddExtensionModule($thumbnail);
$csv_maker->SetFileUploader($upld);
$page_renderer->SetFileUploader($upld);
$formproc_obj->ProcessForm();

?>