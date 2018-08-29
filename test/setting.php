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

<!-- Page Content -->
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><center>SETTING</center></h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
		<div class="row">
			<div class="col-12">
				<center>
					<a href="companyprofile.php" class="btn btn-danger">COMPANY PROFILE</a>
					<?php
					if($secpass == 2){
					?>
					<a href="assignstaff.php" class="btn btn-primary">ASSIGN LEADER</a>
					<?php
					}
					elseif($secpass == 1){
					?>	
					<a href="assignmanager.php" class="btn btn-primary">ASSIGN LEADER</a>
					<?php	
					}
					else{
					?>
					<a href="#" class="btn btn-primary" data-toggle="modal" data-placement="bottom" data-target="#myModal" title="Assign">ASSIGN LEADER</a>
					<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title" id="myModalLabel">Assign Staff</h4>
								</div>
								
								<div class="modal-body">
									<a href="assignmanager.php" class="btn btn-primary">ASSIGN LEADER(MANAGER)</a>
									<a href="assignstaff.php" class="btn btn-primary">ASSIGN LEADER(STAFF)</a>
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
				</center>
			<!-- /.col-lg-12 -->
			</div>
		<!-- /.row -->
		</div>
</div>



<?php
include 'include/end.php';
?>
</body>
</html>
