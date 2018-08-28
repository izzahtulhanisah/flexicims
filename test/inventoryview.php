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

</head>

<body>

	<?php
    include 'include/menu.php';
	?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">View Detail</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <?php
						
						include 'config.php';
						$id = $_REQUEST['id'];
						$counter = 0;

						$select = "SELECT * FROM inventory WHERE id='$id' ";						
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
							$description = $row["description"];
							$dateupdate = $row["dateupdate"];
							$expireddate = $row["expireddate"];
							$supplier = $row["supplier"];
							$batch = $row["batch"];
							$updateby = $row["updateby"];
						}
						
					?>
					<p class="text-primary">Description : <?php echo $description; ?></p>
					<p class="text-primary">Last Update(Date) : <?php echo $dateupdate; ?></p>
					<p class="text-primary">Update By : <?php echo $updateby; ?></p>
					
					<br><br><br>
					
					<a href="home.php"><button type="button" class="btn btn-default" style="margin-bottom: 2px;">Back</button></a>
					
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
