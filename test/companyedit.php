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

	$name = $_POST['name'];
	$address = $_POST['address'];
	$email = $_POST['email'];
	$contact = $_POST['contact'];
	$position = $_POST['position'];
	$loginid = $_POST['loginid'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$question1 = $_POST['question1'];
	$question2 = $_POST['question2'];


	$query = "UPDATE profile SET name = '$name', address='$address', email='$email', contact='$contact', position='$position' WHERE loginid='$loginid'";
	$res = $conn->query($query);

	$query = "UPDATE login SET username = '$username', password='$password', question1='$question1', question2='$question2' WHERE id='$loginid'";
	$res = $conn->query($query);

	if($res === TRUE){
		echo "<script type = \"text/javascript\">
			alert(\"Profile Succesfully Edit\");
			window.location = (\"profile.php\")
			</script>";
		}

	else {
		echo "<script type = \"text/javascript\">
			alert(\"Profile Not Succesfully Edit\");
			window.location = (\"profile.php\")
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
			<h3 class="page-header"><center>COMPANY PROFILE</center></h3>
		</div>
		<!-- /.col-lg-12 -->
	</div>
            <!-- /.row -->
	<div class="row">
		<?php

		$select = "SELECT * FROM company ";
		$result = $conn->query($select);
		while($row = $result->fetch_assoc()){
			$id = $row["id"];
			$comname = $row["comname"];
			$comaddress = $row["comaddress"];
			$comemail = $row["comemail"];
			$comcontact = $row["comcontact"];
			$comwebsite = $row["comwebsite"];
		}
		?>
		<form action="" method="post">
			<label>Company Name</label>
			<input class="form-control" name="name" type="text" value="<?php echo $comname; ?>"></input>
			<br>
			<label>Company Address</label>
			<input class="form-control" name="address" type="text" value="<?php echo $comaddress; ?>"></input>
			<br>
			<label>Email</label>
			<input class="form-control" name="email" type="text" value="<?php echo $comemail; ?>"></input>
			<br>
			<label>Company Contact</label>
			<input class="form-control" name="contact" type="text" value="<?php echo $comcontact; ?>"></input>
			<br>
			<label>Company Website</label>
			<input class="form-control" name="contact" type="text" value="<?php echo $comcontact; ?>"></input>
			<br>
			<input type="submit" class="btn btn-success" name="send" value="Submit" />
			<button class="btn btn-bg-grey" type="button" onclick="window.location.href='companyprofile.php'">Back</button>
			<br><br>
		</form>
	</div>
</div>


<?php

include "include/end.php";

?>

</body>

</html>