<?php 
session_start();
unset ($_SESSION['email_user']);
unset ($_SESSION['username']);
unset ($_SESSION['uid']);
unset ($_SESSION['gender']);
header("Location: index.php");
exit();
?>