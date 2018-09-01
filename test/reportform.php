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

<style>
.button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 10px 26px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 24px;
    margin: 4px 2px;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
    cursor: pointer;
}

.button1 {
    background-color: white; 
    color: black; 
    border: 2px solid #4CAF50;
}
.button1:hover {
    background-color: #4CAF50;
    color: white;
}

.button2 {
    background-color: white; 
    color: black; 
    border: 2px solid #008CBA;
}
.button2:hover {
    background-color: #008CBA;
    color: white;
}

.button3 {
    background-color: white; 
    color: black; 
    border: 2px solid #f44336;
}
.button3:hover {
    background-color: #f44336;
    color: white;
}

.button4 {
    background-color: white;
    color: black;
    border: 2px solid #e7e7e7;
}
.button4:hover {background-color: #e7e7e7;}

.button5 {
    background-color: white;
    color: black;
    border: 2px solid #555555;
}
.button5:hover {
    background-color: #555555;
    color: white;
}
</style>

<?php
include 'config.php';

$selected_date = $_POST['salesfrom'];
$selected_date = strtotime($selected_date);
$mysqldate = date('Y-m-d H:i:s', $selected_date);
$mysqldatee = date('d M Y', $selected_date);
$fromdate = $mysqldate;
$fromdate1 = $mysqldatee;

$selected_date1 = $_POST['salesto'];
$selected_date1 = strtotime($selected_date1);
$mysqldate1 = date('Y-m-d H:i:s', $selected_date1);
$mysqldatee1 = date('d M Y', $selected_date1);
$todate = $mysqldate1;
$todate1 = $mysqldatee1;

$activity = $_POST['activity'];

?>

<head>
<?php

include 'include/head.php';


?>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	
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

<style>

@media print {
    h1 {page-break-before: always;}
	
	footer {page-break-after: always;}
	
	#printPageButton {
    display: none;
  }
	
	
}

#box {
    background: #73AD21;       
}


tr{
height :1px;
font-size: small;
margin: 0 0 0 0;
}

.yunyun{
	max-width:800px;
	margin:auto;
	padding:30px;
	border:1px solid #eee;
	box-shadow:0 0 10px rgba(0, 0, 0, .15);
	font-size:12px;
	line-height:24px;
	font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
	color:#555;
}

 
body {
  -webkit-print-color-adjust: exact;
}
	

</style>

<script>
function printContent(el){
    var restorepage = document.body.innerHTML;
    var printcontent = document.getElementById(el).innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    document.body.innerHTML = restorepage;
}
</script>

<script type="text/javascript">
  google.charts.load('current', {'packages':['bar']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Type', 'Incoming', 'Outgoing'],
     

<?php

// Fetch the data


$query= "SELECT type, (CASE WHEN detail = 'Incoming' THEN SUM(quantity) ELSE 0 END) AS incoming, (CASE WHEN detail = 'Outgoing' THEN SUM(quantity) ELSE 0 END) AS outgoing FROM record GROUP BY type";
  
$result = $conn->query($query);

// All good?
if ( !$result ) {
  // Nope
  $message  = 'Invalid query: ' . mysqli_error($conn) . "\n";
  $message .= 'Whole query: ' . $query;
  die( $message );
}

while ( $row = mysqli_fetch_assoc($result) ) {
echo "['" . $row['type'] . "', '" . $row['incoming'] . "', '" . $row['outgoing'] . "'],";
}
?>	  
  
   ]);
  
    var options = {
      chart: {
        title: 'Outgoing & Incoming Based on Type',
        subtitle: 'Outgoing & Incoming',
      },
      vAxis: {format: 'decimal'},
      bars: 'vertical' // Required for Material Bar Charts.
    };

    var chart = new google.charts.Bar(document.getElementById('barchart_material'));

    chart.draw(data, google.charts.Bar.convertOptions(options));
  }
</script>
	
</head>

<body>
    <br>
    <button style="float: right"; class="button button2" onclick="printContent('div1')">Print</button>

<br><br>
<div class="yunyun" id="div1">
	<div class="container-fluid">
	
			<h1 class="page-header">REPORT</h1>
			<div class="row">
				<div class="col-xs-12 col-md-12">
					<strong>From : <?php echo $fromdate1; ?></strong>
				
					<strong style="float: right";>To : <?php echo $todate1; ?></strong>
				</div>
				<br><br>
			</div>
			<!-- <center><div id="barchart_material" style="width: 500px; height: 400px;"></div></center> -->
			<?php
			if($activity == 'Incoming'){
			?>
			<div class="row">
				<div class="col-lg-12">
					<div class="panel-heading">
						Record Of Incoming Stock:
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="table-responsive">
						<table width="100%" class="table table-striped table-bordered table-hover table-sm" id="table">
							<thead>
								<tr class="success">
									<td>No.</td>
									<td>Type</td>
									<td>Inventory Name</td>
									<td>Inventory ID</td>
									<td>Quantity</td>
									<td>Detail</td>
									<td>Date</td>
									<td>User</td>
								</tr>
							</thead>
							<?php

							include 'config.php';
							
							if($_POST['location'] != ""){
								$location = "AND location = '". $_POST['location']."'";
							}else{
								$location = "";
							}

							if($_POST['sublocation'] != ""){
								$sublocation = "AND sublocation = '". $_POST['sublocation']."'";
							}else{
								$sublocation = "";
							}
							
							if($_POST['type'] != ""){
								$type = "AND type = '". $_POST['type']."'";
							}else{
								$type = "";
							}

							if($_POST['subtype'] != ""){
								$subtype = "AND subtype = '". $_POST['subtype']."'";
							}else{
								$subtype = "";
							}
							
							$counter = 0;

							$select = "SELECT r.* , l.username FROM record as r INNER JOIN login as l ON r.user = l.id WHERE DATE(date) BETWEEN '$fromdate' AND '$todate' ". $location ." ". $sublocation ." ". $type ." ". $subtype ." AND detail='Incoming' ORDER BY detail DESC ";
							
							$result = $conn->query($select);
							while($row = $result->fetch_assoc()){
								$id = $row["id"];
								$type = $row["type"];
								$name = $row["name"];
								$inventory_id = $row["inventory_id"];
								$price = $row["price"];
								$quantity = $row["quantity"];
								$detail = $row["detail"];
								$qr = $row["qr"];
								$branch = $row["branch"];
								$date = $row["date"];
								$username = $row["username"];
								
								$counter++;

							?>
								<tr>
									<td><?php echo $counter; ?></td>
									<td><?php echo $type; ?></td>
									<td><?php echo $name; ?></td>
									<td><?php echo $inventory_id; ?></td>
									<td><?php echo $quantity; ?></td>
									<td><?php echo $detail; ?></td>
									<td><?php echo $date; ?></td>
									<td><?php echo $username; ?></td>
								</tr>
							<?php
							}
							?>
						</table>
					</div>
				</div>
			</div>
			<footer></footer>
			<?php
			}
			elseif($activity == 'Outgoing'){
			?>
			<div class="row">
				<div class="col-lg-12">
					<div class="panel-heading">
						Record Of Outgoing Stock:
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="table-responsive">
						<table width="100%" class="table table-striped table-bordered table-hover table-sm" id="table">
							<thead>
								<tr class="success">
									<td>No.</td>
									<td>Type</td>
									<td>Inventory Name</td>
									<td>Inventory ID</td>
									<td>Quantity</td>
									<td>Detail</td>
									<td>Date</td>
									<td>User</td>
								</tr>
							</thead>
							<?php

							include 'config.php';
							$counter = 0;
							
							if($_POST['location'] != ""){
								$location = "AND location = '". $_POST['location']."'";
							}else{
								$location = "";
							}

							if($_POST['sublocation'] != ""){
								$sublocation = "AND sublocation = '". $_POST['sublocation']."'";
							}else{
								$sublocation = "";
							}
							
							if($_POST['type'] != ""){
								$type = "AND type = '". $_POST['type']."'";
							}else{
								$type = "";
							}

							if($_POST['subtype'] != ""){
								$subtype = "AND subtype = '". $_POST['subtype']."'";
							}else{
								$subtype = "";
							}

							$select = "SELECT r.* , l.username FROM record as r INNER JOIN login as l ON r.user = l.id WHERE DATE(date) BETWEEN '$fromdate' AND '$todate' ". $location ." ". $sublocation ." ". $type ." ". $subtype ." AND detail='Outgoing' ORDER BY detail DESC ";	
							$result = $conn->query($select);
							while($row = $result->fetch_assoc()){
								$id = $row["id"];
								$type = $row["type"];
								$name = $row["name"];
								$inventory_id = $row["inventory_id"];
								$price = $row["price"];
								$quantity = $row["quantity"];
								$detail = $row["detail"];
								$qr = $row["qr"];
								$branch = $row["branch"];
								$date = $row["date"];
								$username = $row["username"];
								
								$counter++;

							?>
								<tr>
									<td><?php echo $counter; ?></td>
									<td><?php echo $type; ?></td>
									<td><?php echo $name; ?></td>
									<td><?php echo $inventory_id; ?></td>
									<td><?php echo $quantity; ?></td>
									<td><?php echo $detail; ?></td>
									<td><?php echo $date; ?></td>
									<td><?php echo $username; ?></td>
								</tr>
							<?php
							}
							?>
						</table>
					</div>
				</div>
			</div>
			<footer></footer>
			<?php
			}
			elseif($activity == 'All'){
			?>
			<div class="row">
				<div class="col-lg-12">
					<div class="panel-heading">
						Record Of All Stock:
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="table-responsive">
						<table width="100%" class="table table-striped table-bordered table-hover table-sm" id="table">
							<thead>
								<tr class="success">
									<td>No.</td>
									<td>Type</td>
									<td>Inventory Name</td>
									<td>Inventory ID</td>
									<td>Quantity</td>
									<td>Detail</td>
									<td>Date</td>
									<td>User</td>
								</tr>
							</thead>
							<?php

							include 'config.php';
							$counter = 0;
							
							if($_POST['location'] != ""){
								$location = "AND location = '". $_POST['location']."'";
							}else{
								$location = "";
							}

							if($_POST['sublocation'] != ""){
								$sublocation = "AND sublocation = '". $_POST['sublocation']."'";
							}else{
								$sublocation = "";
							}
							
							if($_POST['type'] != ""){
								$type = "AND type = '". $_POST['type']."'";
							}else{
								$type = "";
							}

							if($_POST['subtype'] != ""){
								$subtype = "AND subtype = '". $_POST['subtype']."'";
							}else{
								$subtype = "";
							}

							$select = "SELECT r.* , l.username FROM record as r INNER JOIN login as l ON r.user = l.id WHERE DATE(date) BETWEEN '$fromdate' AND '$todate' ". $location ." ". $sublocation ." ". $type ." ". $subtype ." AND 1 ORDER BY detail DESC ";
							$result = $conn->query($select);
							while($row = $result->fetch_assoc()){
								$id = $row["id"];
								$type = $row["type"];
								$name = $row["name"];
								$inventory_id = $row["inventory_id"];
								$price = $row["price"];
								$quantity = $row["quantity"];
								$detail = $row["detail"];
								$qr = $row["qr"];
								$branch = $row["branch"];
								$date = $row["date"];
								$username = $row["username"];
								
								$counter++;

							?>
								<tr>
									<td><?php echo $counter; ?></td>
									<td><?php echo $type; ?></td>
									<td><?php echo $name; ?></td>
									<td><?php echo $inventory_id; ?></td>
									<td><?php echo $quantity; ?></td>
									<td><?php echo $detail; ?></td>
									<td><?php echo $date; ?></td>
									<td><?php echo $username; ?></td>
								</tr>
							<?php
							}
							?>
						</table>
					</div>
				</div>
			</div>
			<footer></footer>
			<?php
			}
			else{
			?>
			<div class="row">
				<div class="col-lg-12">
					<div class="panel-heading">
						Record Of All Stock:
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="table-responsive">
						<table width="100%" class="table table-striped table-bordered table-hover table-sm" id="table">
							<thead>
								<tr class="success">
									<td>No.</td>
									<td>Type</td>
									<td>Inventory Name</td>
									<td>Inventory ID</td>
									<td>Quantity</td>
									<td>Detail</td>
									<td>Date</td>
									<td>User</td>
								</tr>
							</thead>
							<?php

							include 'config.php';
							$counter = 0;

							$select = "SELECT r.* , l.username FROM record as r INNER JOIN login as l ON r.user = l.id WHERE DATE(date) BETWEEN '$fromdate' AND '$todate' ORDER BY detail DESC ";
							$result = $conn->query($select);
							while($row = $result->fetch_assoc()){
								$id = $row["id"];
								$type = $row["type"];
								$name = $row["name"];
								$inventory_id = $row["inventory_id"];
								$price = $row["price"];
								$quantity = $row["quantity"];
								$detail = $row["detail"];
								$qr = $row["qr"];
								$branch = $row["branch"];
								$date = $row["date"];
								$username = $row["username"];
								
								$counter++;

							?>
								<tr>
									<td><?php echo $counter; ?></td>
									<td><?php echo $type; ?></td>
									<td><?php echo $name; ?></td>
									<td><?php echo $inventory_id; ?></td>
									<td><?php echo $quantity; ?></td>
									<td><?php echo $detail; ?></td>
									<td><?php echo $date; ?></td>
									<td><?php echo $username; ?></td>
								</tr>
							<?php
							}
							?>
						</table>
					</div>
				</div>
			</div>
			<footer></footer>
			<?php
			}
			?>
	</div>
<!-- /.container-fluid -->
</div>

<?php
include 'include/end.php';
?>
</body>
</html>