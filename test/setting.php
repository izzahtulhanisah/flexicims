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

?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php
include 'include/head.php';
?>
</head>

<body>
<?php
include 'include/menu.php';
?>

<!-- Page Content -->
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><center>SETTING</center></h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
		<div class="row">
			<div class="col-12">
				<center>
					<a href="companyprofile.php" class="btn btn-danger">COMPANY PROFILE</a>
				</center>
			<!-- /.col-lg-12 -->
			</div>
		<!-- /.row -->
		</div>
</div>



<?php
include 'include/end.php';
?>
</body>
</html>
