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

	$id = $_POST["id"];
	$comname = $_POST["comname"];
	$comaddress = $_POST["comaddress"];
	$comemail = $_POST["comemail"];
	$comcontact = $_POST["comcontact"];
	$comwebsite = $_POST["comwebsite"];


	$query = "UPDATE company SET comname = '$comname', comaddress='$comaddress', comemail='$comemail', comcontact='$comcontact', comwebsite='$comwebsite' WHERE id='$id'";
	$res = $conn->query($query);

	if($res === TRUE){
		echo "<script type = \"text/javascript\">
			alert(\"Succesfully Edited Company Details\");
			window.location = (\"companyprofile.php\")
			</script>";
		}

	else {
		echo "<script type = \"text/javascript\">
			alert(\"Failed to Edit Company Details\");
			window.location = (\"companyprofile.php\")
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
			<h3>COMPANY PROFILE</h3><hr>
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

		<div class="container">

		  <div class="panel panel-warning" style="width: 500px">
		    <div class="panel-heading">Edit Company Details</div>
		    <div class="panel-body">

					<form action="" method="post">
						<label>Company Name</label>
						<input class="form-control" name="comname" type="text" value="<?php echo $comname; ?>"></input>
						<br>
						<label>Company Address</label>
						<input class="form-control" name="comaddress" type="text" value="<?php echo $comaddress; ?>"></input>
						<br>
						<label>Email</label>
						<input class="form-control" name="comemail" type="text" value="<?php echo $comemail; ?>"></input>
						<br>
						<label>Company Contact</label>
						<input class="form-control" name="comcontact" type="text" value="<?php echo $comcontact; ?>"></input>
						<br>
						<label>Company Website</label>
						<input class="form-control" name="comwebsite" type="text" value="<?php echo $comwebsite; ?>"></input>
						<input class="form-control" name="id" type="hidden" value="<?php echo $id; ?>"></input>
						<br>
						<input type="submit" class="btn btn-success pull-right" name="send" value="Submit" />
						<button class="btn btn-bg-grey pull-left" type="button" onclick="window.location.href='companyprofile.php'">Back</button>
						<br><br>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>


<?php

include "include/end.php";

?>

</body>

</html>
