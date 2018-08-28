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
													
$name = $_POST['name'];
$type = $_POST['type'];
$inventory_id = $_POST['inventory_id'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];
$qr=$_POST['qr'];							
$branch=$_POST['branch'];

$query = "INSERT INTO outgoing (type,name,inventory_id,price,quantity,qr,branch) 
			VALUES ('$type','$name','$inventory_id','$price','$quantity','$qr','$branch')";
$res = $conn->query($query);
	
if($res === TRUE){
	echo "<script type = \"text/javascript\">
		alert(\"Inventory Succesfully Added\");
		window.location = (\"home.php\")
		</script>";
	}

else {
	echo "<script type = \"text/javascript\">
		alert(\"Inventory Not Succesfully Added\");
		window.location = (\"inventory_in.php\")
		</script>";
	}
}

?>		

<h4>Outgoing</h4>

<form action="" method="post">

<label>Type</label>
<input class="" name="type" type="text" value=""></input>
<br><br>
<label>Name</label>
<input class="" name="name" type="text" value=""></input>
<br><br>
<label>Inventory_ID</label>
<input class="" name="inventory_id" type="text" value=""></input>
<br><br>
<label>Price</label>
<input class="" name="price" type="text" value=""></input>
<br><br>
<label>Quantity</label>
<input class="" name="quantity" type="text" value=""></input>
<br><br>
<label>QR</label>
<input class="" name="qr" type="text" value=""></input>
<br><br>
<label>Branch</label>
<input class="" name="branch" type="text" value=""></input>
<br><br>
<input type="submit" name="send" value="Enter" />

</form>

<img src = "../qr/php/qr_img.php?d=5b3344777e2da" width="200" height="200"></img>

</html>