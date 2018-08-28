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
include '../../config/config.php';
include 'include/head.php';
?>

<script>
function goBack() {
    window.history.back();
}
</script>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
<?php
include 'include/body1.php';
?>

<?php 
	$id = $_REQUEST["id"];
	$select = "SELECT * FROM user WHERE id='$id'";
	$result = $conn->query($select);
	while($row = $result->fetch_assoc()){
		$id = $row["id"];
		$username = $row["username"];
		$password = $row["password"];
		$profileid = $row["profileid"];
        $branch = $row["branch"];		
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
				<h1>Edit Admin Profile</h1>
				<hr>
						<form role="form" action="adminedit_sql.php" method="post" enctype="multipart/form-data">
							<div class="form-group">
								<label>Username/Gmail</label>
								<input class="form-control" type="text" name="username" value="<?php echo $username; ?>" required/>
								<input type="hidden" name="id" value="<?php echo $id; ?>">
								<input type="hidden" name="branch" value="<?php echo $branch; ?>">
							</div>
							<div class="form-group">
								<label>Password</label>
								<input class="form-control" type="password" name="password" value="<?php echo $password; ?>" required/>
							</div>
							<div class="form-group">
								<label>Profile ID</label>	
								<input type="text" autocomplete="off" list="name" name="profileid" class="form-control select1" value="<?php echo $profileid; ?>"/>
								<datalist id="name">
									<?php
									echo "<option value='".$profileid."'></option>";
									$select1 = "SELECT * FROM profile";
									$result1 = $conn->query($select1);
									while($row1 = $result1->fetch_assoc()){
										$name=$row1['name'];
										$id=$row1['id'];
										
									echo "<option value='".$id."'>". $name ."</option>";
									// close while loop 
									}
									?>
								</datalist>	
							</div>
				            <a href="javascript: window.history.go(-1)"><button type="button" class="btn btn-default">Back</button></a>
							<input type="submit" class="btn btn-primary" value="Submit" name="send" />
						</form>	
                    </div>
					<?php
						}
					?>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
<?php
include 'include/body2.php';
?>
</body>
</html>