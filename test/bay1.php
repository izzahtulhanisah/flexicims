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

$loc = $_REQUEST['location'];
$loc2 = $_REQUEST['location2'];

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

</head>

<body>

	<?php
    include 'include/menu.php';
	?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><center>INVENTORY CONTROL</center></h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			<div class="row">
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
					</div>
					<div class="col-lg-3">
						<select class="form-control" id="select2" name="location2" >
							<option disabled selected>Select Sub-Location..</option>
							<?php

							$selectloc2 = "SELECT location,location2 FROM inventory GROUP BY location,location2";
							$resultloc2 = $conn->query($selectloc2);
							while($rowloc2 = $resultloc2->fetch_assoc()){
								$id = $rowloc2["id"];
								$location = $rowloc2["location"];
								$location2 = $rowloc2["location2"];

							echo "<option class='".$location."'>". $location2 ."</option>";

							}

							?>
						</select>
					</div>
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
					<div class="col-lg-1">
						<input type="submit" value="Confirm" name="send" class="btn btn-primary">
					</div>
					<!-- <div class="col-lg-1">
						<span class="pull-left"><button class="btn btn-danger" onclick="window.location.href='home.php'">Back</button></span>
					</div> -->
				</form>
			</div>
<?php

if(isset($_POST['send'])){

	$loc = $_POST['location'];
	$loc2 = $_POST['location2'];

	echo "<script type = \"text/javascript\">
		window.location = (\"bay1.php?location=". $loc ."&location2=". $loc2 ."\")
		</script>";

}

?>
			<br>
			<br>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Location Selected : <b><?php echo $loc; echo " | "; echo $loc2; ?></b>
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
											<td><b>Price</b></td>
											<td><b>Quantity</b></td>
											<td><b>Location</b></td>
											<!-- <td><b>Location2</b></td>
											<td><b>Date</b></td> -->
											<td><b>Status</b></td>
											<td><b>Action</b></td>
										</tr>
                                    </thead>
                                    <tbody>
									<?php

									include 'config.php';

									$counter = 0;

									$select = "SELECT * FROM inventory WHERE location='$loc' AND location2='$loc2' ORDER BY id DESC ";
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


										$counter++;

									?>
										<tr>
											<td><?php echo $counter; ?></td>
											<td><?php echo $name; ?></td>
											<td><?php echo $inventory_id; ?></td>
											<td><?php echo $type; ?></td>
											<td><?php echo $price; ?></td>
											<td><?php echo $quantity; ?></td>
											<td><?php echo $location2; echo " | "; echo $location; ?></td>
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
											<td>
												<div class="dropdown pull-right">
												<button class="btn btn-default dropdown-toggle btn-sm" type="button" data-toggle="dropdown"><i class="fa fa-list"></i></button>
												  <ul class="dropdown-menu">
													<li><a href="inventoryout.php?id=<?php echo $id; ?>" class="dropdown-item">Outgoing</a></li>
													<li class="divider"></li>
													<li><a href="inventoryin.php?id=<?php echo $id; ?>" class="dropdown-item">Incoming</a></li>
													<li class="divider"></li>
													<li><a href="inventoryview.php?id=<?php echo $id; ?>" class="dropdown-item" >View</a></li>
													<li class="divider"></li>
													<li><a href="inventorydel.php?id=<?php echo $id; ?>" onclick="return confirm('Are you sure you want to delete this?')" class="dropdown-item">Delete</a></li>
												  </center></ul>
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
							<!-- <button class="btn btn-danger" onclick="window.location.href='inventoryadd.php'">ADD</button>
							<button class="btn btn-default" onclick="window.location.href='home.php'">BACK</button> -->

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
