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

date_default_timezone_set("Asia/Kuala_Lumpur");
include '../../config/config.php';

$username=$_POST['username'];
$password=$_POST['password'];
$profileid=$_POST['profileid'];
$branch=$_POST['branch'];
$profileid0=$_POST['profileid0'];

$query = "UPDATE user SET username='$username', password='$password', profileid='$profileid', branch='$branch' WHERE id='$profileid0' ";	
$result = $conn->query($query);

if($result === TRUE){

$datenow=date("Y-m-d h:i:s a");
$user=$admin;

$querylog="INSERT INTO log (date,user,control,value,note,subjectid) 
           VALUES ('$datenow','$user','Edit staff','$username','Edit Staff. Value is username','$profileid0')";
$resultlog = $conn->query($querylog);
    
    if($_SESSION['userlevel']=='0'){
	echo "<script type = \"text/javascript\">
				alert(\"Staff Successfully Edit\");
				window.location = (\"stafflist.php\")
			</script>";
    }
    else{
	echo "<script type = \"text/javascript\">
				alert(\"Staff Successfully Edit. Please re-login\");
				document.location.href = 'https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=https://washville.appcili.com';
			</script>";
    }		
			
	}

else {
	echo "<script type = \"text/javascript\">
				alert(\"Not Successful\");
				window.location = (\"stafflist.php\")
			</script>";
}
?>