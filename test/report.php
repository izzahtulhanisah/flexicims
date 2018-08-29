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
                    <h1 class="page-header">Incoming</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
					<?php
					$todaydate=date("Y-m-d");
					$before30=date('Y-m-d', strtotime("-30 days"));
					?>
					<div class="row">						
						<form action="reportform.php" method="post" name="report_card" id="form_id" target="myNewWinsr">
							<div class="row">
								<div class="col-lg-8">
									<label>Activity</label>
									<select class="form-control" name="activity" >
										<option disabled selected>Select..</option>
										<option value="All">All</option>
										<option value="Incoming">Incoming</option>
										<option value="Outgoing">Outgoing</option>
									</select>
								</div>
							</div>
							<br>
							<label>Location</label>
								<br>
							<div class="row">								
								<div class="col-lg-4">
									<select class="form-control" id="select1" name="location">
										<option disabled selected>Select Location..</option>
										<option value ="" ></option>
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
								<div class="col-lg-4">
									<select class="form-control" id="select2" name="sublocation" >
										<option disabled selected>Select Sub-location..</option>
										<option value ="" ></option>
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
							</div>
							<br>
							<!-- <div class="row">
								<div class="col-lg-8">
									<label>Type</label>
									<select class="form-control" name="type" >
										<option disabled selected>Select Type..</option>
										<php
										
										$selectloc2 = "SELECT * FROM type";						
										$resultloc2 = $conn->query($selectloc2);
										while($rowloc2 = $resultloc2->fetch_assoc()){
											$id = $rowloc2["id"];
											$type = $rowloc2["type"];
										
										echo "<option>". $type ."</option>";
										
										}
										
										?>
									</select>
								</div>
							</div>
							<br> -->
							<div class="row">							
								<div class="col-lg-4">
									<label>From : </label>
									<input class="form-control" name="salesfrom" type="date" value="<?php echo $before30 ?>" id="to_sales_date" />
								</div>
								<div class="col-lg-4">
									<label>To : </label>
									<input class="form-control" name="salesto" value="<?php echo $todaydate ?>" type="date" id="to_sales_date" />
								</div>							
							</div>
							<br>
							<div class="row">
								<div class="col-lg-12 col-xs-12">
									<input class="btn btn-primary" type="submit" value="Generate Report" />
								</div>
							</div>
						</form>							
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

</body>

</html>