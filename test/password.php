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
	$userid = $row["id"];
	$username = $row["username"];
	$secpass = $row["secpass"];
}

if(isset($_POST['send'])){

	$password1 = $_POST['password1'];
	$password2 = $_POST['password2'];
	$username = $_POST['username'];

	if($password1 === $password2){

		$query = "UPDATE login SET password='$password1' WHERE  username='$username'  ";

		$res = $conn->query($query);

		if($res === TRUE){
			echo "<script type = \"text/javascript\">
				alert(\"Succesfully Changed Password\");
				window.location = (\"profile.php\")
				</script>";
			}

		else {
			echo "<script type = \"text/javascript\">
				alert(\"Failed to Change Password\");
				window.location = (\"password.php\")
				</script>";
			}
	}
	else{
		echo "<script type = \"text/javascript\">
				alert(\"Password Not Matched. Please Try Again.\");
				window.location = (\"password.php\")
				</script>";
	}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<?php

include "include/head.php";

?>

</head>

<body class="theme-red">
<?php

include "include/menu.php";

?>

<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h3 class="page-header">CHANGE PASSWORD</h3>
		</div>
		<!-- /.col-lg-12 -->
	</div>
            <!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<form method="post" action="">
				<div class="panel panel-danger" style="width: 500px">
    			<div class="panel-heading">Change Your Password</div>
    				<div class="panel-body">
							<label><b>New Password<b></label>
							<input class="form-control" type="password" name="password1">
							<br>
							<label><b>Confirm Password<b></label>
							<input class="form-control" type="password" name="password2">
							<input class="form-control" type="hidden" name="username" value="<?php echo $username; ?>">
							<br>
							<button class="btn btn-bg-grey" type="button" onclick="window.location.href='profile.php'">Back</button>
							<input class="btn btn-success pull-right" type="submit" name="send" value="Submit"><br>
						</div>
				</div>
			</form>
		</div>
	</div>
</div>


<?php

include "include/end.php";

?>

</body>

</html>
