<?php

ini_set('display_errors',1); 
error_reporting(E_ALL);

if($_SERVER["HTTPS"] != "on") {
	header("Location: https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
}
if(session_id() == "") { //Session is started in header.php of 
	session_start();
}	

// require_once ('/var/www/sfdc/utils.php');

require_once ('/nas/wp/www/cluster-1716/clevernotes/sfdc/utils.php');

//Check if we have received a connection_token
if ( ! empty ($_POST['connection_token'])){
  //Get connection_token
  $token = $_POST['connection_token'];
 
  //Your Site Settings
 
  // Prod OA Credentials
  $site_subdomain = 'clevernotesie';
  $site_public_key = 'b4bf7b08-a88f-4bf1-81aa-d11e8aab61f2';
  $site_private_key = 'be9066da-5ed8-44b0-a692-fd75f10b56fd';
  
  // Test OA Credentials
  //$site_subdomain = 'clevernotes';
  //$site_public_key = '4ec2fe36-4829-4f07-bf77-ca13a2aa4e16';
  //$site_private_key = '7a388038-d70e-4c72-aa42-3fe05fecd211';
 
  //API Access domain
  $site_domain = $site_subdomain.'.api.oneall.com';
 
  //Connection Resource
  //http://docs.oneall.com/api/resources/connections/read-connection-details/
  $resource_uri = 'https://'.$site_domain.'/connections/'.$token .'.json';
 
  //Setup connection
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $resource_uri);
  curl_setopt($curl, CURLOPT_HEADER, 0);
  curl_setopt($curl, CURLOPT_USERPWD, $site_public_key . ":" . $site_private_key);
  curl_setopt($curl, CURLOPT_TIMEOUT, 15);
  curl_setopt($curl, CURLOPT_VERBOSE, 0);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 1);
  curl_setopt($curl, CURLOPT_FAILONERROR, 0);
 
  //Send request
  $result_json = curl_exec($curl);
  //print_r($result_json);
  //Error
  if ($result_json === false)
  {
    //You may want to implement your custom error handling here
    echo 'Curl error: ' . curl_error($curl). '<br />';
    echo 'Curl info: ' . curl_getinfo($curl). '<br />';
    curl_close($curl);
  }
  //Success
  else
  {
    //Close connection 
    curl_close($curl);
 	//print_r($curl);
    //Decode
    $json = json_decode ($result_json);
 
    //Extract data
    $data = $json->response->result->data;
 
    //Check for plugin
    if ($data->plugin->key == 'social_login'){
      //Operation successfull
      if ($data->plugin->data->status == 'success'){
		sfLogin($data->user);
      }
    }
  }
}


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function sfLogin($loginInfo){
	require_once ('login.php');
	
	if($sfdcSandbox){ 
		//Sandbox WSDL
//		$wsdl="/var/www/sfdc/phptoolkit/cUserLogin.sandbox.xml";
		$wsdl="/nas/wp/www/cluster-1716/clevernotes/sfdc/phptoolkit/cUserLogin.sandbox.xml";

		
	}else{
		//Production WSDL
//		$wsdl="/var/www/sfdc/phptoolkit/cUserLogin.xml";
		$wsdl="/nas/wp/www/cluster-1716/clevernotes/sfdc/phptoolkit/cUserLogin.xml";

	}
	
	$NAMESPACE = "http://soap.sforce.com/schemas/class/cUserLogin";
	
	$sforce_header = new SoapHeader($NAMESPACE, "SessionHeader", array("sessionId" => $sessionID));
	$client = new soapclient($wsdl);
	$client->__setSoapHeaders(array($sforce_header));
	
	 
	$first_name = (isset($loginInfo->identity->name->givenName) ? $loginInfo->identity->name->givenName : null);
	$last_name = (isset($loginInfo->identity->name->familyName) ? $loginInfo->identity->name->familyName : 'Unknown');
	$username = (isset($loginInfo->identity->preferredUsername) ? $loginInfo->identity->preferredUsername : null);  
	// TO DO: OA provides can provide more than one email address.  Setup login script to pass multiple email addresses
	$emails[] = $loginInfo->identity->emails;
	$email = (isset($emails[0][0]->value) ? $emails[0][0]->value : null);
	$birthday = (isset($loginInfo->identity->birthday) ? $loginInfo->identity->birthday : null); 
	$gender = (isset($loginInfo->identity->gender) ? $loginInfo->identity->gender : null); 
	$location = (isset($loginInfo->identity->currentLocation) ? $loginInfo->identity->currentLocation : null); 
	$picture = (isset($loginInfo->identity->pictureUrl) ? $loginInfo->identity->pictureUrl : null);
	$link = (isset($loginInfo->identity->profileUrl) ? $loginInfo->identity->profileUrl : null);
	$network = (isset($loginInfo->identity->provider) ? $loginInfo->identity->provider : null);
	$user_id = (isset($loginInfo->uuid) ? $loginInfo->uuid : null);
	
	// Get the birthdate
	if($birthday!=null){
		date_default_timezone_set('Europe/Dublin');
		$time = strtotime( $birthday );
		$birthday = date( "d/m/Y",$time );//."T".date( "H:i:s", $time ).'.000Z';
	}
	$userInfo[] = array(	'first_name'=>$first_name,							
							'last_name'=>$last_name,
							'username'=>$username,
							'email'=>$email,
							'birthday'=>$birthday,							
							'gender'=>$gender,
							'location'=>$location,
							'picture'=>$picture,
							'link'=>$link,
							'network'=>$network,
							'Email_Opt_In__c'=>1,
							'user_id'=>$user_id);
	
  try{
		$result = $client->loginUser($userInfo);  
		
		if(!$result->result->success==1){			
			$msg=$result->result->errorMessage;	
			$msg.= ' $userInfo:' . var_export($userInfo,true);
			emailAdmin($msg);
			//$ref = getenv('HTTP_REFERER');			
			//header("Location: $ref");
			exit;
		   
		}
		// adds it to our session 
		$_SESSION['success']=$result->result->success; // Was the call to Salesforce a success
		$_SESSION['cntId']=$result->result->cntId; // Set the contact ID
		if($_SESSION['cntId']=='')$_SESSION['cntId']=$result->result->cnt->Id; 
		$_SESSION['bNewUser']=$result->result->bNewUser; // Is this a new users
		$_SESSION['cnt']=$result->result->cnt; // Set the contact record
		$_SESSION['subjects']=$result->result->subjects; // A list of the curent certs and subjects on Salesforce
		$_SESSION['ContactSubjects']=(isset($result->result->ContactSubjects) ? $result->result->ContactSubjects : null); // Set the ContactSubjects session variable to store the chosen subjects
		
		//header("Location: /wp-content/themes/clevernotes/profile-page-test.php");
		if($result->result->bNewUser)header("Location: https://".$_SERVER['HTTP_HOST']."/profile/");
		// Else send them to the welcome page
		else header("Location: https://".$_SERVER['HTTP_HOST']."/");	
		/*print('<h2>Result</h2><pre>');
		print_r($result);		
		print '</pre>';*/
		/*print('<h2>$_SESSION</h2><pre>');
		print_r($_SESSION);		
		print '</pre>';*/
		exit;
	}
	catch(Exception $e) {
		
		$msg=$e;
		$msg.=': Error: oa.login.php.';
		emailAdmin($msg); 
		//$ref = getenv('HTTP_REFERER');
		// header("Location: https://www.clevernotes.ie/login-error/");
		header("Location: https://clevernotes.wpengine.com/login-error/");
		exit;
 	 }
  
  /*
  // The following values are not provided by OA
  $age
  $age_group = (isset($loginInfo['profile']['age_group']) ? $loginInfo['profile']['age_group'] : null);	
  $marital_status = (isset($loginInfo['profile']['marital_status']) ? $loginInfo['profile']['marital_status'] : null);
  $last_login = (isset($loginInfo['last_login']) ? $loginInfo['last_login'] : null);		
  $status = (isset($loginInfo['status']) ? $loginInfo['status'] : null);													  	
  */
}     
?>