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
				<h1>Staff List</h1>
				<hr>
				<br>
				<div class="panel-body">
					<div class="table-responsive">
						<table width="100%" class="table table-striped table-bordered table-hover table-sm" id="table">
							<thead>
								<tr>
									<th>ID</th>
									<th>Staff Username</th>
									<th>Edit</th>
									<th>Delete</th>
								</tr>
							</thead>
							<?php 
							include '../../config/config.php';
							$select = "SELECT * FROM user WHERE userlevel='2' ORDER BY id DESC ";
							$result = $conn->query($select);
							while($row = $result->fetch_assoc()){
								$id = $row["id"];
								$username = $row["username"];
							?>
							<tbody>
								<tr>
									<td><?php echo $id; ?></td>
									<td><?php echo $username; ?></td>
									<th><a href="staffedit.php?id=<?php echo $username; ?>" class="btn btn-info btn-circle"><i class="fa fa-check"></a></th>
									<th><a href="staffdelete_sql.php?id=<?php echo $id; ?>" class="btn btn-danger btn-circle"><i class="fa fa-times"></a></th>
								</tr>
							</tbody>
							<?php
								}
							?>
						</table>
					</div>
				<a href="javascript: window.history.go(-1)"><button type="button" class="btn btn-default">Back</button></a>
				<a href="staffadd.php"><button type="button" class="btn btn-primary">Add Staff</button></a>	
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

<script>
function myFunction() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("table");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>
</body>
</html>