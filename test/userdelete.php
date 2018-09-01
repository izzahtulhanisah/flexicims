<?php
session_start();
if(!isset($_SESSION['username'])){
header("Location:login.php?location=" . $_SERVER['REQUEST_URI']);
}

include 'config.php';
$username=$_SESSION['username'];


$select = "SELECT * FROM login WHERE username = '$username' ";
$result = $conn->query($select);
while($row = $result->fetch_assoc()){
	$id = $row["id"];
	$username = $row["username"];
	$secpass = $row["secpass"];
}

$id = $_REQUEST['id'];
$query = "DELETE FROM login WHERE id = '$id'";
$result = $conn->query($query);

$query1 = "DELETE FROM profile WHERE loginid = '$id'";
$result1 = $conn->query($query1);

if($result === TRUE){
	echo "<script type = \"text/javascript\">
				alert(\"Successfully Deleted User\");
				window.location = (\"userprofile.php\")
			</script>";
}

?>
