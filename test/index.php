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
<html>

<head>

<?php
include 'include/head.php';
?>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<!-- <script type="text/javascript">
google.load('visualization', '1', {'packages':['corechart', 'bar']});

// Set a callback to run when the Google Visualization API is loaded.
google.setOnLoadCallback(drawCharts);

function drawCharts() {
       var data = new google.visualization.DataTable();
       // Add legends with data type
       data.addColumn('string', 'Name');
       data.addColumn('number', 'Quantity');

<?php

// Fetch the data


$query= "SELECT name,sum(quantity) as quantity FROM record WHERE detail='Outgoing' OR detail='Incoming' GROUP BY name ORDER BY sum(quantity) ASC LIMIT 5";

$result = $conn->query($query);

// All good?
if ( !$result ) {
  // Nope
  $message  = 'Invalid query: ' . mysqli_error($conn) . "\n";
  $message .= 'Whole query: ' . $query;
  die( $message );
}

while ( $row = mysqli_fetch_assoc($result) ) {
echo "data.addRow(['" . $row['name'] . "', parseInt('" . $row['quantity'] . "')]);";
}
?>

var options = {
    title: 'Name/Quantity',
    chartArea: {width: '50%'},
    hAxis: {

      minValue: 0
    },

  };
  var chart = new google.visualization.ColumnChart(document.getElementById('bar_chart1'));
  chart.draw(data, options);

   }
</script> -->

<!-- <script type="text/javascript">
google.load('visualization', '1', {'packages':['corechart', 'bar']});

// Set a callback to run when the Google Visualization API is loaded.
google.setOnLoadCallback(drawCharts);

function drawCharts() {
       var data = new google.visualization.DataTable();
       // Add legends with data type
       data.addColumn('string', 'Name');
       data.addColumn('number', 'Quantity');

<?php

// Fetch the data


$query= "SELECT name,sum(quantity) as quantity FROM record WHERE detail='Outgoing' OR detail='Incoming' GROUP BY name ORDER BY sum(quantity) DESC LIMIT 5";
//$query= "SELECT name,SUM(quantity) as quantity FROM record WHERE detail='Incoming' ORDER BY quantity ASC LIMIT 5";

$result = $conn->query($query);

// All good?
if ( !$result ) {
  // Nope
  $message  = 'Invalid query: ' . mysqli_error($conn) . "\n";
  $message .= 'Whole query: ' . $query;
  die( $message );
}

while ( $row = mysqli_fetch_assoc($result) ) {
echo "data.addRow(['" . $row['name'] . "', parseInt('" . $row['quantity'] . "')]);";
}
?>

var options = {
    title: 'Name/Quantity',
    chartArea: {width: '50%'},
    hAxis: {

      minValue: 0
    },

  };
  var chart = new google.visualization.ColumnChart(document.getElementById('bar_chart2'));
  chart.draw(data, options);

   }
</script> -->

<!-- <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Name', 'Quantity'],
          <?php

          // Connect to MySQL

          // Fetch the data
          $sqlpie="SELECT name,quantity FROM inventory ORDER BY quantity DESC";

          $resultpie=mysqli_query($conn,$sqlpie);

          while($rowpie=mysqli_fetch_array($resultpie)){
              $name=$rowpie['name'];
              $quantity=$rowpie['quantity'];

             ?>
            ['<?php echo $name ?>',     <?php echo $quantity ?>],
        <?php  }

          ?>
        ]);

        var options = {
          title: 'Total Sales By Categories'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script> -->

</head>

<?php
include 'include/menu.php';
?>

		<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><center>DASHBOARD</center></h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
									<?php

									$sql="SELECT id FROM inventory";

									if ($result=mysqli_query($conn,$sql))
									  {
									  // Return the number of rows in result set
									  $rowcount=mysqli_num_rows($result);
									?>
									<div class="huge"><?php echo $rowcount; ?></div>
									<?php

									  // Free result set
									  mysqli_free_result($result);
									  }

									?>

                                    <div>Total Inventory</div>
                                </div>
                            </div>
                        </div>
                        <a href="home.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php

									$sqlcrt="SELECT id FROM inventory WHERE status='Critical'";

									if ($resultcrt=mysqli_query($conn,$sqlcrt))
									  {
									  // Return the number of rows in result set
									  $rowcountcrt=mysqli_num_rows($resultcrt);
									?>
									<div class="huge"><?php echo $rowcountcrt; ?></div>
									<?php

									  // Free result set
									  mysqli_free_result($resultcrt);
									  }



									?>
                                    <div>Critical</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php

									$sqlmin="SELECT id FROM inventory WHERE status='Minimum'";

									if ($resultmin=mysqli_query($conn,$sqlmin))
									  {
									  // Return the number of rows in result set
									  $rowcountmin=mysqli_num_rows($resultmin);
									?>
									<div class="huge"><?php echo $rowcountmin; ?></div>
									<?php

									  // Free result set
									  mysqli_free_result($resultmin);
									  }



									?>
                                    <div>Minimum</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-support fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php

									$sqlmax="SELECT id FROM inventory WHERE status='Maximum'";

									if ($resultmax=mysqli_query($conn,$sqlmax))
									  {
									  // Return the number of rows in result set
									  $rowcountmax=mysqli_num_rows($resultmax);
									?>
									<div class="huge"><?php echo $rowcountmax; ?></div>
									<?php

									  // Free result set
									  mysqli_free_result($resultmax);
									  }



									?>
                                    <div>Maximum</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <!-- <div class="row">
                <div class="col-lg-12">
					<div class="panel panel-default">
                        <div class="panel-heading">
                            Top 5 Active
                        </div>
                        <div class="panel-body">
                            <div id="bar_chart1"></div>
                        </div>
                    </div>
                </div>
            </div> -->
			<!-- <div class="row">
                <div class="col-lg-12">
					<div class="panel panel-default">
                        <div class="panel-heading">
                            Top 5 Slowest
                        </div>
                        <div class="panel-body">
                            <div id="bar_chart2"></div>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- /.row -->
			<!-- <div class="row">
                <div class="col-lg-12">
					<div class="panel panel-default">
                        <div class="panel-heading">
                            Product Sales
                        </div>
                        <div class="panel-body">
                            <div id="piechart"></div>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

				<div id="page-wrapper">
		            <div class="row">
		                <div class="col-lg-12">
		                    <h3 class="page-header"><center>ADMIN DASHBOARD</center></h3>
		                </div>
		                <!-- /.col-lg-12 -->
		            </div>
		            <!-- /.row -->
		            <div class="row">
		                <div class="col-lg-3 col-md-6">
		                    <div class="panel panel-green">
		                        <div class="panel-heading">
		                            <div class="row">
		                                <div class="col-xs-3">
		                                    <i class="fa fa-comments fa-5x"></i>
		                                </div>
		                                <div class="col-xs-9 text-right">

																				<?php
																				$sqlstaff="SELECT id FROM profile WHERE position='Staff'";

																				if ($resultstaff=mysqli_query($conn,$sqlstaff))
																					{
																					// Return the number of rows in result set
																					$rowcountstaff=mysqli_num_rows($resultstaff);
																				?>
																				<div class="huge"><?php echo $rowcountstaff; ?></div>
																				<?php
																					// Free result set
																					mysqli_free_result($resultstaff);
																					}
																				?>

		                                    <div>Staff</div>
		                                </div>
		                            </div>
		                        </div>
		                        <a href="staff.php">
		                            <div class="panel-footer">
		                                <span class="pull-left">View Details</span>
		                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
		                                <div class="clearfix"></div>
		                            </div>
		                        </a>
		                    </div>
		                </div>
		                <div class="col-lg-3 col-md-6">
		                    <div class="panel panel-red">
		                        <div class="panel-heading">
		                            <div class="row">
		                                <div class="col-xs-3">
		                                    <i class="fa fa-tasks fa-5x"></i>
		                                </div>
		                                <div class="col-xs-9 text-right">

																				<?php
																				$sqladmin="SELECT id FROM profile WHERE position='Admin'";

																				if ($resultadmin=mysqli_query($conn,$sqladmin))
																				  {
																				  // Return the number of rows in result set
																				  $rowcountadmin=mysqli_num_rows($resultadmin);
																				?>
																				<div class="huge"><?php echo $rowcountadmin; ?></div>
																				<?php
																				  // Free result set
																				  mysqli_free_result($resultadmin);
																				  }
																				?>

		                                    <div>Admin</div>
		                                </div>
		                            </div>
		                        </div>
		                        <a href="admin.php">
		                            <div class="panel-footer">
		                                <span class="pull-left">View Details</span>
		                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
		                                <div class="clearfix"></div>
		                            </div>
		                        </a>
		                    </div>
		                </div>
		                <div class="col-lg-3 col-md-6">
		                    <div class="panel panel-yellow">
		                        <div class="panel-heading">
		                            <div class="row">
		                                <div class="col-xs-3">
		                                    <i class="fa fa-shopping-cart fa-5x"></i>
		                                </div>
		                                <div class="col-xs-9 text-right">

																				<?php
																				$sqldirector="SELECT id FROM profile WHERE position='Director'";

																				if ($resultdirector=mysqli_query($conn,$sqldirector))
																				  {
																				  // Return the number of rows in result set
																				  $rowcountdirector=mysqli_num_rows($resultdirector);
																				?>
																				<div class="huge"><?php echo $rowcountdirector; ?></div>
																				<?php
																				  // Free result set
																				  mysqli_free_result($resultdirector);
																				  }
																				?>

		                                    <div>Director</div>
		                                </div>
		                            </div>
		                        </div>
		                        <a href="director.php">
		                            <div class="panel-footer">
		                                <span class="pull-left">View Details</span>
		                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
		                                <div class="clearfix"></div>
		                            </div>
		                        </a>
		                    </div>
		                </div>
		                <div class="col-lg-3 col-md-6">
		                    <div class="panel panel-primary">
		                        <div class="panel-heading">
		                            <div class="row">
		                                <div class="col-xs-3">
		                                    <i class="fa fa-support fa-5x"></i>
		                                </div>
		                                <div class="col-xs-9 text-right">

																				<?php
																				$sqlman="SELECT id FROM profile WHERE position='Manager'";

																				if ($resultman=mysqli_query($conn,$sqlman))
																				  {
																				  // Return the number of rows in result set
																				  $rowcountman=mysqli_num_rows($resultman);
																				?>
																				<div class="huge"><?php echo $rowcountman; ?></div>
																				<?php
																				  // Free result set
																				  mysqli_free_result($resultman);
																				  }
																				?>

		                                    <div>Manager</div>
		                                </div>
		                            </div>
		                        </div>
		                        <a href="#">
		                            <div class="panel-footer">
		                                <span class="pull-left">View Details</span>
		                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
		                                <div class="clearfix"></div>
		                            </div>
		                        </a>
		                    </div>
		                </div>
		            </div>
		        </div>


<?php
include 'include/end.php';
?>

</html>
