<?php
/**
 *  PHP-PayPal-IPN Example
 *
 *  This shows a basic example of how to use the IpnListener() PHP class to 
 *  implement a PayPal Instant Payment Notification (IPN) listener script.
 *
 *  For a more in depth tutorial, see my blog post:
 *  http://www.micahcarrick.com/paypal-ipn-with-php.html
 *
 *  This code is available at github:
 *  https://github.com/Quixotix/PHP-PayPal-IPN
 *
 *  @package    PHP-PayPal-IPN
 *  @author     Micah Carrick
 *  @copyright  (c) 2011 - Micah Carrick
 *  @license    http://opensource.org/licenses/gpl-3.0.html
 */
 
require_once ('/var/www/sfdc/utils.php');

/*
Since this script is executed on the back end between the PayPal server and this
script, you will want to log errors to a file or email. Do not try to use echo
or print--it will not work! 

Here I am turning on PHP error logging to a file called "ipn_errors.log". Make
sure your web server has permissions to write to that file. In a production 
environment it is better to have that log file outside of the web root.
*/
ini_set('log_errors', true);
ini_set('error_log', dirname(__FILE__).'ipn_errors.log');


// instantiate the IpnListener class
include('ipnlistener.php');
$listener = new IpnListener();


/*
When you are testing your IPN script you should be using a PayPal "Sandbox"
account: https://developer.paypal.com
When you are ready to go live change use_sandbox to false.
*/
$listener->use_sandbox = false;

/*
By default the IpnListener object is going  going to post the data back to PayPal
using cURL over a secure SSL connection. This is the recommended way to post
the data back, however, some people may have connections problems using this
method. 

To post over standard HTTP connection, use:
$listener->use_ssl = false;

To post using the fsockopen() function rather than cURL, use:
$listener->use_curl = false;
*/

/*
The processIpn() method will encode the POST variables sent by PayPal and then
POST them back to the PayPal server. An exception will be thrown if there is 
a fatal error (cannot connect, your server is not configured properly, etc.).
Use a try/catch block to catch these fatal errors and log to the ipn_errors.log
file we setup at the top of this file.

The processIpn() method will send the raw data on 'php://input' to PayPal. You
can optionally pass the data to processIpn() yourself:
$verified = $listener->processIpn($my_post_data);
*/
try {
    $listener->requirePostMethod();
    $verified = $listener->processIpn();
} catch (Exception $e) {
	
    $msg=$e;
    $msg.= $listener->processIpn($my_post_data);
	$msg.=': Error: success.php';
	emailAdmin($msg); 
    exit(0);
}


/*
The processIpn() method returned true if the IPN was "VERIFIED" and false if it
was "INVALID".
*/
if ($verified) {
    /*
    Once you have a verified IPN you need to do a few more checks on the POST
    fields--typically against data you stored in your database during when the
    end user made a purchase (such as in the "success" page on a web payments
    standard button). The fields PayPal recommends checking are:
    
        1. Check the $_POST['payment_status'] is "Completed"
	    2. Check that $_POST['txn_id'] has not been previously processed 
	    3. Check that $_POST['receiver_email'] is your Primary PayPal email 
	    4. Check that $_POST['payment_amount'] and $_POST['payment_currency'] 
	       are correct
    
    Since implementations on this varies, I will leave these checks out of this
    example and just send an email using the getTextReport() method to get all
    of the details about the IPN.  
    */
	try{
		require_once ('login.php');
		if($sfdcSandbox){ 
			//Sandbox WSDL
			$wsdl="phptoolkit/cPaymentHandler.sandbox.xml";		
		}else{
			//Production WSDL
			$wsdl="phptoolkit/cPaymentHandler.xml";
		}
		
		$NAMESPACE = "http://soap.sforce.com/schemas/class/cPaymentHandler";
		
		$sforce_header = new SoapHeader($NAMESPACE, "SessionHeader", array("sessionId" => $sessionID));
		$client = new soapclient($wsdl);
		$client->__setSoapHeaders(array($sforce_header));
		
		
		$payment_type = (isset($_POST['payment_type']) ?  $_POST['payment_type'] : null);
		$payment_date = (isset($_POST['payment_date']) ?  $_POST['payment_date'] : null);
		$payment_status = (isset($_POST['payment_status']) ?  $_POST['payment_status'] : null);
		$address_status = (isset($_POST['address_status']) ?  $_POST['address_status'] : null);
		$payer_status = (isset($_POST['payer_status']) ?  $_POST['payer_status'] : null);
		$first_name = (isset($_POST['first_name']) ?  $_POST['first_name'] : null);		
		$last_name = (isset($_POST['last_name']) ?  $_POST['last_name'] : null);
		$payer_email = (isset($_POST['payer_email']) ?  $_POST['payer_email'] : null);
		$payer_id = (isset($_POST['payer_id']) ?  $_POST['payer_id'] : null);
		$address_name = (isset($_POST['address_name']) ?  $_POST['address_name'] : null);
		$address_country = (isset($_POST['address_country']) ?  $_POST['address_country'] : null);
		$address_country_code = (isset($_POST['address_country_code']) ?  $_POST['address_country_code'] : null);
		$address_zip = (isset($_POST['address_zip']) ?  $_POST['address_zip'] : null);
		$address_state = (isset($_POST['address_state']) ?  $_POST['address_state'] : null);
		$address_city = (isset($_POST['address_city']) ?  $_POST['address_city'] : null);
		$address_street = (isset($_POST['address_street']) ?  $_POST['address_street'] : null);
		$receiver_email = (isset($_POST['receiver_email']) ?  $_POST['receiver_email'] : null);
		$receiver_id = (isset($_POST['receiver_id']) ?  $_POST['receiver_id'] : null);
		$item_name1 = (isset($_POST['item_name1']) ?  $_POST['item_name1'] : null);
		$item_number1 = (isset($_POST['item_number1']) ?  $_POST['item_number1'] : null);
		$custom = (isset($_POST['custom']) ?  $_POST['custom'] : null);
		
		$paymentDetails[] = array(
								  'listenerText'=>$listener->getTextReport(),
								  'payment_type'=>$payment_type,
								  'payment_date'=>$payment_date,
								  'payment_status'=>$payment_status,
								  'address_status'=>$address_status,
								  'first_name'=>$first_name,
								  'last_name'=>$last_name,
								  'payer_email'=>$payer_email,
								  'payer_id'=>$payer_id,
								  'address_name'=>$address_name,
								  'address_country'=>$address_country,
								  'address_country_code'=>$address_country_code,
								  'address_zip'=>$address_zip,
								  'address_state'=>$address_state,
								  'address_city'=>$address_city,
								  'address_street'=>$address_street,
								  'receiver_email'=>$receiver_email,
								  'receiver_id'=>$receiver_id,
								  'item_name1'=>$item_name1,
								  'item_number1'=>$item_number1,
								  'custom'=>$custom
								  );
		$result = $client->recordPayment($paymentDetails);
		
	}
	catch(Exception $e) {	
		$msg=$e;
		$msg.=$listener->getTextReport();
		$msg.=': Error: success.php';
		emailAdmin($msg); 		
	}
	
	
   
} else {
    /*
    An Invalid IPN *may* be caused by a fraudulent transaction attempt. It's
    a good idea to have a developer or sys admin manually investigate any 
    invalid IPN.
    */
	$msg='Invalid IPN  from PayPal';
	$msg.=$listener->getTextReport();
	$msg.=': Error: success.php';
	emailAdmin($msg); 
    //mail('mark.richmond@ccltng.com', 'Invalid IPN', $listener->getTextReport());
}

?>