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
			<h3 class="page-header"><center>INVENTORY CONTROL</center></h3>
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
		
			<p>Name: <strong><?php echo $comname; ?></strong></p>
			<p>Address: <strong><?php echo $comaddress; ?></strong></p>
			<p>Email: <strong><?php echo $comemail; ?></strong></p>
			<p>Contact Number: <strong><?php echo $comcontact; ?></strong></p>
			<p>Website: <strong><?php echo $comwebsite; ?></strong></p>
		
	</div>
	<div class="row">
		<div class="col-12">
		<?php
		if($secpass>= 1){}else{
		?>
			<a href="companyedit.php" class="btn btn-danger">Edit Company Profile</a>
		<?php
		}
		?>
			<a href="setting.php" class="btn btn-success">Setting</a>
		<!-- /.col-lg-12 -->
		</div>
	<!-- /.row -->
	</div>
</div>


<?php

include "include/end.php";

?>

</body>

</html>