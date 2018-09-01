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

if(isset($_POST['send'])){

$idd = $_POST['id'];
$location = $_POST['location'];

$query = "UPDATE location SET location = '$location' WHERE id='$idd'";
$res = $conn->query($query);


}

//Update Location--------------------------------------------------------------------------------------------------

$select = "SELECT * FROM login WHERE username = '$username' ";
$result = $conn->query($select);
while($row = $result->fetch_assoc()){
	$id = $row["id"];
	$username = $row["username"];
	$secpass = $row["secpass"];
}

if(isset($_POST['updatemain'])){

$idd = $_POST['id'];
$location = $_POST['location'];
$locationbase = $_POST['locationbase'];

if(isset($_POST['managerid'])){	
	$managerid = $_POST['managerid'];
	$query = "UPDATE location SET location = '$location', manager_id = '$managerid' WHERE id='$idd'";
}
else{
	$query = "UPDATE location SET location = '$location' WHERE id='$idd'";
}

$res = $conn->query($query);

$query1 = "UPDATE sublocation SET location = '$location' WHERE location='$locationbase'";
$res1 = $conn->query($query1);


}

//Update Sub-Location--------------------------------------------------------------------------------------------------

$select = "SELECT * FROM login WHERE username = '$username' ";
$result = $conn->query($select);
while($row = $result->fetch_assoc()){
	$id = $row["id"];
	$username = $row["username"];
	$secpass = $row["secpass"];
}

if(isset($_POST['updatesub'])){

$idd = $_POST['id'];
$sublocation = $_POST['sublocation'];
$location = $_POST['location'];

$query = "UPDATE sublocation SET sublocation = '$sublocation' WHERE id='$idd'";
$res = $conn->query($query);


}

//Add Location--------------------------------------------------------------------------------------------------

if(isset($_POST['sendloc'])){

$location = $_POST['location'];
$branch = $_POST['branch'];

$query = "INSERT INTO location (location,branch)
		VALUES ('$location','$branch')";

$res = $conn->query($query);

if($res === TRUE){

	echo "<script type = \"text/javascript\">
		window.location = (\"location.php\")
		</script>";

	}

else {
	echo "<script type = \"text/javascript\">
		alert(\"Location Not Succesfully Added\");
		window.location = (\"location.php\")
		</script>";
	}

}

//Add SubLocation--------------------------------------------------------------------------------------------------

if(isset($_POST['addsubloc'])){

$location = $_POST['location'];
$sublocation = $_POST['sublocation'];
$branch = $_POST['branch'];

$query = "INSERT INTO sublocation (location,sublocation,branch)
		VALUES ('$location','$sublocation','$branch')";

$res = $conn->query($query);

if($res === TRUE){

	echo "<script type = \"text/javascript\">
		window.location = (\"location.php\")
		</script>";

	}

else {
	echo "<script type = \"text/javascript\">
		alert(\"Sub-Location Not Succesfully Added\");
		window.location = (\"location.php\")
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
                    <h3 class="page-header"><center>MANAGE LOCATION</center></h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

			<div class="row">
      	<div class="col-lg-12">
					<div class="panel panel-primary">
							<div class="panel-heading">
									<p>LIST OF INVENTORY LOCATIONS
										<span class="pull-right">
											<button class="btn btn-success btn-sm" data-toggle="modal" data-placement="bottom" data-target="#add" title="Add"><i class="fa fa-plus"></i> New Location</button>
											<button class="btn btn-default btn-sm" data-toggle="modal" data-placement="bottom" data-target="#addsub" title="Add Sub-Location"><i class="fa fa-plus"></i> New Sub-Location</button>
										</span>
									</p>
							</div>

					<div class="panel-body">
					<div class="table-responsive">
						<table width="100%" class="table table-striped table-bordered table-hover table-sm" id="table">
							<thead>
								<tr>
								  <th>Location Name</th>
									<!-- <th>Action</th> -->
								</tr>
							</thead>
							<?php
							$select = "SELECT * FROM location";
							$result = $conn->query($select);
							while($row = $result->fetch_assoc()){
							    $id = $row["id"];
							    $location = $row["location"];
							?>
							<tbody>
								<tr>
									<td>

									<?php echo $location; ?><span class="pull-right">
										<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-placement="bottom" data-target="#view<?php echo $id; ?>" title="View"><i class="fa fa-info-circle"></i> View Sub-location</button>
										<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-placement="bottom" data-target="#edit<?php echo $id; ?>" title="Edit"><i class="fa fa-edit"></i> Edit</button>
										<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-placement="bottom" data-target="#delete<?php echo $id; ?>" title="Delete"><i class="fa fa-trash-o"></i> Delete</button>
										</span>
									</td>
									<div class="modal fade" id="edit<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header" style="background-color: lightgrey">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
													<h4 class="modal-title" id="myModalLabel"><center>EDIT LOCATION DETAILS</center></h4>
												</div>
												<?php

												$select1 = "SELECT * FROM location WHERE id='$id'";
												$result1 = $conn->query($select1);
												while($row1 = $result1->fetch_assoc()){
													$id = $row1["id"];
													$location = $row1["location"];
													$managerid = $row1["manager_id"];

												}
												?>
												<div class="modal-body">
													<form action="" method="post">
														<label>Location :</label>
														<input class="form-control" name="location" type="text" value="<?php echo $location; ?>"></input>
														<?php
														if($secpass <= 1){

															$selectus = "SELECT * FROM login WHERE id='$managerid'";
															$resultus = $conn->query($selectus);
															while($rowus = $resultus->fetch_assoc()){

																$user = $rowus["username"];
															}

														?>

														<br>
														<label>Manager (Person-In-Charge) :</label>
														<select class="form-control" name="managerid">
														<option value="<?php echo $user;?>" disabled selected><?php echo $user;?> (current manager)</option>
														<?php

														$selectloc = "SELECT * FROM login WHERE secpass='2'";
														$resultloc = $conn->query($selectloc);
														while($rowloc = $resultloc->fetch_assoc()){
															$manager = $rowloc["username"];
															$idmanager = $rowloc["id"];

														echo "<option value='". $idmanager ."'>". $manager ."</option>";

														}

														?>
														</select>
														<?php
														}elseif($secpass >= 2){}else{}
														?>
														<input class="form-control" name="id" type="hidden" value="<?php echo $id; ?>"></input>
														<input class="form-control" name="locationbase" type="hidden" value="<?php echo $location; ?>"></input>
														<br>
														<input type="submit" class="btn btn-success" name="updatemain" value="Edit" />
														<br>
													</form>
													<hr>
													<label>Sub-Location(s) :</label>
													<?php

													$selectsub = "SELECT * FROM sublocation WHERE location='$location'";
													$resultsub = $conn->query($selectsub);
													while($rowsub = $resultsub->fetch_assoc()){
														$idsub = $rowsub["id"];
														$sublocation = $rowsub["sublocation"];

													?>
													<form action="" method="post">
														<div class="row">
															<div class="col-lg-10">
																<input class="form-control" name="sublocation" type="text" value="<?php echo $sublocation; ?>"></input>
																<input class="form-control" name="id" type="hidden" value="<?php echo $idsub; ?>"></input>
																<input class="form-control" name="location" type="hidden" value="<?php echo $location; ?>"></input>
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
									<div class="modal fade" id="delete<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header" style="background-color: lightgrey">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
													<h4 class="modal-title" id="myModalLabel"><center>DELETE LOCATION</center></h4>
												</div>
												<?php

												$select1 = "SELECT * FROM location WHERE id='$id'";
												$result1 = $conn->query($select1);
												while($row1 = $result1->fetch_assoc()){
													$id = $row1["id"];
													$location = $row1["location"];
												}
												?>
												<div class="modal-body">
													<form action="locationdelete.php" method="post">
														<label>Location :</label>
														<input class="form-control" name="location" type="text" value="<?php echo $location; ?>"></input>
														<input class="form-control" name="id" type="hidden" value="<?php echo $id; ?>"></input>
														<input class="form-control" name="locationbase" type="hidden" value="<?php echo $location; ?>"></input>
														<br>
														<input type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete the location/sublocation?')" name="delloc" value="Delete" />
														<br><br>
													</form>
													<label>Sub-Location(s) :</label>
													<?php

													$selectsub = "SELECT * FROM sublocation WHERE location='$location'";
													$resultsub = $conn->query($selectsub);
													while($rowsub = $resultsub->fetch_assoc()){
														$idsub = $rowsub["id"];
														$sublocation = $rowsub["sublocation"];

													?>
													<form action="locationdelete.php" method="post">
														<div class="row">
															<div class="col-lg-10">
																<input class="form-control" name="sublocation" type="text" value="<?php echo $sublocation; ?>"></input>
																<input class="form-control" name="id" type="hidden" value="<?php echo $idsub; ?>"></input>
																<input class="form-control" name="location" type="hidden" value="<?php echo $location; ?>"></input>
															</div>
															<div class="col-lg-2">
																<input type="submit" onclick="return confirm('Are you sure you want to delete the location/sublocation?')" class="btn btn-danger btn-sm" name="delsubloc" value="Delete" />
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
													<h4 class="modal-title" id="myModalLabel"><center>VIEW LOCATION DETAILS</center></h4>
												</div>
												<?php

												$select1 = "SELECT * FROM location WHERE id='$id'";
												$result1 = $conn->query($select1);
												while($row1 = $result1->fetch_assoc()){
													$id = $row1["id"];
													$location = $row1["location"];
												}
												?>
												<div class="modal-body">
													<form action="locationdelete.php" method="post">
														<label>Location :</label>
														<input class="form-control" name="location" type="text" value="<?php echo $location; ?>" disabled></input>
														<input class="form-control" name="id" type="hidden" value="<?php echo $id; ?>"></input>
														<input class="form-control" name="locationbase" type="hidden" value="<?php echo $location; ?>"></input>
														<hr>
													</form>
													<label>Sub-Location(s) :</label>
													<?php

													$selectsub = "SELECT * FROM sublocation WHERE location='$location'";
													$resultsub = $conn->query($selectsub);
													while($rowsub = $resultsub->fetch_assoc()){
														$idsub = $rowsub["id"];
														$sublocation = $rowsub["sublocation"];

													?>
													<form action="locationdelete.php" method="post">
														<div class="row">
															<div class="col-lg-12">
																<input class="form-control" name="sublocation" type="text" value="<?php echo $sublocation; ?>" disabled></input>
																<input class="form-control" name="id" type="hidden" value="<?php echo $idsub; ?>"></input>
																<input class="form-control" name="location" type="hidden" value="<?php echo $location; ?>"></input>
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


									<!-- <td>
										<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-placement="bottom" data-target="#myModal<?php echo $id; ?>" title="Edit"><i class="fa fa-edit"></i> Edit</button>
										<button type="button" onclick="window.location.href='locationdelete.php?id=<?php echo $id; ?>'" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fa fa-trash-o"></i> Delete</button></span>
									</td> -->

								</tr>
							</tbody>
							<?php
								}
							?>
						</table>
					</div>
						<!-- <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-placement="bottom" data-target="#add" title="Add"><i class="fa fa-plus"></i> Add</button> -->
                    <a href="javascript: window.history.go(-1)"><button type="button" class="btn btn-default">Back</button></a>

						<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header" style="background-color: lightgrey">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h4 class="modal-title" id="myModalLabel"><center>ADD NEW LOCATION</center></h4>
									</div>
									<div class="modal-body">
										<form action="" method="post">
											<label>Location Name</label>
											<input class="form-control" name="location" type="text" value=""></input>
											<input class="form-control" name="branch" type="hidden" value="1"></input>
											<br>

									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

										<input type="submit" class="btn btn-success" name="sendloc"  onclick="return confirm('Are you sure you want to Add the location/sublocation?')" value="Submit" />
										</form>
									</div>
								</div>
								<!-- /.modal-content -->
							</div>
							<!-- /.modal-dialog -->
						</div>
						<!-- START OF SUBLOCATION MODAL -->
					<!-- /.modal -->
					<div class="modal fade" id="addsub" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header" style="background-color: lightgrey">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title" id="myModalLabel"><center>ADD SUB-LOCATION</center></h4>
								</div>
								<div class="modal-body">
									<form action="" method="post">
										<label>Location</label>
										<select class="form-control" name="location">
											<option disabled selected>Select Location..</option>
											<?php
											$select = "SELECT location FROM location";
											$result1 = $conn->query($select);
											while($row = $result1->fetch_assoc()){
												$location=$row['location'];

											echo "<option value='".$location."'>". $location ."</option>";
											// close while loop
											}
											?>
										</select>
										<input class="form-control" name="branch" type="hidden" value="1"></input>
										<br>
										<label>Sub-Location</label>
										<input class="form-control" name="sublocation" type="text" value=""></input>
										<input class="form-control" name="branch" type="hidden" value="1"></input>
										<br>

								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

									<input type="submit" class="btn btn-success" name="addsubloc" onclick="return confirm('Are you sure you want to Add the location/sublocation?')" value="Submit" />
									</form>
								</div>
							</div>
							<!-- /.modal-content -->
						</div>
						<!-- /.modal-dialog -->
					</div>
					<!-- /.modal -->
					<!-- END OF SUBLOCATION MODAL -->

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
