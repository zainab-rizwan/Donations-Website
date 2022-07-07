<?php
session_start();
if(session_destroy())
{
	$_SESSION['message'] = "You've been logged out."; 
	header("Location: login.php");
}
?>