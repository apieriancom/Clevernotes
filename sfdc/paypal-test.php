<?php


ini_set('display_errors',1); 
error_reporting(E_ALL);


if(session_id() == "") { //Session is started in header.php of 
	session_start();
}
$cnt=$_SESSION['cnt']; // Set the contact array from the Session 


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Paypal Test Page</title>
</head>

<body>

<!--
<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="GT7PP8EDBLYFE">
<input type="hidden" name="custom" value="<?php echo $cnt->Id ?>">
<input type="hidden" name="notify_url" value="https://www.clevernotes.org/sfdc/success.php" />
<input type="image" src="https://www.sandbox.paypal.com/en_GB/i/btn/btn_buynow_LG.gif" border="0" name="submit" alt="PayPal — The safer, easier way to pay online.">
<img alt="" border="0" src="https://www.sandbox.paypal.com/en_GB/i/scr/pixel.gif" width="1" height="1">
</form>-->

<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="LD4EF7HPWGA6E">
<input type="hidden" name="custom" value="<?php echo $cnt->Id ?>">
<input type="image" src="https://www.sandbox.paypal.com/en_US/GB/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal — The safer, easier way to pay online.">
<img alt="" border="0" src="https://www.sandbox.paypal.com/en_GB/i/scr/pixel.gif" width="1" height="1">
</form>


</body>
</html>