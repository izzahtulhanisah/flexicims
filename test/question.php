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

	$question1 = $_POST['question1'];
	$question2 = $_POST['question2'];
	$loginid = $_POST['loginid'];

	$query = "UPDATE login SET question1='$question1', question2='$question2' WHERE id='$loginid'";
	$res = $conn->query($query);

	if($res === TRUE){
		echo "<script type = \"text/javascript\">
			alert(\"Successfully Edited Answers\");
			window.location = (\"profile.php\")
			</script>";
		}

	else {
		echo "<script type = \"text/javascript\">
			alert(\"Failed to Edit Answers\");
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
			<h3>EDIT SECRET ANSWERS</h3><hr>
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

		<div class="container">
		  <div class="panel panel-primary" style="width: 500px">
		    <div class="panel-heading">Edit Answers of Secret Questions</div>
		    <div class="panel-body">
						<form action="" method="post">
							<label>In what city were you born?</label>
							<input class="form-control" name="question1" type="text" value="<?php echo $question1; ?>"></input>
							<br>
							<label>What is your favorite movie?</label>
							<input class="form-control" name="question2" type="text" value="<?php echo $question2; ?>"></input>
							<br>
							<input type="hidden" class="btn btn-primary" name="loginid" value="<?php echo $loginid; ?>" />
							<button class="btn btn-bg-grey" type="button" onclick="window.location.href='profile.php'">Back</button>
							<input type="submit" class="btn btn-success pull-right" name="send" value="Submit" />
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
