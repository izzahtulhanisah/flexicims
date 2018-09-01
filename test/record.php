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
                    <h3 class="page-header"><center>INVENTORY RECORD</center></h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            List of Products' Activities
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
											<td><b>No</b></td>
											<td><b>Name</b></td>
											<td><b>ID</b></td>
											<td><b>Type</b></td>
											<td><b>Quantity</b></td>
											<td><b>Unit</b></td>
											<td><b>Details</b></td>
											<td><b>Date</b></td>
											<td><b>User</b></td>
										</tr>
                                    </thead>
                                    <tbody>
									<?php

									include 'config.php';
									$counter = 0;

									$select = "SELECT r.* , l.username FROM record as r INNER JOIN login as l ON r.user = l.id ORDER BY id DESC ";
									$result = $conn->query($select);
									while($row = $result->fetch_assoc()){
										$id = $row["id"];
										$type = $row["type"];
										$name = $row["name"];
										$inventory_id = $row["inventory_id"];
										$price = $row["price"];
										$quantity = $row["quantity"];
										$unit = $row["unit"];
										$detail = $row["detail"];
										$qr = $row["qr"];
										$branch = $row["branch"];
										$date = $row["date"];
										$user = $row["user"];
										$username = $row["username"];

										$counter++;



									?>
										<tr>
											<td><?php echo $counter; ?></td>
											<td><?php echo nl2br($name); ?></td>
											<td><?php echo $inventory_id; ?></td>
											<td><?php echo $type; ?></td>
											<td><?php echo $quantity; ?></td>
											<td><?php echo $unit; ?></td>
											<td><?php echo $detail; ?></td>
											<td><?php echo $date; ?></td>
											<td>
											<?php


												echo $username;


											?>
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
