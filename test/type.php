<?php
session_start();
if(!isset($_SESSION['username'])){
header("type:login.php?type=" . $_SERVER['REQUEST_URI']);
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

if(isset($_POST['send'])){

$idd = $_POST['idd'];
$type = $_POST['type'];

$query = "UPDATE type SET type = '$type' WHERE id='$idd'";
$res = $conn->query($query);

if($res === TRUE){
	echo "<script type = \"text/javascript\">
		alert(\"type Succesfully Edit\");
		window.type = (\"type.php\")
		</script>";
	}

else {
	echo "<script type = \"text/javascript\">
		alert(\"Manager Not Succesfully Edit\");
		window.type = (\"type.php\")
		</script>";
	}
}

//Update Type--------------------------------------------------------------------------------------------------

$select = "SELECT * FROM login WHERE username = '$username' ";
$result = $conn->query($select);
while($row = $result->fetch_assoc()){
	$id = $row["id"];
	$username = $row["username"];
	$secpass = $row["secpass"];
}

if(isset($_POST['updatemain'])){

$idd = $_POST['id'];
$type = $_POST['type'];
$typebase = $_POST['typebase'];

$query = "UPDATE type SET type = '$type' WHERE id='$idd'";
$res = $conn->query($query);

$query1 = "UPDATE subtype SET type = '$type' WHERE type='$typebase'";
$res1 = $conn->query($query1);


}

//Update Sub-Type--------------------------------------------------------------------------------------------------

$select = "SELECT * FROM login WHERE username = '$username' ";
$result = $conn->query($select);
while($row = $result->fetch_assoc()){
	$id = $row["id"];
	$username = $row["username"];
	$secpass = $row["secpass"];
}

if(isset($_POST['updatesub'])){

$idd = $_POST['id'];
$subtype = $_POST['subtype'];
$type = $_POST['type'];

$query = "UPDATE subtype SET subtype = '$subtype' WHERE id='$idd'";
$res = $conn->query($query);


}

//Add Product Type---------------------------------------------------

if(isset($_POST['sendtype'])){

$type = $_POST['type'];
$branch = $_POST['branch'];

$query = "INSERT INTO type (type,branch)
		VALUES ('$type','$branch')";

$res = $conn->query($query);

if($res === TRUE){

	echo "<script type = \"text/javascript\">
		window.type = (\"type.php\")
		</script>";

	}

else {
	echo "<script type = \"text/javascript\">
		alert(\"Inventory Type Not Succesfully Added\");
		window.type = (\"type.php\")
		</script>";
	}

}

//Add SubType--------------------------------------------------------------------------------------------------

if(isset($_POST['addsubtype'])){

$type = $_POST['type'];
$subtype = $_POST['subtype'];
$branch = $_POST['branch'];

$query = "INSERT INTO subtype (type,subtype,branch)
		VALUES ('$type','$subtype','$branch')";

$res = $conn->query($query);

if($res === TRUE){

	echo "<script type = \"text/javascript\">
		window.type = (\"type.php\")
		</script>";

	}

else {
	echo "<script type = \"text/javascript\">
		alert(\"Sub-Type Not Succesfully Added\");
		window.type = (\"type.php\")
		</script>";
	}

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
                    <h3 class="page-header"><center>MANAGE PRODUCT TYPE</center></h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

			<div class="row">
        <div class="col-lg-12">
					<div class="panel panel-primary">
							<div class="panel-heading">
									<p>LIST OF PRODUCT TYPES
										<span class="pull-right">
											<button class="btn btn-success btn-sm" data-toggle="modal" data-placement="bottom" data-target="#TypeModal" title="Add"><i class="fa fa-plus" style="font-size:12px"></i> New Product Type</button>
											<button class="btn btn-default btn-sm" data-toggle="modal" data-placement="bottom" data-target="#SubTypeModal" title="Add"><i class="fa fa-plus" style="font-size:12px"></i> New Sub-Type</button>
										</span>
									</p>
							</div>
					<div class="panel-body">
					<div class="table-responsive">
						<table width="100%" class="table table-striped table-bordered table-hover table-sm" id="table">
							<thead>
								<tr>
								  <th>Product Type Name</th>
								</tr>
							</thead>
							<?php
							$select = "SELECT * FROM type";
							$result = $conn->query($select);
							while($row = $result->fetch_assoc()){
							    $id = $row["id"];
							    $type = $row["type"];
							?>
							<tbody>
								<tr>
									<td>

									<?php echo $type; ?><span class="pull-right">
										<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-placement="bottom" data-target="#view<?php echo $id; ?>" title="View"><i class="fa fa-eye"></i> View Sub-type</button>
										<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-placement="bottom" data-target="#edit<?php echo $id; ?>" title="Edit"><i class="fa fa-edit"></i> Edit</button>
										<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-placement="bottom" data-target="#delete<?php echo $id; ?>" title="Delete"><i class="fa fa-trash-o"></i> Delete</button>
									<!--<div class="modal fade" id="edits<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
													<h4 class="modal-title" id="myModalLabel">Edit Product Type</h4>
												</div>
												<php

												$select1 = "SELECT * FROM type WHERE id='$id'";
												$result1 = $conn->query($select1);
												while($row1 = $result1->fetch_assoc()){
													$id = $row1["id"];
													$type = $row1["type"];
												}
												?>
												<div class="modal-body">
													<form action="" method="post">
														<label>Product Type Name</label>
														<input class="form-control" name="type" type="text" value="<php echo $type; ?>"></input>
														<input class="form-control" name="id" type="hidden" value="<php echo $id; ?>"></input>
														<br>
														<button type="button" class="btn btn-bg-grey" data-dismiss="modal">Close</button>
														<input type="submit" class="btn btn-success pull-right" name="send" value="Save" />
														<br><br>
													</form>
												</div>
												<!-- <div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												</div> ->
											</div>
											<!-- /.modal-content ->
										</div>
										<!-- /.modal-dialog ->
									</div>
									<!-- /.modal -->

									<!-- /.modal -->
									<div class="modal fade" id="edit<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header" style="background-color: lightgrey">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
													<h4 class="modal-title" id="myModalLabel"><center>EDIT PRODUCT TYPE</center></h4>
												</div>
												<?php

												$select1 = "SELECT * FROM type WHERE id='$id'";
												$result1 = $conn->query($select1);
												while($row1 = $result1->fetch_assoc()){
													$id = $row1["id"];
													$type = $row1["type"];

												}
												?>
												<div class="modal-body">
													<form action="" method="post">
														<label>Product Type :</label>
														<input class="form-control" name="type" type="text" value="<?php echo $type; ?>"></input>
														<br>
														<input class="form-control" name="id" type="hidden" value="<?php echo $id; ?>"></input>
														<input class="form-control" name="typebase" type="hidden" value="<?php echo $type; ?>"></input>
														<input type="submit" class="btn btn-success" name="updatemain" value="Edit" />
														<br><br>
													</form>
													<label>Sub-Type(s) :</label>
													<?php

													$selectsub = "SELECT * FROM subtype WHERE type='$type'";
													$resultsub = $conn->query($selectsub);
													while($rowsub = $resultsub->fetch_assoc()){
														$idsub = $rowsub["id"];
														$subtype = $rowsub["subtype"];

													?>
													<form action="" method="post">
														<div class="row">
															<div class="col-lg-10">
																<input class="form-control" name="subtype" type="text" value="<?php echo $subtype; ?>"></input>
																<input class="form-control" name="id" type="hidden" value="<?php echo $idsub; ?>"></input>
																<input class="form-control" name="type" type="hidden" value="<?php echo $type; ?>"></input>
																<input class="form-control" name="typebase" type="hidden" value="<?php echo $type; ?>"></input>
															</div>
															<div class="col-lg-2">
																<input type="submit" class="btn btn-success btn-sm" name="updatesub" value="Edit" />
															</div>
														</div>
														<br>
													</form>
													<?php
													}
													?>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												</div>
											</div>
											<!-- /.modal-content -->
										</div>
										<!-- /.modal-dialog -->
									</div>
									<!-- /.modal -->
									<div class="modal fade" id="view<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header" style="background-color: lightgrey">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
														<h4 class="modal-title" id="myModalLabel"><center>VIEW PRODUCT TYPE DETAILS</center></h4>
												</div>
												<?php

												$select1 = "SELECT * FROM type WHERE id='$id'";
												$result1 = $conn->query($select1);
												while($row1 = $result1->fetch_assoc()){
													$id = $row1["id"];
													$type = $row1["type"];
												}
												?>
												<div class="modal-body">
													<form action="typedelete.php" method="post">
														<label>Product Type :</label>
														<input class="form-control" name="type" type="text" value="<?php echo $type; ?>" disabled></input>
														<input class="form-control" name="id" type="hidden" value="<?php echo $id; ?>"></input>
														<input class="form-control" name="typebase" type="hidden" value="<?php echo $type; ?>"></input>
														<br><br>
													</form>
													<label>Sub-Type(s) :</label>
													<?php

													$selectsub = "SELECT * FROM subtype WHERE type='$type'";
													$resultsub = $conn->query($selectsub);
													while($rowsub = $resultsub->fetch_assoc()){
														$idsub = $rowsub["id"];
														$subtype = $rowsub["subtype"];

													?>
													<form action="typedelete.php" method="post">
														<div class="row">
															<div class="col-lg-12">
																<input class="form-control" name="subtype" type="text" value="<?php echo $subtype; ?>" disabled></input>
																<input class="form-control" name="id" type="hidden" value="<?php echo $idsub; ?>"></input>
																<input class="form-control" name="type" type="hidden" value="<?php echo $type; ?>"></input>
															</div>
														</div>
														<br>
													</form>
													<?php
													}
													?>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												</div>
											</div>
											<!-- /.modal-content -->
										</div>
										<!-- /.modal-dialog -->
									</div>
									<!-- /.modal -->
									<div class="modal fade" id="delete<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header" style="background-color: lightgrey">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
													<h4 class="modal-title" id="myModalLabel"><center>DELETE PRODUCT TYPE</center></h4>
												</div>
												<?php

												$select1 = "SELECT * FROM type WHERE id='$id'";
												$result1 = $conn->query($select1);
												while($row1 = $result1->fetch_assoc()){
													$id = $row1["id"];
													$type = $row1["type"];
												}
												?>
												<div class="modal-body">
													<form action="typedelete.php" method="post">
														<label>Product Type :</label>
														<input class="form-control" name="type" type="text" value="<?php echo $type; ?>"></input>
														<input class="form-control" name="id" type="hidden" value="<?php echo $id; ?>"></input>
														<input class="form-control" name="typebase" type="hidden" value="<?php echo $type; ?>"></input>
														<br>
														<input type="submit" class="btn btn-danger" name="deletetype" value="Delete" />
														<br><br>
													</form>
													<label>Sub-Type(s) :</label>
													<?php

													$selectsub = "SELECT * FROM subtype WHERE type='$type'";
													$resultsub = $conn->query($selectsub);
													while($rowsub = $resultsub->fetch_assoc()){
														$idsub = $rowsub["id"];
														$subtype = $rowsub["subtype"];

													?>
													<form action="typedelete.php" method="post">
														<div class="row">
															<div class="col-lg-10">
																<input class="form-control" name="subtype" type="text" value="<?php echo $subtype; ?>"></input>
																<input class="form-control" name="id" type="hidden" value="<?php echo $idsub; ?>"></input>
																<input class="form-control" name="type" type="hidden" value="<?php echo $type; ?>"></input>
															</div>
															<div class="col-lg-2">
																<input type="submit" class="btn btn-danger btn-sm" name="deletesubtype" value="Delete" />
															</div>
														</div>
														<br>
													</form>
													<?php
													}
													?>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												</div>
											</div>
											<!-- /.modal-content -->
										</div>
										<!-- /.modal-dialog -->
									</div>
									<!-- /.modal -->

									</td>

								</tr>
							</tbody>
							<?php
								}
							?>
						</table>
					</div>
                    <a href="javascript: window.history.go(-1)"><button type="button" class="btn btn-default">Back</button></a>
					<div class="modal fade" id="TypeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header" style="background-color: lightgrey">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title" id="myModalLabel"><center>ADD NEW PRODUCT TYPE<center></h4>
								</div>
								<div class="modal-body">
									<form action="" method="post">
										<label>Name :</label>
										<input class="form-control" name="type" type="text" value=""></input>
										<input class="form-control" name="branch" type="hidden" value="1"></input>
										<br>

								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									<input type="submit" class="btn btn-success" name="sendtype" value="Submit" />
									</form>
								</div>
							</div>
							<!-- /.modal-content -->
						</div>
						<!-- /.modal-dialog -->
					</div>
					<!-- /.modal -->
					<div class="modal fade" id="SubTypeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header" style="background-color: lightgrey">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title" id="myModalLabel"><center>ADD NEW SUB-TYPE</center></h4>
								</div>
								<div class="modal-body">
									<form action="" method="post">
										<label>Product Type :</label>
										<select class="form-control" name="type">
											<option disabled selected>Select Product Type</option>
											<?php
											$select = "SELECT type FROM type";
											$result1 = $conn->query($select);
											while($row = $result1->fetch_assoc()){
												$type=$row['type'];

											echo "<option value='".$type."'>". $type ."</option>";
											// close while loop
											}
											?>
										</select>
										<input class="form-control" name="branch" type="hidden" value="1"></input>
										<br>
										<label>Sub-Type Name :</label>
										<input class="form-control" name="subtype" type="text" value=""></input>
										<input class="form-control" name="branch" type="hidden" value="1"></input>
										<br>

								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

									<input type="submit" class="btn btn-success" name="addsubtype" value="Submit" />
									</form>
								</div>
							</div>
							<!-- /.modal-content -->
						</div>
						<!-- /.modal-dialog -->
					</div>
					<!-- /.modal -->
					<!-- END OF SUBtype MODAL -->
				</div>
				</div>
			</div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    <?php
    include 'include/end.php';
	?>
	<script>
    // tooltip demo
    $('.tooltip').tooltip({
        selector: "[data-toggle=tooltip]",
        container: "body"
    })

    // popover demo
    $("[data-toggle=popover]")
        .popover()
    </script>

</body>

</html>
