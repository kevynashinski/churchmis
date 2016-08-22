<?php
session_start();
function loggedIn(){
    include_once 'config.php';

    if (isset($_SESSION[USERNAME]) && !empty($_SESSION[USERNAME])){
		return true;
	} else {
		return false;
	}
}
if(!loggedIn()) {
	header('Location: login.php');
}
