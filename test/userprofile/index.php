<?php
session_start();
if(!isset($_SESSION['user_admin'])){
header("Location:../../index.html?location=" . $_SERVER['REQUEST_URI']);
}
$admin=$_SESSION['user_admin'];
$userlevel=$_SESSION['userlevel'];

setcookie(
  "login",
  $admin,
  time() + (10 * 365 * 24 * 60 * 60)
);

if($userlevel=='1' || $userlevel=='2'){
echo "<script type = \"text/javascript\">
alert(\"Sorry. You cannot enter this page. Back to dashboard.\");
window.location = (\"../dashboard/\")
</script>";  
}
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
				<h1>Add Profile</h1>
				<hr>
				<div class="col-lg-12">
					<a href="admin.php" class="btn btn-danger">Admin</a>
					<a href="managerlist.php" class="btn btn-primary">Manager</a>
					<a href="stafflist.php" class="btn btn-success">Staff</a>
				</div>
			<!-- /.col-lg-12 -->
			</div>
		<!-- /.row -->
		</div>
	<!-- /.container-fluid -->
	</div>
</div>
        <!-- /#page-wrapper -->

<?php
include 'include/body2.php';
?>
</body>
</html>