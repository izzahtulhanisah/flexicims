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
                    <h1 class="page-header">Incoming</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">

<?php

date_default_timezone_set("Asia/Kuala_Lumpur");
include "config.php";
$id = $_REQUEST['id'];
$date=date("Y-m-d H:i:s");

$select = "SELECT * FROM inventory WHERE id = $id ";						
$result = $conn->query($select);
while($row = $result->fetch_assoc()){
	$quan = $row["quantity"];
	$type = $row["type"];
	$name = $row["name"];
	$inventory_id = $row["inventory_id"];
	$price = $row["price"];
	$qr = $row["qr"];
	$branch = $row["branch"];

	}

if(isset($_POST['send'])){

$id = $_REQUEST['id'];
$qty = $_POST['qty'];
$supplier = $_POST['supplier'];
$remark = $_POST['remark'];

$quantity = $quan + $qty;

$query = "UPDATE inventory SET id= '$id', quantity='$quantity' WHERE  id='$id'  ";

$res = $conn->query($query);

$queryin = "INSERT INTO record (type,name,inventory_id,price,quantity,detail,qr,branch,date,supplier, datereceive,remark,user) 
			VALUES ('$type','$name','$inventory_id','$price','$qty','Incoming','$qr','$branch','$date','$supplier','$date','$remark','$userid')";
			
$resin = $conn->query($queryin);
	
if($res === TRUE){
	echo "<script type = \"text/javascript\">
		alert(\"Inventory Succesfully Added\");
		window.location = (\"home.php\")
		</script>";
	}

else {
	echo "<script type = \"text/javascript\">
		alert(\"Inventory Not Succesfully Added\");
		window.location = (\"inventory_out.php\")
		</script>";
	}
}

?>		

<form action="" method="post">

<label></label>
<p>Quantity Left: <?php echo $quan; ?></p>
<input class="form-control" name="qty" type="text" value=""></input>
<br>
<p>Supplier</p>
<input class="form-control" name="supplier" type="text" value=""></input>
<br>
<p>Remark</p>
<input class="form-control" name="remark" type="text" value=""></input>
<br>
<input class="" name="id" type="hidden" value="<?php echo $id; ?>"></input>
<br>
<input class="btn btn-default" type="submit" name="send" value="Enter" />

</form>

<br>
<a href="home.php"><button type="button" class="btn btn-danger" style="margin-bottom: 2px;">Back</button></a>
					
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    <?php
    include 'include/end.php';
	?>

</body>

</html>