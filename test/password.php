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
				alert(\"Password Succesfully Edited\");
				window.location = (\"password.php\")
				</script>";
			}

		else {
			echo "<script type = \"text/javascript\">
				alert(\"Password Not Succesfully Edited\");
				window.location = (\"password.php\")
				</script>";
			}
	}
	else{
		echo "<script type = \"text/javascript\">
				alert(\"Your input the wrong password\");
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
			<h3 class="page-header"><center>CHANGE PASSWORD</center></h3>
		</div>
		<!-- /.col-lg-12 -->
	</div>
            <!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<form method="post" action="">
				<center><div class="panel panel-danger" style="width: 500px">
    			<div class="panel-heading">Change Password</div>
    				<div class="panel-body">
							<label><b>New Password<b></label>
							<input class="form-control" type="password" name="password1">
							<br>
							<label><b>Confirm Password<b></label>
							<input class="form-control" type="password" name="password2">
							<input class="form-control" type="hidden" name="username" value="<?php echo $username; ?>">
						</div>
				</div></center>
				<center><input class="btn btn-success" type="submit" name="send" value="Submit"><br></center>

			</form>
		</div>
	</div>
</div>


<?php

include "include/end.php";

?>

</body>

</html>
