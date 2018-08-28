<?php

include 'config.php';
$id = $_REQUEST['id'];
$query = "DELETE FROM inventory WHERE id = '$id'";
$result = $conn->query($query);

if($result === TRUE){
	echo "<script type = \"text/javascript\">
				alert(\"Inventory Succesfully Delete\");
				window.location = (\"home.php\")
			</script>";
}
	
?>