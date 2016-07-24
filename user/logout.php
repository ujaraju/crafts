<?php
session_start();
?>
<?php
// remove all session variables
session_unset(); 
// destroy the session 
session_destroy(); 
//redirect to index.php page
header("location: account.php");
?>


