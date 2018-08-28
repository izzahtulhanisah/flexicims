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

$idd = $_POST['idd'];
$type = $_POST['type'];

$query = "UPDATE type SET type = '$type' WHERE id='$idd'";
$res = $conn->query($query);

if($res === TRUE){
	echo "<script type = \"text/javascript\">
		alert(\"Location Succesfully Edit\");
		window.location = (\"type.php\")
		</script>";
	}

else {
	echo "<script type = \"text/javascript\">
		alert(\"Manager Not Succesfully Edit\");
		window.location = (\"type.php\")
		</script>";
	}
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
		window.location = (\"type.php\")
		</script>";

	}

else {
	echo "<script type = \"text/javascript\">
		alert(\"Inventory Type Not Succesfully Added\");
		window.location = (\"type.php\")
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
									<button class="btn btn-success pull-right" data-toggle="modal" data-placement="bottom" data-target="#TypeModal" title="Add"><i class="fa fa-plus" style="font-size:12px"></i> New Product Type</button></p>
							</div>
					<div class="panel-body">
					<div class="table-responsive">
						<table width="100%" class="table table-striped table-bordered table-hover table-sm" id="table">
							<thead>
								<tr>
								  <th>Type Name</th>
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
										<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-placement="bottom" data-target="#myModal<?php echo $id; ?>" title="Edit"><i class="fa fa-edit"></i> Edit</button>
										<button type="button" onclick="window.location.href='typedelete.php?id=<?php echo $id; ?>'" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fa fa-trash-o"></i> Delete</button></span>

									<div class="modal fade" id="myModal<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
													<h4 class="modal-title" id="myModalLabel">Edit Product Type</h4>
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
														<label>Product Type Name</label>
														<input class="form-control" name="type" type="text" value="<?php echo $type; ?>"></input>
														<input class="form-control" name="id" type="hidden" value="<?php echo $id; ?>"></input>
														<br>
														<button type="button" class="btn btn-bg-grey" data-dismiss="modal">Close</button>
														<input type="submit" class="btn btn-success pull-right" name="send" value="Save" />
														<br><br>
													</form>
												</div>
												<!-- <div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												</div> -->
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
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title" id="myModalLabel">Add Product Type</h4>
								</div>
								<div class="modal-body">
									<form action="" method="post">
										<label>Product Type Name</label>
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
