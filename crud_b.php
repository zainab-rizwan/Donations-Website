<?php
session_start();
include 'db_connection.php';

//Create new batch fund
if (isset($_POST['create'])) {
	$title = $_POST['title'];
	$result = mysqli_query($conn, "SELECT MAX(batch_id) as 'max' FROM batch_fund");
	$row = mysqli_fetch_array($result);
	$last_id= 0;


	$sql1 = "INSERT INTO `batch_fund` (`batch_id`, `batch_name`) VALUES ( '$last_id', '$title')";

	if ($conn->query($sql1) === TRUE) {
	    $_SESSION['message'] = "Batch fund created!"; 
	    $_SESSION['msg_type'] = "Success!"; 
	    $last_id = $conn->insert_id;  
	    header('location: batch_fund.php');
	    exit();

	} else {
	    $_SESSION['message'] = $sql1 . "<br>" . $conn->error;
	    $_SESSION['msg_type'] = "Error";
	    header('location: batch_fund.php');
	    exit();
	} 
}

//Edit batch fund
if(isset($_POST['update']))
{
	$name=$_POST['name'];
	$id=$_POST['id'];
	$sql = "UPDATE `batch_fund` SET batch_name='$name' WHERE batch_id=$id";

	if ($conn->query($sql) === TRUE) {
	    $_SESSION['message'] = "Batch fund updated!"; 
	    $_SESSION['msg_type'] = "Success!";
	    header('location: batch_fund.php');
	     exit();

	} else {
	    $_SESSION['message'] = $sql . "<br>" . $conn->error;
	    $_SESSION['msg_type'] = "Error";
	   	header('location: batch_fund.php');
	    exit();
	} 
}

//Delete batch fund
if (isset($_GET['del'])) {

$id = $_GET['del'];
$sql = "DELETE FROM `batch_fund` WHERE `batch_id`='$id'";
if ($conn->query($sql) === TRUE) {
	    $_SESSION['message'] = "Batch fund deleted!"; 
	    $_SESSION['msg_type'] = "Success!"; 
	    header('location: batch_fund.php');
	    exit();
} 
else {
	    $_SESSION['message'] = $sql1 . "<br>" . $conn->error;
	    $_SESSION['msg_type'] = "Error";
	    header('location: batch_fund.php');
	    exit();
	} 
} 
?>