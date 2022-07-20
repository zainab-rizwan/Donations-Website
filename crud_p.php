<?php
session_start();
include 'db_connection.php';

//Create new particular
if (isset($_POST['create'])) {
	$title = stripslashes($_REQUEST['title']);
    $title = mysqli_real_escape_string($conn,$title);
	$last_id= 0;
	$sql1="INSERT INTO particulars (particular_id, particular_name) VALUES ( ?, ?)";
	$stmt = $conn->prepare($sql1); 
	$stmt->bind_param("ss", $id, $title);
	$stmt->execute();
	$result1 = $stmt->get_result();

	if ($conn->query($result1) === TRUE) {
	    $_SESSION['message'] = "Particular created!"; 
	    $_SESSION['msg_type'] = "Success!"; 
	    header('location: particulars.php');
	    $last_id = $conn->insert_id; 
	    exit();
	} else {
	    $_SESSION['message'] = $result1 . "<br>" . $conn->error;
	    $_SESSION['msg_type'] = "Error";
	    header('location: particulars.php');
	    exit();
	} 
}

//Edit particular
if(isset($_POST['update']))
{
	$name = stripslashes($_POST['name']);
    $name = mysqli_real_escape_string($conn,$name);
	$id=$_POST['id'];

	$sql2 = "UPDATE particulars SET particular_name=? WHERE particular_id=?";
	$stmt = $conn->prepare($sql2); 
	$stmt->bind_param("ss", $name, $id);
	$stmt->execute();
	$result2 = $stmt->get_result();

	if ($conn->query($result2) === TRUE) {
	    $_SESSION['message'] = "Particular updated!"; 
	    $_SESSION['msg_type'] = "Success!";
	    header('location: particulars.php');
	     exit();
	} else {
	    $_SESSION['message'] = $result2 . "<br>" . $conn->error;
	    $_SESSION['msg_type'] = "Error";
	   	header('location: particulars.php');
	    exit();
	} 
}

//Delete particular
if (isset($_GET['del'])) {
$id = $_GET['del'];
$sql3 = "DELETE FROM particulars WHERE particular_id=?";
$stmt = $conn->prepare($sql3); 
$stmt->bind_param("i", $id);
$stmt->execute();
$result3 = $stmt->get_result();

if ($conn->query($result3) === TRUE) {
	    $_SESSION['message'] = "Particular deleted!"; 
	    $_SESSION['msg_type'] = "Success!"; 
	    header('location: particulars.php');
	    exit();
} 
else {
	    $_SESSION['message'] = $result3 . "<br>" . $conn->error;
	    $_SESSION['msg_type'] = "Error";
	    header('location: particulars.php');
	    exit();
	} 
} 
?>