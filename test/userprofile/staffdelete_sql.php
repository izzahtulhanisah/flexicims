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
    date_default_timezone_set("Asia/Kuala_Lumpur");
	include '../../config/config.php';
	$id = $_REQUEST['id'];
		$query = "DELETE FROM user WHERE id = '$id'";
	$result = $conn->query($query);

	if($result === TRUE){
	    
    $datenow=date("Y-m-d h:i:s a");
    	
    $querylog="INSERT INTO log (date,user,control,value,note,subjectid) 
               VALUES ('$datenow','$admin','Staff List','Delete','Delete staff','$id')";
    $resultlog = $conn->query($querylog);	    
	    
	echo "<script type = \"text/javascript\">
				alert(\"Staff Successfully Delete\");
				window.location = (\"stafflist.php\")
			</script>";
	}
?>