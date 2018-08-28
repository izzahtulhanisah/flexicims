<?php
session_start();
if(!isset($_SESSION['user_admin'])){
header("Location:../../index.html?location=" . $_SERVER['REQUEST_URI']);
}
$admin=$_SESSION['user_admin'];

setcookie(
  "login",
  $admin,
  time() + (10 * 365 * 24 * 60 * 60)
);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php
include 'include/head.php';
?>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
<?php
include 'include/body1.php';
?>

<!-- Page Content -->
<div class="content-wrapper">
	<div class="container-fluid">
		<!-- Breadcrumbs-->
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="../dashboard">Home</a>
			</li>
			<li class="breadcrumb-item active">Profile</li>
		</ol>
		<div class="row">
			<div class="col-12">
				<h1>Admin List</h1>
				<hr>
				<div class="panel-body">
					<div class="table-responsive">
						<table width="100%" class="table table-striped table-bordered table-hover table-sm" id="table">
							<thead>
								<tr>
								  <th>Admin Username</th>
								  <th>View Profile</th>
								  <th>Edit</th>
								</tr>
							</thead>
							<?php
							include '../../config/config.php';
							$select = "SELECT * FROM user WHERE userlevel='0'";
							$result = $conn->query($select);
							while($row = $result->fetch_assoc()){
							    $id = $row["id"];
							    $username = $row["username"];
							    $profileid = $row["profileid"];
							?>
							<tbody>
								<tr>
									<td><?php echo $username; ?></td>
									<th><a href="../setting/memberview2.php?id=<?php echo $id; ?>" class="btn btn-success btn-circle"><i class="fa fa-check"></a></th>
									<th><a href="adminedit.php?id=<?php echo $id; ?>" class="btn btn-info btn-circle"><i class="fa fa-check"></a></th>
								</tr>
							</tbody>
							<?php
								}
							?>
						</table>
					</div>
                    <a href="javascript: window.history.go(-1)"><button type="button" class="btn btn-default">Back</button></a>
				</div>
			</div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    <br><br><br>
</div>
<!-- /#page-wrapper -->

<?php
include 'include/body2.php';
?>
</body>
</html>