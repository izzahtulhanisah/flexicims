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
		$('.select1').on("change", function(){
		  var selectedClass = $(this).val(); //store the selected value
		  $('.select2').val("");             //clear the second dropdown selected value

		  //now loop through the 2nd dropdown, hide the unwanted options
		  $('.select2 option').each(function () {
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
                    <h3 class="page-header">ADD NEW PRODUCT</h3>
                </div>
						</div>
                <!-- /.col-lg-12 -->

<?php

date_default_timezone_set("Asia/Kuala_Lumpur");
include "config.php";

if(isset($_POST['send'])){

//$expired =strtotime($_POST['expireddate']);

$name = $_POST['name'];
$type = $_POST['type'];
$subtype = $_POST['subtype'];
$inventory_id = $_POST['inventory_id'];
$quantity = $_POST['quantity'];
$unit = $_POST['unit'];
$qr="1";
$branch="1";
$date=date("Y-m-d H:i:s");
$critical=$_POST['critical'];
$minimum=$_POST['minimum'];
$max=$_POST['max'];
$location=$_POST['location'];
$sublocation=$_POST['sublocation'];
$description=$_POST['description'];
$dateupdate=date("Y-m-d H:i:s");
//$expireddate=date("d-m-Y",$expired);
$supplier=$_POST['supplier'];
$updateby=$userid;

$sel = "SELECT * FROM location WHERE location ='$location' ";
$rslt = $conn->query($sel);
while($rw = $rslt->fetch_assoc()){
	$leadid = $rw['manager_id'];
}

if($quantity <= 0){
	$status = "No Stock";
}else if($critical >= $quantity){
	$status = "Critical";
}else if($minimum >= $quantity && $critical < $quantity){
	$status = "Minimum";
}else if($max < $quantity){
	$status = "Maximum";
}else {
	$status = "Sufficient";
}

$query = "INSERT INTO inventory (type,subtype,name,inventory_id,quantity,unit,qr,branch,date,critical,min,max,location,location2,description,dateupdate,supplier,updateby,status)
		VALUES ('$type','$subtype','$name','$inventory_id','$quantity','$unit','$qr','$branch','$date','$critical','$minimum','$max','$location','$sublocation','$description','$dateupdate','$supplier','$updateby','$status')";
$res = $conn->query($query);

$queryin = "INSERT INTO record (type,subtype,name,inventory_id,quantity,unit,location,sublocation,detail,qr,branch,date,user,leadid)
			VALUES ('$type','$subtype','$name','$inventory_id','$quantity','$unit','$location','$sublocation','Add New Item','$qr','$branch','$date','$userid','$leadid')";

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
		window.location = (\"inventoryadd.php\")
		</script>";
	}


}

//--------------------------------------------------------------------------------------------------

if(isset($_POST['sendloc'])){

$location = $_POST['location'];
$branch = $_POST['branch'];

$query = "INSERT INTO location (location,branch)
		VALUES ('$location','$branch')";

$res = $conn->query($query);

if($res === TRUE){

	echo "<script type = \"text/javascript\">
		window.location = (\"inventoryadd.php\")
		</script>";

	}

else {
	echo "<script type = \"text/javascript\">
		alert(\"Location Not Succesfully Added\");
		window.location = (\"inventoryadd.php\")
		</script>";
	}

}

//--------------------------------------------------------------------------------------------------

if(isset($_POST['sendtype'])){

$type = $_POST['type'];
$branch = $_POST['branch'];

$query = "INSERT INTO type (type,branch)
		VALUES ('$type','$branch')";

$res = $conn->query($query);

if($res === TRUE){

	echo "<script type = \"text/javascript\">
		window.location = (\"inventoryadd.php\")
		</script>";

	}

else {
	echo "<script type = \"text/javascript\">
		alert(\"Inventory Type Not Succesfully Added\");
		window.location = (\"inventoryadd.php\")
		</script>";
	}

}

?>

	<div class="panel panel-success"  style="width: 600px">
    <div class="panel-heading">Add New Product to Inventory</div>
    <div class="panel-body">

				<form action="" method="post">

					<label>Product Name :</label>
					<input class="form-control" name="name" type="text" value=""></input>
					<br>
					<label>Product ID :</label>
					<input class="form-control" name="inventory_id" type="text" value=""></input>
					<br>

					<label>Product Type :</label>
						<select class="form-control select1" name="type" id="select5">
						<option value="" selected disabled>Please Select</option>
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
					<label>Sub-Type :</label>
						<select class="form-control select2" name="subtype" id="select6">
						<option value="" selected disabled>Please Select</option>

						<?php
						$selecttype = "SELECT * FROM subtype";
						$resulttype = $conn->query($selecttype);
						while($rowtype = $resulttype->fetch_assoc()){
							$typesub = $rowtype["type"];
							$subtype = $rowtype["subtype"];
						echo "<option class='". $typesub ."'>". $subtype ."</option>";
						}
						?>

						</select>
					<br>

					<label>Quantity :</label>
					<input class="form-control" name="quantity" type="text" value=""></input>
					<br>
					<label>Unit <i>(pc, kg, litre, others)</i> :</label>
					<select class="form-control" name="unit">
						<option>pc</option>
						<option>kg</option>
						<option>litre</option>
						<option>others</option>
					</select>
					<br>
					<label>Location :</label>
						<select class="form-control" id="select1" name="location" >
						<option disabled selected>Select Location..</option>

						<?php
						if($secpass == '2'){
							$selectloc = "SELECT * FROM location WHERE manager_id = '$userid'";
						}else{
							$selectloc = "SELECT * FROM location";
						}
						$resultloc = $conn->query($selectloc);
						while($rowloc = $resultloc->fetch_assoc()){
							$id = $rowloc["id"];
							$location = $rowloc["location"];
						echo "<option value='". $location ."'>". $location ."</option>";
						}
						?>
						</select>
					<br>
					<label>Sub-Location :</label>
						<select class="form-control" id="select2" name="sublocation" >
						<option disabled selected>Select Sub-Location</option>

						<?php
						$selectsub = "SELECT * FROM sublocation";
						$resultsub = $conn->query($selectsub);
						while($rowsub = $resultsub->fetch_assoc()){
						$id = $rowsub["id"];
						$location = $rowsub["location"];
						$sublocation = $rowsub["sublocation"];
						echo "<option class='".$location."'>". $sublocation ."</option>";
						}
						?>

						</select>
					<br>
					<label>Product Description :</label>
					<input class="form-control" name="description" type="text" value=""></input>
					<br>
					<label>Supplier Details :</label>
					<input class="form-control" name="supplier" type="text" value=""></input>
					<hr>
					<h4><i>Minimum & Maximum Quantity Level Settings</i></h4>
					<br>
					<label>Critical Quantity :</label>
					<input class="form-control" name="critical" type="text" value=""></input>
					<br>
					<label>Minimum Quantity :</label>
					<input class="form-control" name="minimum" type="text" value=""></input>
					<br>
					<label>Maximum Quantity :</label>
					<input class="form-control" name="max" type="text" value=""></input>
					<br>

				<input type="submit" class="btn btn-success pull-right" name="send" value="Submit" />
				<button class="btn btn-default" onclick="window.location.href='home.php'">Back</button>
				<br><br>
				</form>

				</div>
		  </div>



</div>
</div>

 <?php
include 'include/end.php';
?>

</body>

</html>
