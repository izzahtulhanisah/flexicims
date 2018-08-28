<?php
session_start();
if(!isset($_SESSION['user_admin'])){
header("location: ../../index.html");
}
$admin=$_SESSION['user_admin'];

setcookie(
  "login",
  $admin,
  time() + (10 * 365 * 24 * 60 * 60)
);
?>

<?php
include '../../config/config.php';
date_default_timezone_set("Asia/Kuala_Lumpur");

$id=$_POST['id'];
$username=$_POST['username'];
$password=$_POST['password'];
$profileid=$_POST['profileid'];
$branch=$_POST['branch'];
$date = date("Y-m-d H:i:s");

$query = "UPDATE user SET id='$id', username='$username', password='$password', profileid='$profileid', branch='1' WHERE  id='$id' ";	
$result = $conn->query($query);

$querylog = "INSERT INTO log(date, user, control, value, note, subjectid) 
			 VALUES ('$date', '$admin', 'Admin List', '$username', 'Edit Admin Profile', '$id');";
$resultlog = $conn->query($querylog);

if($result === TRUE){
	echo "<script type = \"text/javascript\">
				alert(\"Admin Successfully Edit\");
				window.location = (\"admin.php\")
			</script>";
	}

else {
	echo "<script type = \"text/javascript\">
				alert(\"Not Successful\");
				window.location = (\"admin.php\")
			</script>";
}
?>