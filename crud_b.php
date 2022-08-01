<?php
include('auth.php');
require_once('db_connection.php');

//Create new batch fund
if (isset($_POST['create'])) {
	$title = stripslashes($_REQUEST['title']);
    $title = mysqli_real_escape_string($conn,$title);

	$last_id= 0;
	$sql1="INSERT INTO batch_fund (batch_id, batch_name) VALUES ( ?, ?)";
	$stmt = $conn->prepare($sql1); 
	$stmt->bind_param("ss", $id, $title);
	$stmt->execute();
	$result1 = $stmt->get_result();

	if ($conn->query($result1) === TRUE) {
		$last_id = $conn->insert_id;
		$_SESSION['message'] = 'Batch Fund created!';
	    $_SESSION['msg_type'] = "Success!";   
	    header('location: batch_fund.php');
	    exit();

	} else {
	    $_SESSION['message'] = $result1 . "<br>" . $conn->error;
	    $_SESSION['msg_type'] = "Error";
	    header('location: batch_fund.php');
	    exit();
	} 
}

//Edit batch fund
if(isset($_POST['update']))
{
	$name = stripslashes($_REQUEST['name']);
    $name = mysqli_real_escape_string($conn,$name);
	$id=$_POST['id'];

	$sql2 = "UPDATE batch_fund SET batch_name=? WHERE batch_id=?";
	$stmt = $conn->prepare($sql2); 
	$stmt->bind_param("ss", $name, $id);
	$stmt->execute();
	$result2 = $stmt->get_result();

	if ($conn->query($result2) === TRUE) {
	    $_SESSION['message'] = "Batch fund updated!"; 
	    $_SESSION['msg_type'] = "Success!";
	    header('location: batch_fund.php');
	    exit();

	} else {
	    $_SESSION['message'] = $result2 . "<br>" . $conn->error;
	    $_SESSION['msg_type'] = "Error";
	   	header('location: batch_fund.php');
	    exit();
	} 
}

//Delete batch fund
if (isset($_GET['del'])) {

$id = $_GET['del'];
$sql3 = "DELETE FROM batch_fund WHERE batch_id=?";
$stmt = $conn->prepare($sql3); 
$stmt->bind_param("i", $id);
$stmt->execute();
$result3 = $stmt->get_result();

if ($result3) {
	    $_SESSION['message'] = "Batch fund deleted!"; 
	    $_SESSION['msg_type'] = "Success!"; 
	    header('location: batch_fund.php');
	    exit();
} 
else {
	    $_SESSION['message'] = $result3 . "<br>" . $conn->error;
	    $_SESSION['msg_type'] = "Error";
	    header('location: batch_fund.php');
	    exit();
	} 
} 
?>