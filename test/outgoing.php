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
	$logid = $row["id"];
	$userid = $row["id"];
	$secpass = $row["secpass"];
	$leadid = $row["lead_id"];
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
                    <h3 class="page-header"><center>OUTGOING ACTIVITIES</center></h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            List of Outgoing Products
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
											<!-- <td>Branch</td> -->
											<td><b>Transporter</b></td>
											<!-- <td>DO Number</td> -->
											<td><b>Deliver To</b></td>
											<td><b>Remark</b></td>
										</tr>
                                    </thead>
                                    <tbody>
									<?php

									include 'config.php';

									$counter=0;

									if($secpass == 2){
										$select = "SELECT * FROM record WHERE detail = 'Outgoing' AND leadid = '$logid' ORDER BY id DESC ";
									}
									elseif($secpass == 3){
										$select = "SELECT * FROM record WHERE detail = 'Outgoing' AND leadid = '$leadid'  ORDER BY id DESC ";
									}
									else{
										$select = "SELECT * FROM record WHERE detail = 'Outgoing' ORDER BY id DESC ";
									}
									$result = $conn->query($select);
									while($row = $result->fetch_assoc()){
										$id = $row["id"];
										$type = $row["type"];
										$name = $row["name"];
										$inventory_id = $row["inventory_id"];
										$price = $row["price"];
										$quantity = $row["quantity"];
										$unit = $row["unit"];
										$qr = $row["qr"];
										$branch = $row["branch"];
										$transporter = $row["transporter"];
										$do = $row["do"];
										$deliverto = $row["deliverto"];
										$remark = $row["remark"];

										$counter++;

									?>
										<tr>
											<td><?php echo $counter; ?></td>
											<td><?php echo $name; ?></td>
											<td><?php echo $inventory_id; ?></td>
											<td><?php echo $type; ?></td>
											<td><?php echo $quantity; ?></td>
											<td><?php echo $unit; ?></td>
											<!-- <td><?php echo $branch; ?></td> -->
											<td><?php echo $transporter; ?></td>
											<!-- <td><?php echo $do; ?></td> -->
											<td><?php echo $deliverto; ?></td>
											<td><?php echo $remark; ?></td>
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
