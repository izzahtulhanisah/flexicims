<?php
include('../../config/config.php');

if(isset($_POST['view'])){
if($_POST["view"] != '')
	{
	$update_query = "UPDATE record SET notif = 1 WHERE notif = '' and status='Done' and delivery='Yes'";
	mysqli_query($conn, $update_query);
	}
	$query = "SELECT * FROM record WHERE status = 'Done' and delivery = 'Yes' ORDER BY id DESC";
	$result = mysqli_query($conn, $query);
	$output = '';
if(mysqli_num_rows($result) > 0)
    {
	while($row = mysqli_fetch_array($result))
	{
		$output .= '
		<a class="dropdown-item" href="../status/delivery">
				<span class="dropdown-message small">
					<strong>'.$row["name"].'</strong><br>
					<small><em>'.$row["status"].'</em></small>
				</span> 
            </a>
            <div class="dropdown-divider"></div>
		';
	}
    }
else{
	$output .= '<a href="#" class="dropdown-item">
	            <span class="dropdown-message small">
					<strong>No Notification Found</strong><br>
				</span></a>';
    }
$status_query = "SELECT * FROM record WHERE notif=0 and status='Done' and delivery='Yes'";
$result_query = mysqli_query($conn, $status_query);
$count = mysqli_num_rows($result_query);
$data = array(
'notification' => $output,
'unseen_notification'  => $count
);
echo json_encode($data);
}
?>