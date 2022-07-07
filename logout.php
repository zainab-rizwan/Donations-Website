<?php
session_start();
if(session_destroy())
//Redirect to login
{
	$_SESSION['message'] = "You've been logged out."; 
	header("Location: login.php");
}
?>