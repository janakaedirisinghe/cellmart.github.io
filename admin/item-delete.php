<?php 
session_start();

$connection = mysqli_connect("localhost","root","","testing");
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET["action"]))  {
	
	if (($_GET["action"])=="delete") {
		
			$query= "DELETE FROM tbl_product WHERE id={$_GET["id"]}";
			$result = mysqli_query($connection,$query);
			echo '<script>alert("Item Removed")</script>';
			echo '<script>window.location="admin-activity.php?items=yes"</script>';


	}
}


 ?>