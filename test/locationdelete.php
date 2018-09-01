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

include 'config.php';

if(isset($_POST['delloc'])){
	$id = $_REQUEST['id'];
	$query = "DELETE FROM location WHERE id = '$id'";
	$result = $conn->query($query);
	if($result === TRUE){
		echo "<script type = \"text/javascript\">
					alert(\"Location Successfully Delete\");
					window.location = (\"location.php\")
				</script>";
	}
}

if(isset($_POST['delsubloc'])){
	$id = $_REQUEST['id'];
	$query = "DELETE FROM sublocation WHERE id = '$id'";
	$result = $conn->query($query);
	if($result === TRUE){
		echo "<script type = \"text/javascript\">
					alert(\"Location Successfully Delete\");
					window.location = (\"location.php\")
				</script>";
	}
}

?>
