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
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
<?php
include 'include/body1.php';
date_default_timezone_set("Asia/Kuala_Lumpur");
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
				<h1>Manager Add</h1>
				<hr>
				<form role="form" action="" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label>Username</label>
						<input class="form-control" type="text" name="user_manager" required/>
					</div>
					<div class="form-group">
						<label>Password</label>
						<input class="form-control" type="password" name="pass_manager" required/>
					</div>
					<div class="form-group">
						<label>Profile ID</label>	
						<input type="text" autocomplete="off" list="name" name="profileid" class="form-control select1" />
						<datalist id="name">
							<?php
							$select2 = "SELECT * FROM profile";
							$result2 = $conn->query($select2);
							$row2 = $result2->fetch_assoc();
								$profileid=$row2['id'];							
							
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
					<div class="form-group">
						<label>Branch</label>
						<input class="form-control" type="text" name="branch"/>
					</div>							
					<input type="submit" class="btn btn-primary" value="Submit" name="send" />
					<input type="button" onclick="location.href='managerlist.php';" class="btn btn-default" value="Back" />
				</form>

						<?php
							if(isset($_POST['send'])){
														
							$user_manager = $_POST['user_manager'];
							$pass_manager = $_POST['pass_manager'];
							$profileid = $_POST['profileid'];
					        $branch = $_POST['branch'];	

                            if($branch==NULL){
                             $branch=1; }
                            else
                             $branch=$_POST['branch'];
                             
							$sqlid="SELECT MAX(id) AS maxid FROM user";
                            $resultid = mysqli_query($conn, $sqlid);
                            $rowid = mysqli_fetch_assoc($resultid);
                            if($rowid['maxid']==NULL){
                            $id=1; }
                            else
                            $id=$rowid['maxid']+1;							
							
                            $datenow=date("Y-m-d H:i:s");
                            $user=$admin;							
							
							$qr = "INSERT INTO user (id,username,password,userlevel,profileid,branch) 
								   VALUES ('$id','$user_manager','$pass_manager','1','$profileid','$branch');";
							$res = $conn->query($qr);

							$querylog="INSERT INTO log (date,user,control,value,note,subjectid) 
                                       VALUES ('$datenow','$user','Manager List','$user_manager','Add Manager. Value is username.','$id')";
                            $resultlog = $conn->query($querylog);							
							
							if($res === TRUE){
								echo "<script type = \"text/javascript\">
									alert(\"manager Succesfully Added\");
									window.location = (\"managerlist.php\")
									</script>";
								}

							else 'Failed';
								}
						?>			
                    </div>
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