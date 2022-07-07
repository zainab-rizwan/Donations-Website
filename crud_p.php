<?php
session_start();
include 'db_connection.php';

//Create new particular
if (isset($_POST['create'])) {
	$title = $_POST['title'];
	$result = mysqli_query($conn, "SELECT MAX(particular_id) as 'max' FROM particulars");
	$row = mysqli_fetch_array($result);
	$last_id= 0;
	$sql1 = "INSERT INTO `particulars` (`particular_id`, `particular_name`) VALUES ( '$last_id', '$title')";
	if ($conn->query($sql1) === TRUE) {
	    $_SESSION['message'] = "Particular created!"; 
	    $_SESSION['msg_type'] = "Success!"; 
	    header('location: particulars.php');
	    $last_id = $conn->insert_id; 
	    exit();
	} else {
	    $_SESSION['message'] = $sql1 . "<br>" . $conn->error;
	    $_SESSION['msg_type'] = "Error";
	    header('location: particulars.php');
	    exit();
	} 
}

//Edit particular
if(isset($_POST['update']))
{
	$name=$_POST['name'];
	$id=$_POST['id'];
	$sql = "UPDATE `particulars` SET particular_name='$name' WHERE particular_id=$id";
	if ($conn->query($sql) === TRUE) {
	    $_SESSION['message'] = "Particular updated!"; 
	    $_SESSION['msg_type'] = "Success!";
	    header('location: particulars.php');
	     exit();
	} else {
	    $_SESSION['message'] = $sql . "<br>" . $conn->error;
	    $_SESSION['msg_type'] = "Error";
	   	header('location: particulars.php');
	    exit();
	} 
}

//Delete particular
if (isset($_GET['del'])) {
$id = $_GET['del'];
$sql = "DELETE FROM `particulars` WHERE `particular_id`='$id'";
if ($conn->query($sql) === TRUE) {
	    $_SESSION['message'] = "Particular deleted!"; 
	    $_SESSION['msg_type'] = "Success!"; 
	    header('location: particulars.php');
	    exit();
} 
else {
	    $_SESSION['message'] = $sql1 . "<br>" . $conn->error;
	    $_SESSION['msg_type'] = "Error";
	    header('location: particulars.php');
	    exit();
	} 
} 
?>