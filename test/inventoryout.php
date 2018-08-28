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
                    <h1 class="page-header">Outgoing</h1>
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
$transporter = $_POST['transporter'];
//$do = $_POST['do'];
$deliverto = $_POST['deliverto'];
$remark = $_POST['remark'];

$quantity = $quan - $qty;

$query = "UPDATE inventory SET id= '$id', quantity='$quantity' WHERE  id='$id'  ";

$res = $conn->query($query);

$queryout = "INSERT INTO record (type,name,inventory_id,price,quantity,detail,qr,branch,date,transporter,deliverto,remark,user) 
			VALUES ('$type','$name','$inventory_id','$price','$qty','Outgoing','$qr','$branch','$date','$transporter','$deliverto','$remark','$userid')";
$resout = $conn->query($queryout);
	
if($res === TRUE){
	echo "<script type = \"text/javascript\">
		alert(\"Inventory Succesfully Deducted\");
		window.location = (\"home.php\")
		</script>";
	}

else {
	echo "<script type = \"text/javascript\">
		alert(\"Inventory Not Succesfully Deducted\");
		window.location = (\"inventory_out.php\")
		</script>";
	}
}

?>		

<form action="" method="post">

<label></label>
<p>Quantity Left: <?php echo $quan; ?></p>
<label>Quantity Out</label>
<input class="form-control" name="qty" type="text" value=""></input>
<label>Transporter</label>
<input class="form-control" name="transporter" type="text" ></input>
<label>Deliver To</label>
<input class="form-control" name="deliverto" type="text" ></input>
<label>Remark</label>
<input class="form-control" name="remark" type="text" ></input>
<input class="" name="id" type="hidden" value="<?php echo $id; ?>"></input>
<input class="" name="name" type="hidden" value="<?php echo $name; ?>"></input>
<input class="" name="type" type="hidden" value="<?php echo $type; ?>"></input>
<input class="" name="inventory_id" type="hidden" value="<?php echo $inventory_id; ?>"></input>
<input class="" name="price" type="hidden" value="<?php echo $price; ?>"></input>
<input class="" name="qr" type="hidden" value="<?php echo $qr; ?>"></input>
<input class="" name="branch" type="hidden" value="<?php echo $branch; ?>"></input>
<br>
<input type="submit" class="btn btn-default" name="send" value="Enter" />

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