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
		window.location = (\"manageredit.php\")
		</script>";
	}

else {
	echo "<script type = \"text/javascript\">
		alert(\"Profile Not Succesfully Edit\");
		window.location = (\"manageredit.php\")
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
			<h3 class="page-header"><center>PROFILE</center></h3>
		</div>
		<!-- /.col-lg-12 -->
	</div>
            <!-- /.row -->
	<div class="row">
		<?php

		$select = "SELECT p.*,l.* FROM profile as p INNER JOIN login as l ON l.id=p.loginid WHERE l.username='$username'";
		$result = $conn->query($select);
		while($row = $result->fetch_assoc()){
			$loginid = $row["loginid"];
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
		<form action="" method="post">
			<label>Name</label>
			<input class="form-control" name="name" type="text" value="<?php echo $name; ?>"></input>
			<br>
			<label>Address</label>
			<input class="form-control" name="address" type="text" value="<?php echo $address; ?>"></input>
			<br>
			<label>Email</label>
			<input class="form-control" name="email" type="text" value="<?php echo $email; ?>"></input>
			<br>
			<label>Contact</label>
			<input class="form-control" name="contact" type="text" value="<?php echo $contact; ?>"></input>
			<br>
			<label>Position</label>
			<input class="form-control" name="position" type="text" value="<?php echo $position; ?>"></input>
			<br>
			<label>Username</label>
			<input class="form-control" name="username" type="text" value="<?php echo $user; ?>"></input>
			<br>
			<label>Password</label>
			<input class="form-control" name="password" type="password" value="<?php echo $password; ?>"></input>
			<br>
			<label>Question 1</label>
			<input class="form-control" name="password" type="question1" value="<?php echo $question1; ?>"></input>
			<br>
			<label>Question 2</label>
			<input class="form-control" name="password" type="question2" value="<?php echo $question2; ?>"></input>
			<br>
			<input type="hidden" class="btn btn-primary" name="loginid" value="<?php echo $loginid; ?>" />
			<input type="submit" class="btn btn-success" name="send" value="Submit" />
			<button class="btn btn-bg-grey" onclick="window.location.href='home.php'">Back</button>
			<br><br>
		</form>
	</div>
</div>


<?php

include "include/end.php";

?>

</body>

</html>