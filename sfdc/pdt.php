<?php

error_reporting(E_ALL);
 ini_set("display_errors", 1);

/*
 update: 06/27/2011
  - updated to use cURL for better security, assumes PHP version 5.3
*/

// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-synch';

$amount = $_GET['amt'];
$tx_token = $_GET['tx'];


$pp_hostname = "www.paypal.com"; 
 
// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-synch';
 
$tx_token = $_GET['tx'];
$auth_token = "wDqakfPRzOFuop-cm3NE5iawaefsCURWfUkM2onod3vszG2nsVU4Gs8PbYG";
$req .= "&tx=$tx_token&at=$auth_token";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://$pp_hostname/cgi-bin/webscr");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
//set cacert.pem verisign certificate path in curl using 'CURLOPT_CAINFO' field here,
//if your server does not bundled with default verisign certificates.
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Host: $pp_hostname"));
$res = curl_exec($ch);

curl_close($ch);
 
if(!$res){
    $msg=$e;
    $msg.=': Error: pdt.php. ';
    emailAdmin($msg); 
}else{
     // parse the data
    $lines = explode("\n", $res);
    $keyarray = array();
    if (strcmp ($lines[0], "SUCCESS") == 0) {
        for ($i=1; $i<count($lines)-1;$i++){
        list($key,$val) = explode("=", $lines[$i]);
        $keyarray[urldecode($key)] = urldecode($val);
    }
    //print '<pre>'; print_r($lines); print('</pre>'); 
    // check the payment_status is Completed
    // check that txn_id has not been previously processed
    // check that receiver_email is your Primary PayPal email
    // check that payment_amount/payment_currency are correct
    // process payment
    $firstname = $keyarray['first_name'];
    $lastname = $keyarray['last_name'];
    $itemname = $keyarray['item_name'];
    $amount = $keyarray['mc_gross'];
    $contactId = $keyarray['custom'];
	$item_number = $keyarray['item_number'];
	$_SESSION['keyarray']=$keyarray;
    if(strpos($contactId,'_'))$contactId = strstr($contactId,'_',true);
    if($contactId!=''){
        require_once ('login.php');
        $user = $username;
        $token = $token;    
        $pass = $password;
        $auth = $pass.$token;
        require_once ('phptoolkit/SforcePartnerClient.php');
        require_once ('phptoolkit/SforceHeaderOptions.php'); 
        try {
         $mySforceConnection = new SforcePartnerClient();
         $mySforceConnection->createConnection("phptoolkit/partner.wsdl.xml");
         } catch (Exception $e) {
            //Salesforce could be down, or you have an error in configuration
          //Check your WSDL path
          //Otherwise, handle this exception
         }
         
         //Pass login details to Salesforce
         try {
            $mySforceConnection->login($user, $auth);
            $describe = $mySforceConnection->describeSObjects(array('Opportunity'));   
            $contactName = '';
            $accId = '' ;
            $query = "SELECT Id, FirstName,Name, AccountId from Contact WHERE Id = '$contactId'";
            $response = $mySforceConnection->query($query);
            foreach ($response->records as $record){
                $accId =  $record->fields->AccountId;
                $contactName = $record->fields->Name;
            }  
            $date = date("Y-m-d");
            $oppName = $itemname .' - '.$contactName ; 
            $amount = $amount;
            $fields = array (
                  'Name' => $oppName,
                  'AccountId' => $accId,
                  'CloseDate' =>$date,
                  'StageName' =>  'Closed Won',
                  'Amount' => $amount
                );
                
            $sObjectOpp = new SObject();
            $sObjectOpp->fields = $fields;
            $sObjectOpp->type = 'Opportunity';
            $createResponse = $mySforceConnection->create(array($sObjectOpp));
            $oppId = $createResponse[0]->id; 
            //echo  'contactId= ' .$contactId .' and '.' oppId= ' .$oppId . ' and accId= '.$accId;

            $fieldsOpportunityContactRole = array (
                        'ContactId' => $contactId,
                        'OpportunityId' => $oppId,
                        'Role' => 'Technical Buyer',
                        'IsPrimary'=> 'True'
                        );                    

            $sObjectOpportunityContactRole = new SObject();
            $sObjectOpportunityContactRole->fields = $fieldsOpportunityContactRole;
            $sObjectOpportunityContactRole->type = 'OpportunityContactRole';  
            $createResponseOpportunityContactRole = $mySforceConnection->create(array($sObjectOpportunityContactRole));
            //print_r($createResponseOpportunityContactRole);



            } catch (Exception $e) {
                //print $e;
                $msg=$e;
                $msg.=': Error: pdt.php. ';
                emailAdmin($msg);                                                        
            }
           
        }
 
    }
    else if (strcmp ($lines[0], "FAIL") == 0) {
        //print $e;
		$msg=$e;
        $msg.=': Error: pdt.php. ';
        emailAdmin($msg); 
    }
}
	//$url='paypal/success.php?utm_nooverride=1&tx_token='.$tx_token;
	$url='/success?utm_nooverride=1&tx_token='.$tx_token;
	$url.='&mc_gross_1='.$keyarray['mc_gross'];
	$url.='&item_number1='.$keyarray['item_number'];
	$url.='&item_name1='.$keyarray['item_name'];
    
	header("LOCATION: ".$url);


?>