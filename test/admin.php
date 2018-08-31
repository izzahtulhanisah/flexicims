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
                    <h3 class="page-header"><center>USER : <b>ADMIN</b></center></h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

			<div class="row">
        <div class="col-lg-12">
					<div class="panel panel-primary">
							<div class="panel-heading">
									<p>LIST OF ADMINS
									<button class="btn btn-success btn-sm pull-right" onclick="window.location.href='adminadd.php'"><i class="fa fa-plus" style="font-size:12px"></i> New User</button></p>
							</div>

					<div class="panel-body">
					<div class="table-responsive">
						<table width="100%" class="table table-striped table-bordered table-hover table-sm" id="table">
							<thead>
								<tr>
								  <th>Username</th>
								</tr>
							</thead>
							<?php
							$select1 = "SELECT * FROM login WHERE secpass='0'";
							$result1 = $conn->query($select1);
							while($row1 = $result1->fetch_assoc()){
							    $id = $row1["id"];
							    $username = $row1["username"];
							?>
							<tbody>
								<tr>
									<td><?php echo $username; ?><span class="pull-right">
										<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-placement="bottom" data-target="#myModal<?php echo $id; ?>" title="Info"><i class="fa fa-info-circle"></i> Details</button>
										<button type="button" onclick="window.location.href='adminedit.php?loginid=<?php echo $id; ?>'" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fa fa-edit"></i> Edit</button>
										<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-placement="bottom" data-target="#myModal<?php echo $id; ?>" title="Delete"><i class="fa fa-remove"></i> Delete</button></span></td>

								</tr>
							</tbody>
<div class="modal fade" id="myModal<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">View Admin Details</h4>
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
							<?php
								}
							?>
						</table>
					</div>
                    <a href="userprofile.php"><button type="button" class="btn btn-bg-grey">Back</button></a>
                    <!-- <a href="adminadd.php"><button type="button" class="btn btn-primary">Add User</button></a> -->
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
