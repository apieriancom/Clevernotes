<?php

ini_set('display_errors',1); 
error_reporting(E_ALL);

// Disable caching of WSDL files
ini_set('soap.wsdl_cache_enabled', '0');
ini_set('soap.wsdl_cache_ttl', '0');

// require_once ('/var/www/sfdc/utils.php');
require_once ('/nas/wp/www/cluster-1716/clevernotes/sfdc/utils.php');


// Include the PHP Toolkit
require_once ('phptoolkit/SforcePartnerClient.php');
require_once ('phptoolkit/SforceHeaderOptions.php');

$sfdcSandbox=false;

// Login
$sfdc = new SforcePartnerClient();

// Demo Org WSDL
//$SoapClient = $sfdc->createConnection('phptoolkit/demoorg.wsdl.xml');

if($sfdcSandbox){
	// Sandbox WSDL
	// $SoapClient = $sfdc->createConnection('/var/www/sfdc/phptoolkit/partner.sandbox.wsdl.xml');
	$SoapClient = $sfdc->createConnection('/nas/wp/www/cluster-1716/clevernotes/sfdc/phptoolkit/partner.sandbox.wsdl.xml');
	
	/// Dev Sandbox
	$username = 'rob@apierian.com.dev';
	$password = 'qwesdf231';
	$token = '6xKsYtUboOtOb1gJakC28dNvf'; 
	
}else{
	// Production WSDL
	// $SoapClient = $sfdc->createConnection('/var/www/sfdc/phptoolkit/partner.wsdl.xml');
	$SoapClient = $sfdc->createConnection('/nas/wp/www/cluster-1716/clevernotes/sfdc/phptoolkit/partner.wsdl.xml');
	
	/// APIERIAN PROD ORG ///////////////
	$username = 'rob@apierian.com';
	$password = 'qwesdf2314';
	$token = 'PFB2m6DJ6g4qNPEvfKvxEjLak';

	
}
try{
	$loginResult = false;
	$loginResult = $sfdc->login($username, $password . $token);
	$sessionID = $sfdc->getSessionId();
}
catch(Exception $e) {		
	$msg=$e;
	$msg.=$loginResult;
	$msg.=': Error: login.php. ';
	emailAdmin($msg); 
	$ref = getenv('HTTP_REFERER');
	header("Location: http://". $host);
	exit;
 }

?>