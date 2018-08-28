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
                    <h1 class="page-header">Inventory</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <button class="btn btn-default" onclick="window.location.href='bay1.php'">Bay 1</button>
							<button class="btn btn-default" onclick="window.location.href='bay2.php'">Bay 2</button>
							<button class="btn btn-default" onclick="window.location.href='bay3.php'">Bay 3</button>
							<button class="btn btn-default" onclick="window.location.href='bay4.php'">Bay 4</button>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
											<td>Num</td>
											<td>Type</td>
											<td>Inventory Name</td>
											<td>Inventory ID</td>
											<td>Price</td>
											<td>Quantity</td>
											<td>Location</td>
											<td>Date</td>
											<td>Notification</td>
											<td>List</td>
										</tr>
                                    </thead>
                                    <tbody>
									<?php

									include 'config.php';
									$counter = 0;

									$select = "SELECT * FROM inventory WHERE location='Bay 2' ORDER BY id DESC ";						
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
										
										
										$counter++;

									?>
										<tr>
											<td><?php echo $counter; ?></td>
											<td><?php echo $type; ?></td>
											<td><?php echo $name; ?></td>
											<td><?php echo $inventory_id; ?></td>
											<td><?php echo $price; ?></td>
											<td><?php echo $quantity; ?></td>
											<td><?php echo $location; ?></td>
											<td><?php echo $date; ?></td>
											<td>
											<?php
											
											if($quantity <= 0){
												$alert = "No Stock";
											}else if($critical >= $quantity){
												$alert = "Critical";
											}else if($min >= $quantity && $critical < $quantity){
												$alert = "Alert";
											}else {
												$alert = "Sufficient";
											}	
											
											echo $alert;
											?>
											</td>
											<td><div class="dropdown pull-right">
										  <button class="btn btn-default dropdown-toggle btn-sm" type="button" data-toggle="dropdown"><i class="fa fa-list"></i>
										  </button>
										  <ul class="dropdown-menu">
											<li><a href="inventoryout.php?id=<?php echo $id; ?>" class="dropdown-item">OUT</a></li>
											<li class="divider"></li>
											<li><a href="inventoryin.php?id=<?php echo $id; ?>" class="dropdown-item">IN</a></li>
											<li class="divider"></li>
											<li><a href="inventorydel.php?id=<?php echo $id; ?>" onclick="return confirm('Are you sure you want to delete this?')" class="dropdown-item">DEL</a></li>
										  </ul>
										</div>
										</td>
										</tr>
									<?php
									
									}
									?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
							<br><br>
							<button class="btn btn-danger" onclick="window.location.href='inventoryadd.php'">ADD</button>
							
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
