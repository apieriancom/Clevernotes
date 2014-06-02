<?php 
	ini_set('display_errors',1); 
error_reporting(E_ALL);
	/*if(session_id() == "") { //Session is started in header.php of 
		session_start();
	}	
	
	print('<h2>$_SESSION</h2><pre>');
	print_r($_SESSION);		
	print '</pre>';
	
	$cnt=$_SESSION['cnt']; // Set the contact array from the Session 
	
	print('<h2>$_SESSION</h2><pre>');
	print_r($cnt);		
	print '</pre>';
	
	require_once ('/var/www/sfdc/validatesubscription.php');
	print validateSubscription();
	*/
	require_once ('/var/www/sfdc/utils.php');
	$msg='TEST';
	$msg.=': Error: oa.login.php.';
	emailAdmin($msg); 
	exit;
	
	
?>