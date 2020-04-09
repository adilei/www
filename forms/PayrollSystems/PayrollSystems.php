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

require_once(dirname(__FILE__)."/includes/PayrollSystems-lib.php");
$formproc_obj =  new SFM_FormProcessor('PayrollSystems');
$formproc_obj->initTimeZone('default');
$formproc_obj->setFormID('ec5a2a24-8f08-4900-bcec-775bbf2af4d7');
$formproc_obj->setRandKey('b84f4997-4b28-488f-bcc6-5751b6089c05');
$formproc_obj->setFormKey('9fa0b689-9f77-492b-a722-dc4e92c12b78');
$formproc_obj->setLocale('en-US','M/d/yyyy');
$formproc_obj->setEmailFormatHTML(true);
$formproc_obj->EnableLogging(true);
$formproc_obj->SetDebugMode(true);
$formproc_obj->setIsInstalled(true);
$formproc_obj->SetPrintPreviewPage(sfm_readfile(dirname(__FILE__)."/templ/PayrollSystems_print_preview_file.txt"));
$formproc_obj->SetSingleBoxErrorDisplay(true);
$formproc_obj->setFormPage(0,sfm_readfile(dirname(__FILE__)."/templ/PayrollSystems_form_page_0.txt"));
$formproc_obj->setFormPage(1,sfm_readfile(dirname(__FILE__)."/templ/PayrollSystems_form_page_1.txt"));
$formproc_obj->setFormPage(2,sfm_readfile(dirname(__FILE__)."/templ/PayrollSystems_form_page_2.txt"));
$formproc_obj->setFormPage(3,sfm_readfile(dirname(__FILE__)."/templ/PayrollSystems_form_page_3.txt"));
$formproc_obj->AddElementInfo('Username','text','',0);
$formproc_obj->AddElementInfo('Textbox33','text','',0);
$formproc_obj->AddElementInfo('Textbox','text','',1);
$formproc_obj->AddElementInfo('Textbox13','text','',1);
$formproc_obj->AddElementInfo('Textbox1','text','',1);
$formproc_obj->AddElementInfo('Textbox14','text','',1);
$formproc_obj->AddElementInfo('Textbox16','text','',1);
$formproc_obj->AddElementInfo('Textbox10','text','',1);
$formproc_obj->AddElementInfo('Textbox15','text','',1);
$formproc_obj->AddElementInfo('Textbox11','text','',1);
$formproc_obj->AddElementInfo('Textbox12','text','',1);
$formproc_obj->AddElementInfo('Multiline','multiline','',1);
$formproc_obj->AddElementInfo('Textbox17','text','',2);
$formproc_obj->AddElementInfo('Textbox6','text','',2);
$formproc_obj->AddElementInfo('Textbox9','text','',2);
$formproc_obj->AddElementInfo('Textbox8','text','',2);
$formproc_obj->AddElementInfo('Textbox7','text','',2);
$formproc_obj->AddElementInfo('CheckBoxSingle','single_chk','',2);
$formproc_obj->AddElementInfo('DatePicker3','datepicker','',2);
$formproc_obj->AddElementInfo('CheckBoxSingle1','single_chk','',2);
$formproc_obj->AddElementInfo('DatePicker4','datepicker','',2);
$formproc_obj->AddElementInfo('CheckBoxSingle2','single_chk','',2);
$formproc_obj->AddElementInfo('DatePicker5','datepicker','',2);
$formproc_obj->AddElementInfo('Textbox18','text','',3);
$formproc_obj->AddElementInfo('Textbox19','text','',3);
$formproc_obj->AddElementInfo('Textbox20','text','',3);
$formproc_obj->AddElementInfo('Textbox21','text','',3);
$formproc_obj->AddElementInfo('Textbox22','text','',3);
$formproc_obj->AddElementInfo('Textbox23','text','',3);
$formproc_obj->AddElementInfo('Textbox24','text','',3);
$formproc_obj->AddElementInfo('Textbox25','text','',3);
$formproc_obj->AddElementInfo('Textbox26','text','',3);
$formproc_obj->AddElementInfo('Textbox27','text','',3);
$formproc_obj->AddElementInfo('Textbox28','text','',3);
$formproc_obj->AddElementInfo('Textbox29','text','',3);
$formproc_obj->AddElementInfo('Textbox30','text','',3);
$formproc_obj->AddElementInfo('Textbox31','text','',3);
$formproc_obj->AddElementInfo('Textbox32','text','',3);
$formproc_obj->SetSavedMessageTemplate(sfm_readfile(dirname(__FILE__)."/templ/PayrollSystems_saved_msg.txt"));
$formproc_obj->setIsInstalled(true);
$formproc_obj->setFormFileFolder('./formdata');
$formproc_obj->setFormDBLogin('localhost','root','','RPA');
$formproc_obj->DisableAntiSpammerSecurityChecks();
$page_renderer =  new FM_FormPageDisplayModule();
$formproc_obj->addModule($page_renderer);

$admin_page =  new FM_AdminPageHandler();
$admin_page->SetPageTemplate(sfm_readfile(dirname(__FILE__)."/templ/PayrollSystems_admin_page_templ.txt"));
$admin_page->SetLogin('admin','E7DBCF2F566F2175');
$admin_page->SetLoginTemplate(sfm_readfile(dirname(__FILE__)."/templ/PayrollSystems_admin_page_login.txt"));
$formproc_obj->addModule($admin_page);

$tupage =  new FM_ThankYouPage(sfm_readfile(dirname(__FILE__)."/templ/PayrollSystems_thank_u.txt"));
$formproc_obj->addModule($tupage);

$formproc_obj->ProcessForm();

?>