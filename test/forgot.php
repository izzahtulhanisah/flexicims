<!DOCTYPE html>
<html lang="en">

<head>

<?php

include "include/head.php";
include 'config.php';

?>

</head>

<body class="theme-red">
<?php



?>

<section>
	<section>
		<div class="row">
			<div class="col-lg-12">
				<!-- <h1 class="page-header">FORGOT PASSWORD</h1> -->
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<?php

		if(isset($_POST['forgot1'])){

			$username = $_POST['username'];

			$select = "SELECT * FROM login WHERE username= '$username' ";
			$result = $conn->query($select);
			while($row = $result->fetch_assoc()){
				$question1 = $row["question1"];
			}

		?>
			<div class="row">
				<div class="col-lg-12">
					<div class="container">
					  <center><h2>Secret Question 1</h2></center>
					  <center><div class="panel panel-warning" style="width: 500px">
					    <div class="panel-heading">Fill in the Secret Answer</div>
					    <div class="panel-body">
								<form method="post" action="">
									<label>In what city were you born?</label>
									<input class="form-control" type="text" name="question1">
									<input class="form-control" type="hidden" name="username" value="<?php echo $username; ?>"><br>
									<input class="btn btn-success pull-right" type="submit" name="forgot2" value="Submit">
									<button class="btn btn-bg-grey pull-left" type="button" onclick="window.location.href='forgot.php'">Back</button>
								</form>
							</div>
						</div></center>
					</div>
				</div>
			</div>
		<?php

		}
		elseif(isset($_POST['forgot2'])){

			$question1 = $_POST['question1'];
			$username = $_POST['username'];

			$select = "SELECT * FROM login WHERE username= '$username' ";
			$result = $conn->query($select);
			while($row = $result->fetch_assoc()){
				$question2 = $row["question2"];
			}
		?>
			<div class="row">
				<div class="col-lg-12">
					<div class="container">
					  <center><h2>Secret Question 2</h2></center>
					  <center><div class="panel panel-warning" style="width: 500px">
					    <div class="panel-heading">Fill in the Secret Answer</div>
					    <div class="panel-body">
								<form method="post" action="">
									<label><b>What is your favorite movie? <b></label>
									<input class="form-control" type="text" name="question2">
									<input class="form-control" type="hidden" name="question1" value="<?php echo $question1; ?>">
									<input class="form-control" type="hidden" name="username" value="<?php echo $username; ?>">
									<br>
									<input class="btn btn-success pull-right" type="submit" name="forgot3" value="Submit">
									<button class="btn btn-bg-grey pull-left" type="button" onclick="window.location.href='forgot.php'">Back</button>
								</form>
							</div>
						</div></center>
					</div>
				</div>
			</div>
		<?php
		}
		elseif(isset($_POST['forgot3'])){
			$answer1 = $_POST['question1'];
			$answer2 = $_POST['question2'];
			$username = $_POST['username'];

			$select = "SELECT * FROM login WHERE username= '$username' ";
			$result = $conn->query($select);
			while($row = $result->fetch_assoc()){
				$question1 = $row["question1"];
				$question2 = $row["question2"];
			}

			if($question1 === $answer1 && $question2 === $answer2){
		?>
			<div class="row">
				<div class="col-lg-12">
					<div class="container">
					  <center><h2>Reset Password</h2></center>
					  <center><div class="panel panel-success" style="width: 500px">
					    <div class="panel-heading">Input Your New Password</div>
					    <div class="panel-body">
								<form method="post" action="">
									<label><b>New Password<b></label>
									<input class="form-control" type="password" name="password1">
									<br>
									<label><b>Confirm Password<b></label>
									<input class="form-control" type="password" name="password2">
									<input class="form-control" type="hidden" name="username" value="<?php echo $username; ?>">
									<br>
									<input class="btn btn-success pull-right" type="submit" name="reset" value="Submit">
									<button class="btn btn-bg-grey pull-left" type="button" onclick="window.location.href='forgot.php'">Back</button>
								</form>
							</div>
						</div></center>
					</div>
				</div>
			</div>
		<?php
			}
			else{

				echo "<script type = \"text/javascript\">
						alert(\"You input the wrong answer\");
						window.location = (\"login.php\")
						</script>";
			}
		}
		elseif(isset($_POST['reset'])){

			$password1 = $_POST['password1'];
			$password2 = $_POST['password2'];
			$username = $_POST['username'];

			if($password1 === $password2){



				$query = "UPDATE login SET password='$password1' WHERE  username='$username'  ";

				$res = $conn->query($query);

				if($res === TRUE){
					echo "<script type = \"text/javascript\">
						alert(\"Password Succesfully Edited\");
						window.location = (\"login.php\")
						</script>";
					}

				else {
					echo $password1;
					echo $password2;
					echo $username;
					}
			}
			else{
				echo "<script type = \"text/javascript\">
						alert(\"Your input the wrong password\");
						window.location = (\"login.php\")
						</script>";
			}
		}
		else{
		?>
			<div class="row">
				<div class="col-lg-12">
					<div class="container">
					  <h2><center>Forgot Password</center></h2><hr>
					  <center><div class="panel panel-primary" style="width: 500px">
					    <div class="panel-heading">Reset Password</div>
					    	<div class="panel-body">
									<form method="post" action="">
										<label><b>Input Your Username<b></label>
										<input class="form-control" type="text" name="username"><br>
										<input class="btn btn-success pull-right" type="submit" name="forgot1" value="Submit">
										<button class="btn btn-bg-grey pull-left" type="button" onclick="window.location.href='login.php'">Back</button>
									</form>
								</div>
							</div></center>
						</div>

				</div>
			</div>
		<?php
		}
		?>
	</section>
</section>


<?php

include "include/end.php";

?>

</body>

</html>
