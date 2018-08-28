<?php

session_start();
$location=$_GET['location'];

$con=mysqli_connect("localhost","root","","sms");

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$username = mysqli_real_escape_string($con,$_POST['username']);
$password = mysqli_real_escape_string($con,$_POST['password']);

$sql="SELECT * FROM login WHERE username='$username' and password='$password'";
$result = mysqli_query($con,$sql);
$count= mysqli_num_rows($result);

if($count==1){

$_SESSION ['username']= $username;

if($location!=NULL || $location!=""){
    header("location:$location");
}else{
   header("location:index.php");
}


}
else {

echo "<script type = \"text/javascript\">
				alert(\"Wrong Username or Password\");
				window.location = (\"login.php\")
			</script>";

}

?>
