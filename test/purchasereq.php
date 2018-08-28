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
<html>

<?php

include "config.php";

if(isset($_POST['send'])){
													
$inventory_id = $_POST['inventory_id'];
$need = $_POST['need'];
$qr = $_POST['qr'];
$status = $_POST['status'];							
$branch=$_POST['branch'];

$query = "INSERT INTO purchase (inventory_id,need,qr,status,branch) 
			VALUES ('$inventory_id','$need','$qr','$status','$branch')";
$res = $conn->query($query);
	
if($res === TRUE){
	echo "<script type = \"text/javascript\">
		alert(\"Purchase Succesfully Added\");
		window.location = (\"home.php\")
		</script>";
	}

else {
	echo "<script type = \"text/javascript\">
		alert(\"Purchase Not Succesfully Added\");
		window.location = (\"purchasereq.php\")
		</script>";
	}
}

?>		

<h4>Purchase In</h4>

<form action="" method="post">

<label>Inventory ID</label>
<select name="inventory_id" class="">
	<?php
	
	$select2 = "SELECT inventory_id FROM inventory";						
	$result2 = $conn->query($select2);
	while($row = $result2->fetch_assoc()){
		$inventory_id = $row["inventory_id"];
	
	echo "<option>". $inventory_id ."</option>";
	
	}
	?>
</select>
<br><br>
<label>Quantity Need</label>
<input class="" name="need" type="text" value=""></input>
<br><br>
<input class="" name="qr" type="hidden" value="1"></input>
<input class="" name="status" type="hidden" value="Pending"></input>
<input class="" name="branch" type="hidden" value="1"></input>
<input type="submit" name="send" value="Enter" />

</form>

</html>