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

$id = $_REQUEST['id'];

$select = "SELECT * FROM inventory WHERE id = $id ";						
$result = $conn->query($select);
while($row = $result->fetch_assoc()){
	$id = $row["id"];
	$type = $row["type"];
	$name = $row["name"];
	$inventory_id = $row["inventory_id"];
	$price = $row["price"];
	$quantity = $row["quantity"];
	$qr = $row["qr"];
	$branch = $row["branch"];
	$date = $row["date"];
	$critical = $row["critical"];
	$min = $row["min"];
	$location = $row["location"];
	$description = $row["description"];
	$dateupdate = $row["dateupdate"];
	$expireddate = $row["expireddate"];
	$supplier = $row["supplier"];
	$batch = $row["batch"];
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
                    <h1 class="page-header">Inventory Edit</h1>
                </div>
                <!-- /.col-lg-12 -->

<?php

date_default_timezone_set("Asia/Kuala_Lumpur");
include "config.php";

if(isset($_POST['send'])){
	
$expired =strtotime($_POST['expireddate']);
	
$name = $_POST['name'];
$type = $_POST['type'];
$inventory_id = $_POST['inventory_id'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];
$qr="1";							
$branch="1";
$date=date("Y-m-d H:i:s");
$critical=$_POST['critical'];
$minimum=$_POST['minimum'];
$location=$_POST['location'];
$description=$_POST['description'];
$dateupdate=date("Y-m-d H:i:s");
$expireddate=date("d-m-Y",$expired);
$supplier=$_POST['supplier'];
$batch=$_POST['batch'];

$query = "UPDATE inventory SET id= '$id', name='$name', type='$type', inventory_id='$inventory_id', price='$price', quantity='$quantity', qr='$qr', branch='$branch', dateupdate='$dateupdate', critical='$critical', min='$minimum', location='$location', description='$description', WHERE  id='$id' ";
$res = $conn->query($query);

$queryin = "";
			
$resin = $conn->query($queryin);
	
if($res === TRUE){
	echo "<script type = \"text/javascript\">
		alert(\"Inventory Succesfully Edited\");
		window.location = (\"home.php\")
		</script>";
	}

else {
	echo "<script type = \"text/javascript\">
		alert(\"Inventory Not Succesfully Edited\");
		window.location = (\"inventoryadd.php\")
		</script>";
	}
}

//--------------------------------------------------------------------------------------------------

if(isset($_POST['sendloc'])){
	
$location = $_POST['location'];
$branch = $_POST['branch'];
	
$query = "INSERT INTO location (location,branch) 
		VALUES ('$location','$branch')";
			
$res = $conn->query($query);

if($res === TRUE){

	}

else {
	echo "<script type = \"text/javascript\">
		alert(\"Location Not Succesfully Added\");
		window.location = (\"inventoryadd.php\")
		</script>";
	}

}

?>		


<form action="" method="post">

<label>Type</label>
<input class="form-control" name="type" type="text" value="<?php echo $type; ?>"></input>
<br>
<label>Name</label>
<input class="form-control" name="name" type="text" value="<?php echo $name; ?>"></input>
<br>
<label>Inventory ID</label>
<input class="form-control" name="inventory_id" type="text" value="<?php echo $inventory_id; ?>"></input>
<br>
<label>Price</label>
<input class="form-control" name="price" type="text" value="<?php echo $price; ?>"></input>
<br>
<label>Quantity</label>
<input class="form-control" name="quantity" type="text" value="<?php echo $quantity; ?>"></input>
<br>
<label>Location</label>
<select class="form-control" name="location">
<option disabled selected>Select Location..</option>
<?php

$selectloc = "SELECT * FROM location";						
$resultloc = $conn->query($selectloc);
while($rowloc = $resultloc->fetch_assoc()){
	$id = $rowloc["id"];
	$location = $rowloc["location"];

echo "<option>". $location ."</option>";

}

?>
</select>
<br>
<a href = "#" class="btn btn-success" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-square"></i></a>
<br>
<br>
<label>Critical</label>
<input class="form-control" name="critical" type="text" value="<?php echo $critical; ?>"></input>
<br>
<label>Minimum</label>
<input class="form-control" name="minimum" type="text" value="<?php echo $min; ?>"></input>
<br>
<label>Description</label>
<input class="form-control" name="description" type="text" value="<?php echo $description; ?>"></input>
<br>
<input type="submit" class="btn btn-primary" name="send" value="Enter" />
<button class="btn btn-danger" onclick="window.location.href='home.php'">Back</button>
<br><br>
</form>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Modal title</h4>
			</div>
			<div class="modal-body">
				<form action="" method="post">
					<label>Location</label>
					<input class="form-control" name="location" type="text" value=""></input>
					<input class="form-control" name="branch" type="hidden" value="1"></input>
					<br>
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

				<input type="submit" class="btn btn-primary" name="sendloc" value="Enter" />
				</form>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

 <?php
include 'include/end.php';
?>

</body>

</html>