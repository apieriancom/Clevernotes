<?php

ini_set('display_errors',1); 
error_reporting(E_ALL);

// Disable caching of WSDL files
ini_set('soap.wsdl_cache_enabled', '0');
ini_set('soap.wsdl_cache_ttl', '0');

// Include the PHP Toolkit
// require_once ('/var/www/wp-content/themes/clevernotes/phptoolkit/SforcePartnerClient.php');
// require_once ('/var/www/wp-content/themes/clevernotes/phptoolkit/SforceHeaderOptions.php');
require_once ('/nas/wp/www/cluster-1716/clevernotes/wp-content/themes/clevernotes/phptoolkit/SforcePartnerClient.php');
require_once ('/nas/wp/www/cluster-1716/clevernotes/wp-content/themes/clevernotes/phptoolkit/SforceHeaderOptions.php');

// Login
$sfdc = new SforcePartnerClient();
// $SoapClient = $sfdc->createConnection(//'/var/www/wp-content/themes/clevernotes/phptoolkit/demoorg.wsdl.xml');
// '/var/www/wp-content/themes/clevernotes/phptoolkit/partner.sandbox.wsdl.xml');
$SoapClient = $sfdc->createConnection('/nas/wp/www/cluster-1716/clevernotes/wp-content/themes/clevernotes/phptoolkit/partner.sandbox.wsdl.xml');
//$SoapClient = $sfdc->createConnection('phptoolkit/partner.sandbox.wsdl.xml');

/// APIERIAN PROD ORG ///////////////
/*$username = 'rob@apierian.com';
$password = 'qwesdf23';
$token = 'AS5sXhGOnjI5Sd03ZOEK08jqe';*/
 
//// DEMO ORG  //////////////
/*$username = 'markdamo@gmail.com';
$password = 'Arenadj1';
$token = '8deF2jkSabMLNEsr72HIoF8a';*/

/// Dev Sandbox
$username = 'rob@apierian.com.dev';
$password = 'qwesdf23';
$token = 'xQTZTKMm5UCRLF7y5VhuzzAvX';

$loginResult = false;
$loginResult = $sfdc->login($username, $password . $token);
$sessionID = $sfdc->getSessionId();
// TODO - EMAIL ADMIN IF LOGIN FAILS
//echo('Login Result :' . var_dump($loginResult));

?>
