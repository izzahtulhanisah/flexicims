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

</head>

<body>

	<?php
    include 'include/menu.php';
	?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Inventory Add</h1>
                </div>
                <!-- /.col-lg-12 -->

<?php

date_default_timezone_set("Asia/Kuala_Lumpur");
include "config.php";

if(isset($_POST['send'])){
	
//$expired =strtotime($_POST['expireddate']);
	
$name = $_POST['name'];
$type = $_POST['type'];
$inventory_id = $_POST['inventory_id'];
$quantity = $_POST['quantity'];
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

$query = "INSERT INTO inventory (type,name,inventory_id,quantity,qr,branch,date,critical,min,max,location,location2,description,dateupdate,supplier,updateby,status) 
		VALUES ('$type','$name','$inventory_id','$quantity','$qr','$branch','$date','$critical','$minimum','$max','$location','$sublocation','$description','$dateupdate','$supplier','$updateby','$status')";
$res = $conn->query($query);

$queryin = "INSERT INTO record (type,name,inventory_id,quantity,detail,qr,branch,date,user) 
			VALUES ('$type','$name','$inventory_id','$quantity','Add New Item','$qr','$branch','$date','$userid')";
			
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


<form action="" method="post">

<label>Type</label>
<select class="form-control" name="type">
<option disabled selected>Select Location..</option>
<?php

$selecttype = "SELECT * FROM type";						
$resulttype = $conn->query($selecttype);
while($rowtype = $resulttype->fetch_assoc()){
	$id = $rowtype["id"];
	$type = $rowtype["type"];

echo "<option>". $type ."</option>";

}

?>
</select>
<br>
<a href = "#" class="btn btn-success" data-toggle="modal" data-target="#TypeModal"><i class="fa fa-plus-square"></i></a>
<br>
<br>
<label>Name</label>
<input class="form-control" name="name" type="text" value=""></input>
<br>
<label>Inventory ID</label>
<input class="form-control" name="inventory_id" type="text" value=""></input>
<br>
<label>Quantity</label>
<input class="form-control" name="quantity" type="text" value=""></input>
<br>
<label>Location</label>
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
<br>
<label>Sub-Location</label>
<select class="form-control" id="select2" name="sublocation" >
<option disabled selected>Select Sub-Location..</option>
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
<a href = "#" class="btn btn-success" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-square"></i></a>
<br>
<br>
<label>Critical</label>
<input class="form-control" name="critical" type="text" value=""></input>
<br>
<label>Minimum</label>
<input class="form-control" name="minimum" type="text" value=""></input>
<br>
<label>Maximum</label>
<input class="form-control" name="max" type="text" value=""></input>
<br>
<label>Description</label>
<input class="form-control" name="description" type="text" value=""></input>
<br>
<label>Supplier</label>
<input class="form-control" name="supplier" type="text" value=""></input>
<br>
<input type="submit" class="btn btn-primary" name="send" value="Enter" />
<button class="btn btn-danger" onclick="window.location.href='home.php'">Back</button>
<br><br>
</form>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Add Location</h4>
			</div>
			<div class="modal-body">
				<form action="" method="post">
					<label>Location</label>
					<input class="form-control" name="location" type="text" value=""></input>
					<input class="form-control" name="branch" type="hidden" value="1"></input>
					<br>
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

				<input type="submit" class="btn btn-primary" name="sendloc" value="Enter" />
				</form>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="TypeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Add Type</h4>
			</div>
			<div class="modal-body">
				<form action="" method="post">
					<label>Location</label>
					<input class="form-control" name="type" type="text" value=""></input>
					<input class="form-control" name="branch" type="hidden" value="1"></input>
					<br>
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

				<input type="submit" class="btn btn-primary" name="sendtype" value="Enter" />
				</form>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

</div>
</div>

 <?php
include 'include/end.php';
?>

</body>

</html>