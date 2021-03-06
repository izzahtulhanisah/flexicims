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
                    <h3 class="page-header"><center>USER : <b>STAFF</b></center></h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

			<div class="row">
        <div class="col-lg-12">
					<div class="panel panel-primary">
							<div class="panel-heading">
								<p>ASSIGN STAFF</p>
							</div>
					<div class="panel-body">
					<div class="table-responsive">
						<table width="100%" class="table table-striped table-bordered table-hover table-sm" id="table">
							<thead>
								<tr>
								  <th>Username</th>
								  <th>Manager</th>
								  <th><span class="pull-right">Assign</span></th>
								</tr>
							</thead>
							<?php
							$select1 = "SELECT * FROM login WHERE secpass='3'";
							$result1 = $conn->query($select1);
							while($row1 = $result1->fetch_assoc()){
							    $id = $row1["id"];
							    $username = $row1["username"];
							    $lead_id = $row1["lead_id"];
							?>
							<tbody>
								<tr>
									<td><?php echo $username; ?></td>
									<td>
									<?php
									
									$select2 = "SELECT * FROM login WHERE id='$lead_id'";
									$result2 = $conn->query($select2);
									while($row2 = $result2->fetch_assoc()){
										$namee = $row2["username"];
									}
									
									echo $namee;
									?>
									</td>
									<td>
										<span class="pull-right">
											<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-placement="bottom" data-target="#myModal<?php echo $id; ?>" title="Info"><i class="fa fa-info"></i> Info</button>
											<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-placement="bottom" data-target="#assign<?php echo $id; ?>" title="Assign"><i class="fa fa-info"></i> Assign</button>
										</span>
									</td>

								</tr>
							</tbody>
<div class="modal fade" id="myModal<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Add Type</h4>
			</div>
			<?php

			$select = "SELECT * FROM profile WHERE loginid='$id'";
			$result = $conn->query($select);
			while($row = $result->fetch_assoc()){
				$name = $row["name"];
				$address = $row["address"];
				$email = $row["email"];
				$contact = $row["contact"];
				$position = $row["position"];
			}
			?>
			<div class="modal-body">
				<p>Name: <strong><?php echo $name; ?></strong></p>
				<p>Address: <strong><?php echo $address; ?></strong></p>
				<p>Email: <strong><?php echo $email; ?></strong></p>
				<p>Contact Number: <strong><?php echo $contact; ?></strong></p>
				<p>Position: <strong><?php echo $position; ?></strong></p>
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
<div class="modal fade" id="assign<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Assign Location</h4>
			</div>
			<?php

			if(isset($_POST['assign'.$id.''])){
				
				$assign = $_POST['assign']; 
				$idd = $_POST['idd'];
				
				$query = "UPDATE location SET managerid='$assign' WHERE  id='$idd'  ";
				
				$res = $conn->query($query);
				
			}

			?>
			<div class="modal-body">
				<form method="post" action="">
				<p><strong>Pick location for this manager</strong></p>
				<select class="form-control" name="location">
				<option value="" disabled selected><?php echo $namee;?> (current location)</option>
				<?php

				$selectloc = "SELECT * FROM login WHERE secpass='2'";
				$resultloc = $conn->query($selectloc);
				while($rowloc = $resultloc->fetch_assoc()){
					$manager = $rowloc["username"];

				echo "<option value='". $manager ."'>". $manager ."</option>";

				}

				?>
				</select>	
				<input type="hidden" name="idd" value="<?php echo $id ?>">
			</div>
			<div class="modal-footer">
				<input class="btn btn-success" type="submit" name="assign<?php echo $id; ?>" value="Submit" />
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</form>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
							<?php
								}
							?>
						</table>
					</div>
                    <a href="setting.php"><button type="button" class="btn btn-bg-grey">Back</button></a>
					<a href="staffadd.php"><button type="button" class="btn btn-primary">Add User</button></a>

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
