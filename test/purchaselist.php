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
                    <h1 class="page-header">Tables</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            DataTables Advanced Tables
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
											<td>Inventory ID</td>
											<td>Inventory Name</td>
											<td>Quantity Now</td>
											<td>Quantity Needed/Purchase</td>
											<td>Price/Unit</td>
											<td>Total Price</td>
											<td>Barcode/QR</td>
											<td>Branch</td>
											<td>Noti</td>
											<td>Accept</td>
											<td>Dismiss</td>
											<td>Delete</td>
											<td>Document</td>
										</tr>
                                    </thead>
                                    <tbody>
                                        <?php

										include 'config.php';

										$select = "SELECT * FROM purchase";						
										$result = $conn->query($select);
										while($row = $result->fetch_assoc()){
											$inventory_id = $row["inventory_id"];
											$quantity_need = $row["need"];
											$qr = $row["qr"];
											$branch = $row["branch"];
											$status = $row["status"];
											
											$select2 = "SELECT * FROM inventory WHERE inventory_id = '$inventory_id' ";						
											$result2 = $conn->query($select2);
											while($row1 = $result2->fetch_assoc()){
												$id = $row["id"];
												$price = $row1["price"];
												$quantity = $row1["quantity"];
												$qr = $row1["qr"];
												$inventory_name = $row1["name"];

												
												$quantity_now = $quantity;
												$total_price = $price * $quantity_need;
												
										?>
											<tr>
												<td><?php echo $inventory_id; ?></td>
												<td><?php echo $inventory_name; ?></td>
												<td><?php echo $quantity_now; ?></td>
												<td><?php echo $quantity_need; ?></td>
												<td><?php echo $price; ?></td>
												<td><?php echo $total_price; ?></td>
												<td><?php echo $qr; ?></td>
												<td><?php echo $branch; ?></td>
												<td><?php echo $status; ?></td>
												<td><a href="purchaseacc.php?id=<?php echo $id; ?>" onclick="return confirm('Are you sure you want to accept this?')">Accept</a></td>
												<td><a href="purchasedis.php?id=<?php echo $id; ?>" onclick="return confirm('Are you sure you want to dismiss this?')">Dismiss</a></td>
												<td><a href="purchasedel.php?id=<?php echo $id; ?>" onclick="return confirm('Are you sure you want to delete this?')">Delete</a></td>
												<td><a href="testpdf.php?id=<?php echo $inventory_id; ?>" target="_blank" >Document</a></td>
											</tr>
										<?php
											}
										}
										?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
							<br><br>

							<a href="purchasereq.php">ADD</a>
							<br><br>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
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
