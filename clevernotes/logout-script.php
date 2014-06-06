<?php
/**
 *Template Name: Logout
*/
?>
<?php
//$ref = getenv('HTTP_REFERER');
// Initialize the session.
session_start();
// Unset all of the session variables.
$_SESSION = array();
// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data
if (isset($_COOKIE[session_name()])) {setcookie(session_name(), '', time()-42000, '/');}
// Finally, destroy the session.
session_destroy();
//kill cookies
setcookie('password', '', time()-42000, '/');
setcookie('username', '', time()-42000, '/'); 
//header("Location: $ref");
header("Location: /");
?>