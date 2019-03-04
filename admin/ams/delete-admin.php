<?php 
	session_start();
	$connect = mysqli_connect("localhost","root","","testing");

	if (isset($_GET['id'])) {
			$admin_id = $_GET['id'];
			$query = " DELETE FROM admin WHERE id={$admin_id} " ;
			$result = mysqli_query($connect,$query);
			if ($result) {
									echo '<script>alert("Admin deleted!")</script>';
					 				echo '<script>window.location="edit-admin.php?action=edit"</script>';
			}

	}

 ?>