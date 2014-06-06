<?php
/**
 * Includes Learnosity button at foot of blog post
 * if post has an associated ID
*/
// Learnosity

$cnt=$_SESSION['cnt']; // Set the contact array from the Session
if ($cnt->Id && $cnt->Id != NULL && $cnt->Id != '') {
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
	
		$timestamp = date("Ymd-Hi");
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
	
	$d = date("Ymd-Hi");
	$url = "https://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
	$url = str_replace("/","\/",$url);
	// JSON to be placed in the page
	$json = '{
		"consumer_key": "wSIoIUPa4cA4aJf8",
		"timestamp": "$d",
		"user_id": "'.$cnt->Id.'",
		"module": "student",
		"return_link":{"url":"' . $url . '","label":"Back to clevernotes.ie"},
		"courses": [{"id":"'.get_field('learnosity_id').'"}]
	}';
	
	// Consumer secret (not to be placed in the page sent to the client)
	$consumer_secret = 'c1341201e32a4a32e02e17a84260c5c79aec7fea';
	
	// Domain where script is running 
	$domain = $_SERVER['HTTP_HOST'];
	
	// Call to generate the String concatenation that will be hashed
	$preHashString = generateSsoPreHashString($json, $domain, $consumer_secret);
	
	// $signature is created by hashing $preHashString
	$signature = hash('sha256', $preHashString);
	
                                                                        
	?>
	
	<script src="https://sso.learnosity.com"></script>
	<script>
	var studentSignon = {         
	"consumer_key": "wSIoIUPa4cA4aJf8",
	"timestamp": "<?php echo date("Ymd-Hi"); ?>",
	"user_id": "<?php echo $cnt->Id; ?>",
	"module": "student",
	"courses": [{
	"id": "<?php echo get_field('learnosity_id'); ?>"
	}],
	"return_link":{"url":"<?php echo $url; ?>","label":"Back to clevernotes.ie"},
	"signature": "<?php echo($signature); ?>"
	};
	</script>
	<div style="display: block;width:100%;text-align:center;margin-bottom:23px;">
	<button style="font-size:17px !important;padding: 8px 15px!important;" onclick="LearnositySSO.signon(studentSignon)">Test yourself!</button> 
	</div>
<?php } ?>