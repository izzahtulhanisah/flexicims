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
	include 'include/head.php';
	?>

</head>

<body>

	<?php
    include 'include/menu.php';
	?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">ADD NEW MANAGER</h3>
                </div>
						</div>
                <!-- /.col-lg-12 -->

<?php

date_default_timezone_set("Asia/Kuala_Lumpur");
include "config.php";

if(isset($_POST['send'])){
	
$name = $_POST['name'];
$address = $_POST['address'];
$email = $_POST['email'];
$contact = $_POST['contact'];
$position = $_POST['position'];
$loginid = $_POST['loginid'];
$username = $_POST['username'];
$password = $_POST['password'];
$secpass = "2";

$sqlid="SELECT MAX(id) AS maxid FROM login";
 $resultid = mysqli_query($conn, $sqlid);
 $rowid = mysqli_fetch_assoc($resultid);
 if($rowid['maxid']==NULL){
    $id=1; }
 else{
    $id=$rowid['maxid']+1;
 }

$query1 = "INSERT INTO profile (name,address,email,contact,position,loginid)
		VALUES ('$name','$address','$email','$contact','$position','$id')";
$res1 = $conn->query($query1);

$query = "INSERT INTO login(id,username,password,secpass)
		VALUES ('$id','$username','$password','$secpass')";
$res = $conn->query($query);

if($res === TRUE){
	echo "<script type = \"text/javascript\">
		alert(\"Manager Succesfully Add\");
		window.location = (\"manager.php\")
		</script>";
	}

else {
	echo "<script type = \"text/javascript\">
		alert(\"Manager Not Succesfully Add\");
		window.location = (\"manager.php\")
		</script>";
	}
}

?>

<div class="panel panel-primary" style="width: 500px">
			<div class="panel-heading">Manager Details</div>
				<div class="panel-body">

					<form action="" method="post">
					<label>Name :</label>
					<input class="form-control" name="name" type="text" value=""></input>
					<br>
					<label>Address :</label>
					<input class="form-control" name="address" type="text" value=""></input>
					<br>
					<label>Email :</label>
					<input class="form-control" name="email" type="text" value=""></input>
					<br>
					<label>Contact :</label>
					<input class="form-control" name="contact" type="text" value=""></input>
					<br>
					<label>Position :</label>
					<input class="form-control" name="position" type="text" value=""></input>
					<br>
					<label>Username :</label>
					<input class="form-control" name="username" type="text" value=""></input>
					<br>
					<label>Password :</label>
					<input class="form-control" name="password" type="password" value=""></input>
					<br>
					<input type="hidden" class="btn btn-primary" name="loginid" value="" />
					<input type="submit" class="btn btn-success pull-right" name="send" value="Submit" />
					<button class="btn btn-default" type="button" onclick="window.location.href='home.php'">Back</button>
					<br><br>
					</form>

				</div>
			</div>

	</div>
</div>

 <?php
include 'include/end.php';
?>

</body>

</html>
