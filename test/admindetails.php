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
			<h3>ADMIN DETAILS</h3><hr>
		</div>
		<!-- /.col-lg-12 -->
	</div>
            <!-- /.row -->
	<div class="row">
		<?php

		$select = "SELECT * FROM profile WHERE position='Admin'";
		$result = $conn->query($select);
		while($row = $result->fetch_assoc()){
			$id = $row["id"];
			$name = $row["name"];
			$email = $row["email"];
			$contact = $row["contact"];
			$position = $row["position"];
		}
		?>

		<div class="container">

		  <div class="panel panel-info" style="width: 500px">
		    <div class="panel-heading">Please Contact Your System Administrator for Assistance</div>
		    <div class="panel-body">
					<p>Name: <strong><?php echo $name; ?></strong></p>
					<p>Email: <strong><?php echo $email; ?></strong></p>
					<p>Contact Number: <strong><?php echo $contact; ?></strong></p>
					<p>Position: <strong><?php echo $position; ?></strong></p>
					</div>
				</div>
			</div>
		</div>

	<!-- <div class="row">
		<div class="col-lg-12">
		<?php
		if($secpass>= 1){}else{
		?>
			<a href="companyedit.php" class="btn btn-warning">Edit Company Profile</a>
		<?php
		}
		?> -->
			<!-- <a href="setting.php" class="btn btn-success">Setting</a> -->
		<!-- /.col-lg-12 -->
		<!-- </div> -->
	<!-- /.row -->
	<!-- </div> -->
</div>


<?php

include "include/end.php";

?>

</body>

</html>
