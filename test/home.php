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

	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

	<script>

	$( document ).ready(function() {
    $('#select1').on("change", function(){
      var selectedClass = $(this).val(); //store the selected value
      $('#select2').val("");             //clear the second dropdown selected value

      //now loop through the 2nd dropdown, hide the unwanted options
      $('#select2 option').each(function () {
        var newValue = $(this).attr('class');
        if (selectedClass != newValue && selectedClass != "") {
            $(this).hide();
        }
      else{$(this).show(); }
     });

    });
});

	</script>

	<script>

	$( document ).ready(function() {
    $('#select3').on("change", function(){
      var selectedClass = $(this).val(); //store the selected value
      $('#select4').val("");             //clear the second dropdown selected value

      //now loop through the 2nd dropdown, hide the unwanted options
      $('#select4 option').each(function () {
        var newValue = $(this).attr('class');
        if (selectedClass != newValue && selectedClass != "") {
            $(this).hide();
        }
      else{$(this).show(); }
     });

    });
});

	</script>

</head>

<body>

	<?php
    include 'include/menu.php';
	?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><center>INVENTORY LIST</center></h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			<!-- <div class="row">
				<div class="col-lg-12"><p>View Products by <b>Locations:</b></p></div>
					<form class="" action="" method="post">
					<div class="col-lg-3">
						<select class="form-control" id="select1" name="location" >
							<option disabled selected>Select Location..</option>
							<?php

							$selectloc = "SELECT * FROM location";
							$resultloc = $conn->query($selectloc);
							while($rowloc = $resultloc->fetch_assoc()){
								$id = $rowloc["id"];
								$location = $rowloc["location"];

							echo "<option value='". $location ."'>". $location ."</option>";

							}

							?>
						</select>
					</div> -->
					<!-- <div class="col-lg-3">
						<select class="form-control" id="select2" name="location2" >
							<option disabled selected>Select Sub-Location..</option>
							<?php

							$selectloc2 = "SELECT location,location2 FROM inventory GROUP BY location,location2";
							$resultloc2 = $conn->query($selectloc2);
							while($rowloc2 = $resultloc2->fetch_assoc()){

								$location = $rowloc2["location"];
								$location2 = $rowloc2["location2"];

							echo "<option class='".$location."'>". $location2 ."</option>";

							}

							?>
						</select>
					</div> -->
					<!-- <div class="col-lg-3">
						<select class="form-control" name="location" >
							<option disabled selected>Select Location..</option>
							<?php

							//$selectloc = "SELECT * FROM location";
							//$resultloc = $conn->query($selectloc);
							//while($rowloc = $resultloc->fetch_assoc()){
							//	$id = $rowloc["id"];
							//	$location = $rowloc["location"];

							//echo "<option>". $location ."</option>";

							//}

							?>
						</select>
					</div> -->
					<!-- <div class="col-lg-4">
						<input type="submit" value="Confirm" name="send" class="btn btn-primary">
					</div> -->
					<!-- <div class="col-lg-1">
						<span class="pull-left"><button class="btn btn-danger" onclick="window.location.href='home.php'">Back</button></span>
					</div> -->
				<!-- </form>
			</div> -->
<?php

if(isset($_POST['send'])){

	$loc = $_POST['location'];
	$loc2 = $_POST['location2'];

	echo "<script type = \"text/javascript\">
		window.location = (\"bay1.php?location=". $loc ."&location2=". $loc2 ."\")
		</script>";

}

?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <p>LIST OF ALL PRODUCTS
														<button class="btn btn-success pull-right btn-sm" onclick="window.location.href='inventoryadd.php'"><i class="fa fa-plus" style="font-size:12px"></i> New Item</button></p>
                        </div>

                        <!-- /.panel-heading -->
                        <div class="panel-body">

                            <div class="dataTable_wrapper">
								<div class="table-responsive">
									<table class="table table-striped table-bordered table-hover table-sm" id="dataTables-example">
										<thead>
											<tr>
												<td><b>No</b></td>
												<td><b>Name</b></td>
												<td><b>ID</b></td>
												<td><b>Type</b></td>
												<td><b>Quantity</b></td>
												<td><b>Location</b></td>
												<!-- <td>Date</td> -->
												<td><b>Status</b></td>
												<td><b>Action</b></td>
											</tr>
										</thead>
										<tbody>
										<?php

										include 'config.php';
										$counter = 0;

										if($secpass == 2){
											$select = "SELECT i.*,l.location FROM inventory as i INNER JOIN location as l ON l.location = i.location WHERE l.manager_id = '$logid' ORDER BY id DESC ";
										}
										elseif($secpass == 3){
											$select = "SELECT i.*,l.location FROM inventory as i INNER JOIN location as l ON l.location = i.location WHERE l.manager_id = '$leadid' ORDER BY id DESC ";
										}
										else{
											$select = "SELECT * FROM inventory ORDER BY id DESC ";
										}

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
											$location2 = $row["location2"];
											$description = $row["description"];
											$dateupdate = $row["dateupdate"];
											$expireddate = $row["expireddate"];
											$supplier = $row["supplier"];
											$batch = $row["batch"];
											$max = $row["max"];


											$counter++;

										?>
											<tr>
												<td><?php echo $counter; ?></td>
												<td><?php echo $name; ?></td>
												<td><?php echo $inventory_id; ?></td>
												<td><?php echo $type; ?></td>
												<td><?php echo $quantity; ?></td>
												<td><?php echo $location2; echo " | "; echo $location; ?></td>

												<td>

												<?php


												if($quantity <= 0){
													$alert = "<center><b><div class='alert alert-danger' style='margin-top: 0px; padding: 0;'>
																No Stock
															</b></div></center>";
												}else if($critical >= $quantity){
													$alert = "<center><b><div class='alert alert-danger' style='margin-top: 0px; padding: 0;'>
																Critical
															</b></div></center>";
												}else if($min >= $quantity && $critical < $quantity){
													$alert = "<center><b><div class='alert alert-warning' style='margin-top: 0px; padding: 0;'>
																Minimum
															</b></div></center>";
												}else if($max < $quantity){
													$alert = "<center><b><div class='alert alert-info' style='margin-top: 0px; padding: 0;'>
																Maximum
															</b></div></center>";
												}else {
													$alert = "<center><b><div class='alert alert-success'  style='margin-top: 0px; padding: 0;'>
																Sufficient
															</b></div></center>";
												}

												echo $alert;



												?>
												</td>

												<td>

													<div class="dropdown pull-right">
													<button class="btn btn-default dropdown-toggle btn-sm" type="button" data-toggle="dropdown"><i class="fa fa-list"></i></button>
													  <ul class="dropdown-menu">
														<li><a href="#" class="dropdown-item" data-toggle="modal" data-placement="bottom" data-target="#outgoing<?php echo $id; ?>" title="outgoing">Outgoing</a></li>
														<li class="divider"></li>
														<li><a href="#" class="dropdown-item" data-toggle="modal" data-placement="bottom" data-target="#incoming<?php echo $id; ?>" title="incoming">Incoming</a></li>
														<?php

												if($secpass>= 3){}
												else{

												?>
														<li class="divider"></li>
														<li><a href="#" class="dropdown-item" data-toggle="modal" data-placement="bottom" data-target="#edit<?php echo $id; ?>" title="edit">Edit</a></li>
														<li class="divider"></li>
														<li><a href="#" class="dropdown-item" data-toggle="modal" data-placement="bottom" data-target="#view<?php echo $id; ?>" title="view">View</a></li>
														<li class="divider"></li>
														<li><a href="inventorydel.php?id=<?php echo $id; ?>" onclick="return confirm('Are you sure you want to delete this?')" class="dropdown-item">Delete</a></li>
														<?php
												}
													?>
													  </ul>
													</div>


													<div class="modal fade" id="outgoing<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
														<div class="modal-dialog">
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
																	<h4 class="modal-title" id="myModalLabel"><center>Outgoing Form</center></h4>
																</div>

													<?php

													date_default_timezone_set("Asia/Kuala_Lumpur");
													$date=date("Y-m-d H:i:s");

													$quanout = $quantity;

													if(isset($_POST['sendout'.$id.''])){

													$id = $_POST['id'];
													$qty = $_POST['qty'];
													$transporter = $_POST['transporter'];
													//$do = $_POST['do'];
													$deliverto = $_POST['deliverto'];
													$remark = $_POST['remark'];

													$select = "SELECT * FROM inventory WHERE id = $id ";
													$result = $conn->query($select);
													while($row = $result->fetch_assoc()){
														$quanout = $row["quantity"];
														$type = $row["type"];
														$name = $row["name"];
														$inventory_id = $row["inventory_id"];
														$price = $row["price"];
														$qr = $row["qr"];
														$branch = $row["branch"];

														}

													$quantity = $quanout - $qty;

													if($quantity <= 0){
														$status = "No Stock";
													}else if($critical >= $quantity){
														$status = "Critical";
													}else if($min >= $quantity && $critical < $quantity){
														$status = "Minimum";
													}else if($max < $quantity){
														$status = "Maximum";
													}else {
														$status = "Sufficient";
													}

													$query = "UPDATE inventory SET id= '$id', quantity='$quantity', status='$status' WHERE  id='$id'  ";

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

													<div class="modal-body">
														<form action="" method="post">
														<!-- <label></label> -->
															<p><center><i>Quantity Left: <?php echo $quanout; ?></i></center></p>
															<!-- <br> -->
														<label>Input Quantity</label>
															<p><input class="form-control" name="qty" type="text" value=""></input></p>
															<br>
														<label>Transporter / Tracking No</label>
															<p><input class="form-control" name="transporter" type="text" ></input></p>
															<br>
														<label>Destination / Deliver To</label>
															<p><input class="form-control" name="deliverto" type="text" ></input></p>
															<br>
														<label>Remark / Comment</label>
														<p><input class="form-control" name="remark" type="text" ></input>
														<input class="" name="id" type="hidden" value="<?php echo $id; ?>"></input>
														<input class="" name="name" type="hidden" value="<?php echo $name; ?>"></input>
														<input class="" name="type" type="hidden" value="<?php echo $type; ?>"></input>
														<input class="" name="inventory_id" type="hidden" value="<?php echo $inventory_id; ?>"></input>
														<input class="" name="price" type="hidden" value="<?php echo $price; ?>"></input>
														<input class="" name="qr" type="hidden" value="<?php echo $qr; ?>"></input>
														<input class="" name="branch" type="hidden" value="<?php echo $branch; ?>"></input></p>
														<br>
													</div>

													<div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
														<input type="submit" class="btn btn-success" name="sendout" value="Submit" />
														</form>
													</div>
													</div>
													<!-- /.modal-content -->
												</div>
												<!-- /.modal-dialog -->
											</div>
											<!-- /.modal -->


											<!-- INCOMING FORM -->
											<div class="modal fade" id="incoming<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
															<h4 class="modal-title" id="myModalLabel"><center>Incoming Form</center></h4>
														</div>
															<?php

															date_default_timezone_set("Asia/Kuala_Lumpur");
															$date=date("Y-m-d H:i:s");

															$selectin = "SELECT * FROM inventory WHERE id = $id ";
															$resultin = $conn->query($selectin);
															while($rowin = $resultin->fetch_assoc()){
																$quanin = $rowin["quantity"];
																}

															if(isset($_POST['sendin'.$id.''])){

															$idd = $_POST['idd'];
															$qty = $_POST['qty'];
															$supplier = $_POST['supplier'];
															$remark = $_POST['remark'];

															$select1 = "SELECT * FROM inventory WHERE id = '$idd' ";
															$result1 = $conn->query($select1);
															while($row1 = $result1->fetch_assoc()){
																$quanin = $row1["quantity"];
																$type = $row1["type"];
																$name = $row1["name"];
																$inventory_id = $row1["inventory_id"];
																$price = $row1["price"];
																$qr = $row1["qr"];
																$branch = $row1["branch"];

																}

															$quantity = $quanin + $qty;

															if($quantity <= 0){
																$status = "No Stock";
															}else if($critical >= $quantity){
																$status = "Critical";
															}else if($min >= $quantity && $critical < $quantity){
																$status = "Minimum";
															}else if($max < $quantity){
																$status = "Maximum";
															}else {
																$status = "Sufficient";
															}

															$query = "UPDATE inventory SET id= '$idd', quantity='$quantity', status='$status' WHERE  id='$idd'  ";

															$res = $conn->query($query);

															$queryin = "INSERT INTO record (type,name,inventory_id,price,quantity,detail,qr,branch,date,supplier,datereceive,remark,user)
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
																	window.location = (\"home.php\")
																	</script>";
																}
															}

															?>


														<div class="modal-body">
															<form action="" method="post">

															<!-- <label></label> -->
															<center><p><i>Quantity Left: <?php echo $quanin; ?></i></p></center>
															<label>Input Quantity</label>
															<p><input class="form-control" name="qty" type="text" value=""></input></p>
															<br>
															<label>Supplier Details</label>
																<p><input class="form-control" name="supplier" type="text" value=""></input></p>
															<br>
															<label>Remark / Comment</label>
																<p><input class="form-control" name="remark" type="text" value=""></input></p>
															<br>
																<p><input class="" name="id" type="hidden" value="<?php echo $id; ?>"></input></p>
															<br>


														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

															<input class="btn btn-success" type="submit" name="send" value="Submit" />
															</form>
														</div>
													</div>
													<!-- /.modal-content -->
												</div>
												<!-- /.modal-dialog -->
											</div>
											<!-- /.modal -->

											<!-- EDIT INVENTORY DETAILS -->
											<div class="modal fade" id="edit<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
															<h4 class="modal-title" id="myModalLabel"><center>Edit Product Details</center></h4>
														</div>

											<?php

											if(isset($_POST['sendedit'.$id.''])){

											$idd = $_POST['idd'];

											$expired =strtotime($_POST['expireddate']);

											$select1 = "SELECT * FROM inventory WHERE id = '$idd' ";
											$result1 = $conn->query($select1);
											while($row1 = $result1->fetch_assoc()){
												$location1 = $row1["location"];
												$sublocation1 = $row1["sublocation"];
												$type1 = $row1["type"];

												}


											$name = $_POST['name'];
											if($_POST['type'] == ''){
												$type = $type1;
											}
											else{
												$type = $_POST['type'];
											}
											$inventory_id = $_POST['inventory_id'];
											$price = $_POST['price'];
											$quantity = $_POST['quantity'];
											$qr="1";
											$branch="1";
											$date=date("Y-m-d H:i:s");
											$critical=$_POST['critical'];
											$minimum=$_POST['minimum'];
											$maximum=$_POST['maximum'];
											if($_POST['location'] == ''){
												$location=$location1;
												$sublocation=$sublocation1;
											}
											else{
												$location=$_POST['location'];
												$sublocation=$_POST['sublocation'];
											}
											$description=$_POST['description'];
											$dateupdate=date("Y-m-d H:i:s");
											$expireddate=date("d-m-Y",$expired);
											$supplier=$_POST['supplier'];
											$batch=$_POST['batch'];

											if($quantity <= 0){
												$status = "No Stock";
											}else if($critical >= $quantity){
												$status = "Critical";
											}else if($minimum >= $quantity && $critical < $quantity){
												$status = "Minimum";
											}else if($maximum < $quantity){
												$status = "Maximum";
											}else {
												$status = "Sufficient";
											}

											$query = "UPDATE inventory SET id= '$id', name='$name', type='$type', inventory_id='$inventory_id', price='$price', quantity='$quantity', qr='$qr', branch='$branch', dateupdate='$dateupdate', critical='$critical', min='$minimum', location='$location', location2='$sublocation', description='$description', status='$status' WHERE  id='$id' ";
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

											?>

											<div class="modal-body">
												<form action="" method="post">

											<label>Type</label>
											<p><select class="form-control" name="type"></p>
											<option value="" selected='selected'><?php echo $type;?></option>
											<?php

											$selecttype = "SELECT * FROM type";
											$resulttype = $conn->query($selecttype);
											while($rowtype = $resulttype->fetch_assoc()){
												$type = $rowtype["type"];

											echo "<option>". $type ."</option>";

											}
											?>
											</select>


										<br>
										<label>Name</label>
											<p><input class="form-control" name="name" type="text" value="<?php echo $name; ?>"></input></p>
										<br>
										<label>Product ID</label>
											<p><input class="form-control" name="inventory_id" type="text" value="<?php echo $inventory_id; ?>"></input></p>
										<br>
										<!-- <label>Price</label>
											<p><input class="form-control" name="price" type="text" value="<?php echo $price; ?>"></input>
										<br> -->
										<label>Quantity</label>
											<p><input class="form-control" name="quantity" type="text" value="<?php echo $quantity; ?>"></input>
										<br>
										<label>Location</label>
											<p><select class="form-control" name="location" id="select3">
											<option value="" selected='selected'><?php echo $location;?></option>
											<?php

											$selectloc = "SELECT * FROM location";
											$resultloc = $conn->query($selectloc);
											while($rowloc = $resultloc->fetch_assoc()){
												$locationloc = $rowloc["location"];

											echo "<option value='". $locationloc ."'>". $locationloc ."</option>";

											}

											?>
											</select>
										<br>
										<label>Sub-Location</label>
											<p><select class="form-control" name="sublocation" id="select4">
											<option value="" selected='selected'><?php echo $location2;?></option>
											<?php

											$selectloc = "SELECT * FROM sublocation";
											$resultloc = $conn->query($selectloc);
											while($rowloc = $resultloc->fetch_assoc()){
											$locationsub = $rowloc["location"];
											$sublocation = $rowloc["sublocation"];

											echo "<option class='". $locationsub ."'>". $sublocation ."</option>";

											}

											?>
											</select></p>
										<br>
										<label>Critical Quantity</label>
											<p><input class="form-control" name="critical" type="text" value="<?php echo $critical; ?>"></input></p>
										<br>
										<label>Minimum Quantity</label>
											<p><input class="form-control" name="minimum" type="text" value="<?php echo $min; ?>"></input></p>
										<br>
										<label>Maximum Quantity</label>
											<p><input class="form-control" name="minimum" type="text" value="<?php echo $max; ?>"></input></p>
										<br>
										<label>Description</label>
											<p><input class="form-control" name="description" type="text" value="<?php echo $description; ?>"></input></p>
										<br>

													<br>

											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

												<input type="submit" class="btn btn-success" name="sendedit<?php echo $id; ?>" value="Save Changes" />
												</form>
											</div>

											</div>
											<!-- /.modal-content -->
										</div>
										<!-- /.modal-dialog -->
									</div>
									<!-- /.modal -->


											<!-- VIEW INVENTORY DETAILS -->
											<div class="modal fade" id="view<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
															<h4 class="modal-title" id="myModalLabel">Product Details</h4>
														</div>
														<div class="modal-body">
															<table style="width:60%" align="center">
																<tr>
																	<td>Name:</td>
															    <th><?php echo $name; ?></th>
																</tr>

																<tr>
																	<td>Product ID:</td>
															    <th><?php echo $inventory_id; ?></th>
																</tr>

																<tr>
																	<td>Product Type:</td>
															    <th><?php echo $type; ?></th>
																</tr>

																<tr>
																	<td>Quantity:</td>
															    <th><?php echo $quantity; ?></th>
																</tr>

																<tr>
																	<td>Maximum Quantity:</td>
															    <th><?php echo $max; ?></th>
																</tr>

																<tr>
																	<td>Minimimum Quantity:</td>
															    <th><?php echo $min; ?></th>
																</tr>

																<tr>
																	<td>Critical Quantity:</td>
															    <th><?php echo $critical; ?></th>
																</tr>

																<tr>
																	<td>Location:</td>
															    <th><?php echo $location2; echo " | "; echo $location; ?></th>
																</tr>

																<tr>
																	<td>Supplier:</td>
															    <th><?php echo $supplier; ?></th>
																</tr>

																<tr>
																	<td>Status:</td>
															    <th><?php echo $alert; ?></th>
																</tr>

															</table>


														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-bg-grey" data-dismiss="modal">Close</button>
														</div>
													</div>
													<!-- /.modal-content -->
												</div>
												<!-- /.modal-dialog -->
											</div>
											<!-- /.modal -->

												</td>
											</tr>
										<?php

										}
										?>
										</tbody>
									</table>
								</div>
                            </div>
                            <!-- /.table-responsive -->
							<br><br>
							<div class="col-lg-1">
								<span class="pull-left"><button class="btn btn-bg-grey" onclick="window.location.href='home.php'">Back</button></span>
							</div>
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
