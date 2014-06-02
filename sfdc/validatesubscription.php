<?php
	function validateSubscription(){
		if(session_id() == "") { //Session is started in header.php of 
			session_start();
		}
		if(isset($_SESSION['cnt']))$cnt=$_SESSION['cnt']; // Set the contact array from the Session 
		else return false;
		
		if($cnt->Subscription_End_Date__c!=null){
			if(checkDates($cnt->Subscription_End_Date__c))return true;
		}
		return callSF();
	}
	
	function callSF(){
		require_once ('/var/www/sfdc/login.php');
		$cnt=$_SESSION['cnt']; // Set the contact array from the Session 
		if($sfdcSandbox){ 
			//Sandbox WSDL
			$wsdl="/var/www/sfdc/phptoolkit/cUpdateUserSession.sandbox.xml";		
		}else{
			//Production WSDL
			$wsdl="/var/www/sfdc/phptoolkit/cUpdateUserSession.xml";
		}	 
		$NAMESPACE = "http://soap.sforce.com/schemas/class/cUpdateUserSession";
		
		$sforce_header = new SoapHeader($NAMESPACE, "SessionHeader", array("sessionId" => $sessionID));
		$client = new soapclient($wsdl);
		$client->__setSoapHeaders(array($sforce_header));
		
		$userDetails[] = array('cntId'=>$cnt->Id);
		//$userDetails[] = array('cntId'=>'003W000000EJjxR');
		$result = $client->updateUserSession($userDetails);  
		$cnt = (isset($result->result->cnt) ? $result->result->cnt : null);	
		if($cnt!=null) $_SESSION['cnt'] = $cnt;
		
		if(isset($cnt->Subscription_End_Date__c))return checkDates($cnt->Subscription_End_Date__c);
		else return false;
	}
	
	
	function checkDates($Subscription_End_Date__c){
		$todays_date = date("Y-m-d");	 
		$today = strtotime($todays_date);
		$expiration_date = strtotime($Subscription_End_Date__c);
	
		if ($expiration_date > $today) {
			 return true;
			 //print 'True';
		} else {
			 return false;
			 //print 'False';
		}
	}
	/*if(validateSubscription())print 'YES';
	else print 'NO';
	
	print '<pre>';
	print_r($_SESSION);
	print '</pre>';*/
?>