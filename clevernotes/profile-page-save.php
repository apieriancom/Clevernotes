<?php
/**
 *Template Name: User Profile
*/

ini_set('display_errors',1); 
error_reporting(E_ALL);
date_default_timezone_set('Europe/Dublin');
require_once ('/var/www/sfdc/utils.php');
if(session_id() == "") { //Session is started in header.php of 
	session_start();
}	

if (!isset($_SESSION['cntId'])) : //No SalesForce ID so send to login page
	header("Location: /login/");
endif;

if(isset($_POST['submit'])){	
	try{
		require_once ('/var/www/sfdc/login.php');
		$_SESSION['profileupdate']='no';
		$Student__c=0;
		$Parent__c=0;
		$Teacher__c=0;
		$Other__c=0;
		$Email_Opt_In__c=0;
		
		if(isset($_POST["Student__c"]))$Student__c=1;
		if(isset($_POST["Parent__c"]))$Parent__c=1;
		if(isset($_POST["Teacher__c"]))$Teacher__c=1;
		if(isset($_POST["Other__c"]))$Other__c=1;
		if(isset($_POST["Email_Opt_In__c"]))$Email_Opt_In__c=1;
		
		$cnt=$_SESSION['cnt']; // Set the contact array from the Session 
		
		// Get the birthdate
		$birthday = null;
		
		if (!empty($_POST['Birthdate'])){
			date_default_timezone_set('Europe/Dublin');
			//$time = strtotime( $birthday );
			//$birthday = date( "d/m/Y",$time );//."T".date( "H:i:s", $time ).'.000Z';
			echo 'TEST'.$_POST['Birthdate'];
			$time = strtotime( $_POST['Birthdate'] );
			$birthday = date( "Y-m-d",$time )."T".date( "H:i:s", $time ).'.000Z';
		}
		
		// Build the contact record
		$records[0] = new SObject();
		$records[0]->Id = $_SESSION['cntId'];
		$records[0]->fields = array(
			'FirstName' => $_POST['FirstName'],
			'LastName' => $_POST['LastName'],
			'Email' => $_POST['Email'],
			'MobilePhone' => $_POST['MobilePhone'],
			//'Birthdate' => $birthday,
			'MailingStreet' => $_POST['MailingStreet'],
			'MailingCity' => $_POST['MailingCity'],
			'MailingState' => $_POST['MailingState'],
			'MailingCountry' => $_POST['MailingCountry'],
			'Student__c' => $Student__c,
			'Parent__c' => $Parent__c,
			'Teacher__c' => $Teacher__c,
			'Other__c' => $Other__c,
			'Email_Opt_In__c' => $Email_Opt_In__c
		);
		if(!empty($birthday)){
			$records[0]->fields['Birthdate']=$birthday;
		}
		else {
			$records[0]->fieldsToNull = array("Birthdate");
		}
		$records[0]->type = 'Contact';	 // Set the salesforce object type
		$response = $sfdc->update($records, 'Contact'); // Update the contact record
		//print_r($response);
		if(!$response[0]->success){
			$msg=$response[0]->errors[0]->message;
			$msg.=': Error: profile-page-save.php.';
			emailAdmin($msg);
			header("Location: /profile/"); 
			exit;
		}
		// Call the cProfileSave WSDL and Namespace

		if($sfdcSandbox){ 
			//Sandbox WSDL
			$wsdl="/var/www/sfdc/phptoolkit/cProfileSave.sandbox.xml";	
		}else{
			//Production WSDL
			$wsdl="/var/www/sfdc/phptoolkit/cProfileSave.xml";
		}
		
		$NAMESPACE = "http://soap.sforce.com/schemas/class/cProfileSave";
		
		$sforce_header = new SoapHeader($NAMESPACE, "SessionHeader", array("sessionId" => $sessionID));
		$client = new soapclient($wsdl);
		$client->__setSoapHeaders(array($sforce_header));
		
		// Get the list of subjects from the session 
		$subjects = $_SESSION['subjects'];
		
		// Array to store the contact subject selections
		//$contactSubjects[];
		$i=0;
		$contactSubjects = array();
		foreach($subjects as $key_val => $subject) {
			$subjectId=$subject->Id;
			
			if(isset($_POST[$subjectId])){
				//print ('test: '.$_POST[$subjectId].'<br />');
				if($_POST[$subjectId]!=null)$contactSubjects[] = $_POST[$subjectId];
				//print_r($contactSubjects);
			}
		}
		
		
		
		$subjectIds=(isset($_POST['subject']) ? $_POST['subject'] : null);	
		
		// Setup the array of data to pass to Salesforce
		$saveProfile[] = array( 'cnt'=>$records[0],
								'contactSubjects'=>$contactSubjects);
		
		// Send the array to Salesforce
	
		$result = $client->saveProfile($saveProfile);  
		if($result->result->success)$_SESSION['profileupdate']='yes';
		else $_SESSION['profileupdate']='no';
		$_SESSION['cnt']= (isset($result->result->cnt) ? $result->result->cnt : null);	
		$_SESSION['subjects']=$result->result->subjects; // A list of the curent certs and subjects on Salesforce
    	$_SESSION['ContactSubjects']=(isset($result->result->ContactSubjects) ? $result->result->ContactSubjects : null); // Set the ContactSubjects session variable to store the chosen subjects
	}
	catch(Exception $e) {
		$msg=$e;
		$msg.=': Error: profile-page-save.php. ';
		emailAdmin($msg); 
		//print_r($e);
	}
		
	header("Location: /profile/");
	/*print '<pre><h2>Subjects</h2>';
	print_r ($_SESSION['subjects'][0]);
	print '</pre>';*/
	exit;

}


?>
