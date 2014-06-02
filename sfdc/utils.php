<?php
function emailAdmin($msg){
	/*$to = 'mark.richmond@ccltng.com';
	$subject =  $_SERVER['HTTP_HOST'].' Site Error';
	mail($to, $subject, $msg);*/
//	include_once ('/var/www/sfdc/phpmailer/class.phpmailer.php');
	include_once ('/nas/wp/www/cluster-1716/clevernotes/sfdc/phpmailer/class.phpmailer.php');

	$mail = new PHPMailer();
	$mail->IsSMTP();
	// enable SMTP authentication
	$mail->SMTPAuth = true;
	// sets the prefix to the server
	$mail->SMTPSecure = 'tls';
	// sets Gthe SMTP server
	$mail->Host = 'email-smtp.us-east-1.amazonaws.com';
	// set the SMTP port
	$mail->Port = '587';
	// username
	$mail->Username = 'AKIAICNV6CCL6BGEXMFQ';
	// password
	$mail->Password = 'Ajj2MTbtashuOH610b81cnFQwiDhfCUk0MfsQjCkrapI';
	
	$mail->From = 'amazon_alerts@clevernotes.ie';
	$mail->FromName = 'Clevernotes Website';
	$mail->AddReplyTo('admin@apierian.com', 'name to reply');
	$mail->Subject = $_SERVER['HTTP_HOST'].' Site Error';
	
	$mail->Body = $msg;
	$mail->IsHTML(false);
	
	
	$mail->AddAddress('websiteerror@clevernotes.zendesk.com', 'Clevernotes Website Error');
	
	if(!$mail->Send()){
		echo $mail->ErrorInfo;
	}else{
		$mail->ClearAddresses();
		$mail->ClearAttachments();
	}
}
?>