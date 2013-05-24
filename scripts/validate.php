<?php
error_reporting(E_ALL);
ini_set( 'display_errors','1');

defined('APPLICATION_PATH')
|| define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
realpath(APPLICATION_PATH . '/../library'),
get_include_path(),
)));


require_once ('Zend/Loader/Autoloader.php');
$autoloader = Zend_Loader_Autoloader::getInstance();

/*
 * Multilanguage configuration
 */

$translate = new Zend_Translate(
        array(
                'adapter' => 'gettext',
                'content' => './lang/validate-en.mo',
                'locale'  => 'en'
        )
);
$translate->addTranslation(
                array(
                                'content' => './lang/validate-es.mo',
                                'locale'  => 'es'
                )
);
$translate->addTranslation(
                array(
                                'content' => './lang/validate-ca.mo',
                                'locale'  => 'ca'
                )
);

/*
 * Form initialization
 */
$form = new Zend_Form;
$error=array();
$error['error']=FALSE;
$error['done']='';
$values = $form->getValues();

// Zend_Debug::dump($_POST);
// die;
/*
 * Prepare filter chains and get some values
 */
$emailValue='';
$nameValue='';
$commentsValue='';
$copyValue='';
$filterChain = new Zend_Filter();
$filterChain->addFilter(new Zend_Filter_StringTrim())
                        ->addFilter(new Zend_Filter_StripTags());
$commentsValue = $filterChain->filter($_POST['comments']);
$langValue = $filterChain->filter($_POST['lang']);

$translate->setLocale($langValue);
$translator = new Zend_Translate(
                array(
                                'adapter' => 'array',
                                'content' => 'resources/languages',
                                'locale'  => $langValue,
                                'scan' => Zend_Translate::LOCALE_DIRECTORY
                )
);
Zend_Validate_Abstract::setDefaultTranslator($translator);

if(isset($_POST['copy']))
        $copyValue = $filterChain->filter($_POST['copy']);

/*
 * Validate Username validator chain
 */
$nameError='';
$nameChain = new Zend_Validate();
$nameChain->addValidator(new Zend_Validate_StringLength(array('min' => 6,'max' => 50)))
->addValidator(new Zend_Validate_Alnum(array('allowWhiteSpace' => true)));

if ($nameChain->isValid($_POST['name'])) {
    // username passed validation
        $nameValue = $filterChain->filter($_POST['name']);
} else {
    // username failed validation; print reasons
    foreach ($nameChain->getMessages() as $message) {
        $nameError.=$message."\n";
        
        //echo "$message\n";
    }
    $error['error']=TRUE;
}
$error['nameError']=$nameError;


/*
 * Validate Email validator chain
 */
$emailError='';
$emailChain = new Zend_Validate();
$emailChain->addValidator(new Zend_Validate_EmailAddress());
if ($emailChain->isValid($_POST['email'])) {
        // email passed validation
        $emailValue = $filterChain->filter($_POST['email']);
} else {
        // email failed validation; print reasons
        foreach ($emailChain->getMessages() as $message) {
                $emailError.=$message."\n";
                //echo "$message\n";
        }
        $error['error']=TRUE;
}
$error['emailError']=$emailError;



// Validate recaptcha validator chain
$recaptchaError='';
$recaptcha = new Zend_Service_ReCaptcha('', '');
try {
        $recaptchaChain = $recaptcha->verify(
                        $_POST['recaptcha_challenge_field'],
                        $_POST['recaptcha_response_field']
        );
        if (!$recaptchaChain->isValid())
        {
                $recaptchaError=$translate->_("Not valid, try again.");
                $error['error']=TRUE;
        }       
}
catch (Zend_Exception $e)
{
        $recaptchaError=$e->getMessage() . "\n";
        $error['error']=TRUE;
}
$error['recaptchaError']=$recaptchaError;



if($error['error']===FALSE)
{
        require_once ('Zend/Gdata.php');
        require_once ('Zend/Gdata/Spreadsheets.php');
        require_once ('Zend/Gdata/ClientLogin.php');

        $user="";
        $pass="";
        $spreadsheetKey="";
        $worksheetId="od6";

        $service = Zend_Gdata_Spreadsheets::AUTH_SERVICE_NAME;
        $client = Zend_Gdata_ClientLogin::getHttpClient($user, $pass, $service);
        $spreadsheetService = new Zend_Gdata_Spreadsheets($client);

        $query = new Zend_Gdata_Spreadsheets_ListQuery();
        $query->setSpreadsheetKey($spreadsheetKey);
        $query->setWorksheetId($worksheetId);

        $data=array("email"=>$emailValue,
                        "name"=>$nameValue,
                        "comments"=>$commentsValue );

        $insertedListEntry = $spreadsheetService->insertRow($data,
                        $spreadsheetKey,
                        $worksheetId);


        $error['done']=$translate->_("<div id='thanksform'><h2>Ok... We will be in touch!!!</h2></div>");
        //header('Location: /');
}

if($copyValue==='copy-me' && $error['error']===FALSE)
{
        
        $conf['server']='smtp.gmail.com';
        $conf['ssl']='tls';
        $conf['port']='587';
        $conf['auth']='login';
        $conf['username']='';
        $conf['password']='';
        //*production*/         $transport = new Zend_Mail_Transport_Smtp();
        /*development*/ $transport = new Zend_Mail_Transport_Smtp($conf['server'], $conf);
        
        // Send Email
        $text=$translate->_("Dear ").$nameValue.",\n\n";
        $text.=$translate->_("This are your comments about Feedback Film Festival:")."\n".$commentsValue."\n\n";
        $text.=$translate->_("We will in touch.")."\n\n";
        $text.=$translate->_("Best regards,")."\n";
        $text.='Feedback - FISFF';
        
        $mail = new Zend_Mail();
        $mail->setBodyText($text, $charset = 'utf-8');
        //$mail->setBodyHtml($textEsp);
        $mail->setFrom('no-reply@feedback-filmfest.com', 'Feedback Film Festival');
        $mail->addTo($emailValue);
        $mail->setSubject($translate->_("Your comments about Feedback"));
        //$mail->send(); //Default transport
        $mail->send($transport);
}       


echo json_encode($error);
        
?>