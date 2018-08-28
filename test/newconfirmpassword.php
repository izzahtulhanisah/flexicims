<?php

if(isset($_POST['send'])){
	include 'config.php';

	$id = mysqli_real_escape_string($con,$_POST['id']); 
	$username = mysqli_real_escape_string($con,$_POST['username']); 
	$password1 = mysqli_real_escape_string($con,$_POST['password1']);
	$password2 = mysqli_real_escape_string($con,$_POST['password2']);
	$passwordreal = mysqli_real_escape_string($con,$_POST['passwordreal']);
	
	$select = "SELECT * FROM login WHERE id = '$id' ";						
	$result = $conn->query($select);
	while($row = $result->fetch_assoc()){
		$password = $row["password"];
	}
	
	if($passwordreal===$password){
		if($password1===$password2){
			$query = "UPDATE login SET id= '$id', password='$password1' WHERE  id='$id'  ";
			$result = $conn->query($query);
		}
		else{
			echo "<script type = \"text/javascript\">
						alert(\"Password Not Match\");
						window.location = (\"login.php\")
					</script>";
		}
	}
	else{
		echo "<script type = \"text/javascript\">
						alert(\"Wrong Password\");
						window.location = (\"login.php\")
					</script>";
	}
}
?>

<form method="post" action="">
	<label>Password</label>
	<input type="password" name="password1" value="<?php echo "password1"; ?>"  />
	<label>Confirm Password</label>
	<input type="password" name="password2" value="<?php echo "password1"; ?>"  />
	<input type="hidden" name="id" value="<?php echo "id"; ?>"  />
	<input type="submit" name="send" value="Submit" />
</form>