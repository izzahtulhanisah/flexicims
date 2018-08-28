<!DOCTYPE html>
<html lang="en">

<head>

<?php

include "../include/head.php";

?>

</head>

<body class="theme-red">
<?php

include "../include/menu.php";

?>

	<section class="content">
        <div class="container-fluid">
			<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                EXPORTABLE TABLE
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">

							<table class="table table-bordered table-striped table-hover dataTable js-exportable">
								<thead>
									<tr>
										<td>Num</td>
										<td>Type</td>
										<td>Name</td>
										<td>ID</td>
										<td>Price</td>
										<td>Quantity/Weight</td>
										<td>Location</td>
										<td>Date</td>
										<td>Notification</td>
										<td>List</td>
									</tr>
								</thead>
								<tbody>
								<?php

								include '../config.php';
								$counter = 0;

								$select = "SELECT * FROM inventory ORDER BY id DESC ";						
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
											$alert = "
														No Stock
													";
										}else if($critical >= $quantity){
											$alert = "
														Critical
													";
										}else if($min >= $quantity && $critical < $quantity){
											$alert = "
														Alert
													";
										}else {
											$alert = "
														Sufficient
													";
										}	
										
										echo $alert;
										?>
										</td>
										<td>
											<div class="dropdown pull-right">
											<button class="btn btn-default dropdown-toggle btn-sm" type="button" data-toggle="dropdown"><i class="fa fa-list"></i></button>
											  <ul class="dropdown-menu">
												<li><a href="inventoryout.php?id=<?php echo $id; ?>" class="dropdown-item">Outgoing</a></li>
												<li class="divider"></li>
												<li><a href="inventoryin.php?id=<?php echo $id; ?>" class="dropdown-item">Incoming</a></li>
												<li class="divider"></li>
												<li><a href="inventoryedit.php?id=<?php echo $id; ?>" class="dropdown-item" >Edit</a></li>
												<li class="divider"></li>
												<li><a href="inventoryview.php?id=<?php echo $id; ?>" class="dropdown-item" >View</a></li>
												<li class="divider"></li>
												<li><a href="inventorydel.php?id=<?php echo $id; ?>" onclick="return confirm('Are you sure you want to delete this?')" class="dropdown-item">Delete</a></li>
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
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
		</div>
	</section>

<?php

include "../include/end.php";

?>

</body>

</html>