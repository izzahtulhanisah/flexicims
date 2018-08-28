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

		$select = "SELECT p.*,l.* FROM profile as p INNER JOIN login as l ON l.id=p.loginid WHERE l.username='$username'";
		$result = $conn->query($select);
		while($row = $result->fetch_assoc()){
			$name = $row["name"];
			$address = $row["address"];
			$email = $row["email"];
			$contact = $row["contact"];
			$position = $row["position"];
			$user = $row["username"];
			$password = $row["password"];
			$question1 = $row["question1"];
			$question2 = $row["question2"];
		}
		?>
		
			<p>Name: <strong><?php echo $name; ?></strong></p>
			<p>Address: <strong><?php echo $address; ?></strong></p>
			<p>Email: <strong><?php echo $email; ?></strong></p>
			<p>Contact Number: <strong><?php echo $contact; ?></strong></p>
			<p>Position: <strong><?php echo $position; ?></strong></p>
			<p>Username: <strong><?php echo $user; ?></strong></p>
			<p>Password: <strong><?php echo $password; ?></strong></p>
			<p>Question 1: <strong><?php echo $question1; ?></strong></p>
			<p>Question 2: <strong><?php echo $question2; ?></strong></p>
		
	</div>
	<div class="row">
		<div class="col-12">
				<a href="editprofile.php" class="btn btn-danger">Edit Your Profile</a>
				<a href="question.php" class="btn btn-danger">Edit Your Question</a>
				<a href="password.php" class="btn btn-primary">Edit Your Password</a>
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