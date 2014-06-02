<?php

ini_set('display_errors',1); 
error_reporting(E_ALL);

if($_SERVER["HTTPS"] != "on") {
	header("Location: https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
}
if(session_id() == "") { //Session is started in header.php of 
	session_start();
}	
 
//Check if we have received a connection_token
if ( ! empty ($_POST['connection_token'])){
  //Get connection_token
  $token = $_POST['connection_token'];
 
  //Your Site Settings
  $site_subdomain = 'clevernotes';
  $site_public_key = '4ec2fe36-4829-4f07-bf77-ca13a2aa4e16';
  $site_private_key = '7a388038-d70e-4c72-aa42-3fe05fecd211';
 
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
	
	//Sandbox WSDL
	//$wsdl="/phptoolkit/cUserLogin.sandbox.xml";
	
	//Production WSDL
	$wsdl="phptoolkit/cUserLogin.xml";
	
	$NAMESPACE = "http://soap.sforce.com/schemas/class/cUserLogin";
	
	$sforce_header = new SoapHeader($NAMESPACE, "SessionHeader", array("sessionId" => $sessionID));
	$client = new soapclient($wsdl);
	$client->__setSoapHeaders(array($sforce_header));
	
	 
	$first_name = (isset($loginInfo->identity->name->givenName) ? $loginInfo->identity->name->givenName : null);
	$last_name = (isset($loginInfo->identity->name->familyName) ? $loginInfo->identity->name->familyName : null);
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
							'user_id'=>$user_id);
	
  try{
	   $result = $client->loginUser($userInfo);  

	   // adds it to our session 
	   $_SESSION['success']=$result->result->success; // Was the call to Salesforce a success
	   $_SESSION['cntId']=$result->result->cntId; // Set the contact ID
	   $_SESSION['bNewUser']=$result->result->bNewUser; // Is this a new users
	   $_SESSION['cnt']=$result->result->cnt; // Set the contact record
	   $_SESSION['subjects']=$result->result->subjects; // A list of the curent certs and subjects on Salesforce
	   $_SESSION['ContactSubjects']=(isset($result->result->ContactSubjects) ? $result->result->ContactSubjects : null); // Set the ContactSubjects session variable to store the chosen subjects
	   //header("Location: /wp-content/themes/clevernotes/profile-page-test.php");
	   if($result->result->bNewUser)header("Location: https://".$_SERVER['HTTP_HOST']."/profile/");
			   // Else send them to the welcome page
       else header("Location: https://".$_SERVER['HTTP_HOST']."/");	
	   //header("Location: /profile/");
	   exit;
  }
  catch(Exception $e) {
	   print "<pre>";
	   print_r($e);
	   print "</pre>";
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

<html>
    <head>
        <script type="text/javascript">
			var oneall_js_protocol = (("https:" == document.location.protocol) ? "https" : "http");
			document.write(unescape("%3Cscript src='" + oneall_js_protocol + "://clevernotes.api.oneall.com/socialize/library.js' type='text/javascript'%3E%3C/script%3E"));
		</script>
    </head>
    <body>
        <!-- The plugin will be embedded into this div //-->
		<div id="social_login_container"></div>

		<script type="text/javascript">
         oneall.api.plugins.social_login.build("social_login_container", {
          'providers' :  ['facebook'], 
          'css_theme_uri': 'https://oneallcdn.com/css/api/socialize/themes/buildin/signup/large-v1.css',
          'grid_size_x': '1',
          'grid_size_y': '1',
          'callback_uri': 'https://www.clevernotes.org/sfdc/oa-login-test.php'
         });
        </script>
        
    </body>
</html>