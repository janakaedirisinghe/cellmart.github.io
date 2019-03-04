<?php 
session_start();
$connection = mysqli_connect("localhost","root","","testing");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
if (isset($_GET["action"])) {
	if ($_GET["action"]=="sent") {
		$query= "DELETE FROM orders WHERE id={$_GET["id"]}";
		$result = mysqli_query($connection,$query);

		$query = "UPDATE orders_copy SET status ='Item Shipped' WHERE id={$_GET["id"]} ";
		$res = mysqli_query($connection,$query);

		echo '<script>alert("Item sent confirmed")</script>';
		echo '<script>window.location="admin-activity.php?order=yes"</script>';
	}
}

 ?>