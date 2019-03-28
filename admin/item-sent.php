<?php 
session_start();
$connection = mysqli_connect("localhost","root","","testing");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
$date_time = $_GET['date_time'];
$id= $_GET['id'];

if (isset($_GET["action"])) {
	if ($_GET["action"]=="sent") {
		$query= "DELETE FROM orders WHERE id={$id} AND date_time = '{$date_time}' ";
		$result = mysqli_query($connection,$query);

		$query = "UPDATE orders_copy SET status ='Item Shipped' WHERE id={$id} AND date_time='{$date_time}' ";
		$res = mysqli_query($connection,$query);

		echo '<script>alert("Item sent confirmed")</script>';
		echo '<script>window.location="admin-activity.php?order=yes"</script>';
	}
}

 ?>