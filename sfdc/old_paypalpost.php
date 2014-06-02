<?php

if(isset($_POST['vcode'])){
	
	if(session_id() == "") { //Session is started in header.php of 
		session_start();
	}	
	$payPalSandbox=false;
	
	// Build the PayPal URL to post redirect to
	if($payPalSandbox){
		//PayPal Sandbox URL
		$ppURL = 'https://sandbox.paypal.com/cgi-bin/webscr?cmd=_s-xclick';
	}else{
		// PayPal Live URL
		$ppURL = 'https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick';
	}
	//Add the salesforce contact ID
	$cnt=$_SESSION['cnt']; // Set the contact array from the Session 
	$ppURL.='&custom='.$cnt->Id;
	$errMsg='';
	//Check to see if the Voucher code is present	
	if($_POST['vcode']!=''){
		$result = validateVoucherCode($_POST['vcode']);
		
		if($result->result->success){			
			$ppURL.='_'.$result->result->vCodeID;
			$ppURL.='&hosted_button_id='.$result->result->paypalid;
		}else $errMsg=$result->result->errorMessage;
		/*
		print '<pre>';
		print_r($result);
		print '</pre>';*/
	}
	// If not voucher code redirect the user to the standard button
	//Redirect to the PayPal sanbox button
	else if($payPalSandbox) $ppURL.='&hosted_button_id=AKTM3Q48FARNQ';
	//Else redirect to the PayPal production button
	else $ppURL.='&hosted_button_id=Y62GUGJN4PJHY';
	// Redirect to Completmentory button
	//else $ppURL.='&hosted_button_id=47PA9JHGUNKN4';
	
	//print $ppURL;
	
	//If no errors redirect the user to the PayPal page.
	if($errMsg=='')header("Location: ". $ppURL);
	
	//Else redirect back to the membership page and display the error message.
	else header("Location: /membership/?errMsg=".$errMsg);
	
}else header("Location: /membership/");

function validateVoucherCode($vcode){
	
	require_once ('login.php');
	if($sfdcSandbox){ 
		//Sandbox WSDL
		$wsdl="phptoolkit/cValidateVoucherCode.sandbox.xml";		
	}else{
		//Production WSDL
		$wsdl="phptoolkit/cValidateVoucherCode.xml";
	}	 
	$NAMESPACE = "http://soap.sforce.com/schemas/class/cValidateVoucherCode";
	
	$sforce_header = new SoapHeader($NAMESPACE, "SessionHeader", array("sessionId" => $sessionID));
	$client = new soapclient($wsdl);
	$client->__setSoapHeaders(array($sforce_header));
	
	$VoucherCodes[] = array('vcode'=>$vcode);
	$result = $client->ValidateVoucherCode($VoucherCodes);  
	return $result;
}
?>