<?php


ini_set('display_errors',1); 
error_reporting(E_ALL);
date_default_timezone_set('Europe/Dublin');

if($_SERVER["HTTPS"] != "on") {
	header("Location: https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
}
if(session_id() == "") { //Session is started in header.php of 
	session_start();
}
$cnt=$_SESSION['cnt']; // Set the contact array from the Session 
//$catid=$_GET['catid']; // Set the Wordpress Cat ID; 11=Biology
$catid=11;
$learnosityId = getLearnosityId($catid);

function getLearnosityId($catid){
	$subjects = $_SESSION['subjects'];	
	
	foreach($subjects as $key_val => $subject) {
		if($subject->WordPress_ID__c==$catid){
			$CleverTest__r = (isset($subject->CleverTest__r->records) ? $subject->CleverTest__r->records : null);
			if($CleverTest__r!=null){
				// TODO: Add validation to check to see if the user has a subscription to access test.
				// And check to see if the test is a demo test.
				return $CleverTest__r->Learnosity_ID__c;
			}
		}
	}
	return null;
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Learnosity

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
    //$timestamp = $jsonArray['timestamp'];
	
	$timestamp = date("Ymd-Gi");
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

$d = date("Ymd-Gi");
// JSON to be placed in the page
$json = '{
    "consumer_key": "wSIoIUPa4cA4aJf8",
    "timestamp": "$d",
    "user_id": "'.$cnt->Id.'",
    "module": "student",
    "courses": [{"id":"'.$learnosityId.'"}]
}';

// Consumer secret (not to be placed in the page sent to the client)
$consumer_secret = 'c1341201e32a4a32e02e17a84260c5c79aec7fea';

// Domain where script is running 
$domain = $_SERVER['HTTP_HOST'];

// Call to generate the String concatenation that will be hashed
$preHashString = generateSsoPreHashString($json, $domain, $consumer_secret);

// $signature is created by hashing $preHashString
$signature = hash('sha256', $preHashString);





/*

////////////// OLD WORKING HTML ///////////////////////

<script src="https://sso.learnosity.com"></script>
<script>

var studentSignon = {	
	"consumer_key": "wSIoIUPa4cA4aJf8",
    "timestamp": "<?php echo date("Ymd-Gi"); ?>",
    "user_id": "<?php echo $cnt->Id; ?>",
    "module": "student",
    "courses": [{
        "id": "<?php echo $learnosityId; ?>"
    }],
    "signature": "<?php echo($signature); ?>",
	
}; 

		</script>
<button onclick="LearnositySSO.signon(studentSignon)">Start Test</button> 


*/
?>
<script src="https://sso.learnosity.com"></script>

<button onclick="LearnositySSO.signon({
			'consumer_key':'wSIoIUPa4cA4aJf8',
            'timestamp':'<?php echo date('Ymd-Hi'); ?>',
            'user_id':'<?php echo $cnt->Id; ?>',
            'module':'student',
            'courses':[{'id':'<?php echo $learnosityId; ?>'}],
            'signature':'<?php echo($signature); ?>'
            })">Start Test</button> 
