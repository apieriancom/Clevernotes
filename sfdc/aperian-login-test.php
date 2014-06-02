<?php

ini_set('display_errors',1); 
error_reporting(E_ALL);


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function sfLogin($loginInfo){
	require_once ('login.php');
	
	$wsdl="phptoolkit/cUserLogin.xml";
	$NAMESPACE = "http://soap.sforce.com/schemas/class/cUserLogin";
	
	$sforce_header = new SoapHeader($NAMESPACE, "SessionHeader", array("sessionId" => $sessionID));
	$client = new soapclient($wsdl);
	$client->__setSoapHeaders(array($sforce_header));
	$first_name = (isset($loginInfo['profile']['first_name']) ? $loginInfo['profile']['first_name'] : null);
	$last_name = (isset($loginInfo['profile']['last_name']) ?$loginInfo['profile']['last_name'] : null);
	$username = (isset($loginInfo['profile']['username']) ? $loginInfo['profile']['username'] : null);												
	$email = (isset($loginInfo['profile']['email']) ? $loginInfo['profile']['email'] : null);
	$birthday = (isset($loginInfo['profile']['birthday']) ? $loginInfo['profile']['birthday'] : null);												
	$age = (isset($loginInfo['profile']['age']) ? $loginInfo['profile']['age'] : null);	
	$age_group = (isset($loginInfo['profile']['age_group']) ? $loginInfo['profile']['age_group'] : null);	
	$gender = (isset($loginInfo['profile']['gender']) ? $loginInfo['profile']['gender'] : null);
	$marital_status = (isset($loginInfo['profile']['marital_status']) ? $loginInfo['profile']['marital_status'] : null);
	$location = (isset($loginInfo['profile']['location']) ? $loginInfo['profile']['location'] : null);	
	$picture = (isset($loginInfo['profile']['picture']) ? $loginInfo['profile']['picture'] : null);
	$link = (isset($loginInfo['profile']['link']) ? $loginInfo['profile']['link'] : null);											
	$network = (isset($loginInfo['network']) ? $loginInfo['network'] : null);	
	$user_id = (isset($loginInfo['user_id']) ? $loginInfo['user_id'] : null);
	$last_login = (isset($loginInfo['last_login']) ? $loginInfo['last_login'] : null);		
	$status = (isset($loginInfo['status']) ? $loginInfo['status'] : null);													  	
	$userInfo[] = array(	'first_name'=>$first_name,							
							'last_name'=>$last_name,
							'username'=>$username,
							'email'=>$email,
							'birthday'=>$birthday,
							'age'=>$age,
							'age_group'=>$age_group,
							'gender'=>$gender,
							'marital_status'=>$marital_status,
							'location'=>$location,
							'picture'=>$picture,
							'link'=>$link,
							'network'=>$network,
							'user_id'=>$user_id,
							'last_login'=>$last_login,
							'status'=>$status);
	
	
	try{
		$result = $client->loginUser($userInfo);  

		// adds it to our session 
		$_SESSION['success']=$result->result->success; 
		$_SESSION['cntId']=$result->result->cntId;
		$_SESSION['bNewUser']=$result->result->bNewUser;
		
		if($_SESSION['bNewUser']==1)header("Location: /profile/");
		else header("Location: /");
		exit;
		
		print "<h2>Session Details</h2><pre>";
		print_r ($_SESSION);
		print "</pre>";
		
		
		print "<h2>Login Info</h2><pre>";
		print_r($loginInfo);
		print "</pre>";
		
		print "<h2>User Info</h2><pre>";
		print "<pre>";
		print_r($userInfo);
		print "</pre>"; 
		
		print "<h2>Result</h2><pre>";
		print "<pre>";
		print_r($result);
		print "</pre>"; 
		
		
	}
	catch(Exception $e) {
		print "<pre>";
		print_r($e);
		print "</pre>";
		exit;
	}

}


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Learnosity


// JSON to be placed in the page
$json = '{
    "consumer_key": "wSIoIUPa4cA4aJf8",
    "timestamp": "20120101-0001",
    "user_id": "12345678",
    "module": "student",
    "courses": [{"id":"french101"},{"id":"german102"}],
    "user": {"firstname":"John","lastname":"Smith"}
}';

// Consumer secret (not to be placed in the page sent to the client)
$consumer_secret = 'c1341201e32a4a32e02e17a84260c5c79aec7fea';

// Domain where script is running 
$domain = $_SERVER['HTTP_HOST'];

// Call to generate the String concatenation that will be hashed
$preHashString = generateSsoPreHashString($json, $domain, $consumer_secret);

// $signature is created by hashing $preHashString
$signature = hash('sha256', $preHashString);

function arrayToStringForSignature($array) {
    $string = "";
    // Sort array by keys (comparing them as strings)
    ksort($array,SORT_STRING);
    foreach ($array as $key => $value) {
        if (strlen($string) > 0) {
            $string .= "_";
        }
        if (is_array($value)) {
            // if value is array, call function recursively
            $string .= $key . "_" . arrayToStringForSignature($value);
        } else {
            $string .= $key . "_" . $value;
        } 
    }
    return $string;
}

function generateSsoPreHashString($jsonString, $domain, $consumer_secret) {
    // Parse JSON
    $jsonArray = json_decode($jsonString, TRUE);
    
    // Concatenate String
    // Retrieve required parameters from JSON
    $consumer_key = $jsonArray['consumer_key'];
    $timestamp = $jsonArray['timestamp'];
    $user_id = $jsonArray['user_id'];
    
    // Create String to Hash
    $preHashString = $consumer_key . '_' . $domain . '_' . $timestamp . '_' . $user_id . '_' . $consumer_secret;
    
    // Remove above attributes from JSON before hashing
    unset($jsonArray['consumer_key']);
    unset($jsonArray['timestamp']);
    unset($jsonArray['user_id']);
    
    // Append hashing of all other attributes in JSON using auxiliary function
    $preHashString .= "_" . arrayToStringForSignature($jsonArray);
    
    // Return Concatenated String
    return $preHashString;
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Laboba
session_start();

if (isset($_SESSION['user_id'], $_GET['logout']))
    unset($_SESSION['user_id']);
 
if (isset($_POST['token']))
{
	
    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL            => 'https://api.lanoba.com/authenticate',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => array(
            'token'      => $_POST['token'],
            'api_secret' => 'zRL2Zhq7ztJO8Hm6zL6lXyoLC1y2JFHxBWnjCnc_jzddXCBSZHxy4n4b1wiPJrrQggFiPK8o0PIc8GsGjBDalQ--'
        )
    ));
	
    $response = json_decode(curl_exec($ch), true);

	if (isset($response['user_id'])){
		sfLogin($response);
	}

}

 
?>
<html>
    <head>
        <script type="text/javascript" src="https://s64209627.lanoba.com/social.js"></script>
    </head>
    <body>
        <div id="login_el"></div>
        <script type="text/javascript">
            social.widgets.login({ container: "login_el" });
        </script>
        
    </body>
</html>