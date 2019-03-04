<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
 	header('Location: ../admin-login.php');
 	
 }
$connect = mysqli_connect("localhost", "root", "", "testing");

 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Admin Manage</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="../../css/ams.css">
</head>
<body>
<div class="main">
	<div class="content1">
		 <a href="../admin-activity.php" class="badge badge-light"><span class="glyphicon glyphicon-sort"></span> Admin Dashboard</a><br><br>
		 <a href="add-admin.php" class="badge badge-light"><span class="glyphicon glyphicon-th-large"></span> Add Admin</a><br>
	      
	      <a href="#" class="badge badge-light"><span class="glyphicon glyphicon-sort"></span> Change Password</a><br>

      
	     

	</div>
	<div class="content2" style="padding-left:260px;padding-top: 10px; padding-right: 10px;">


			<table class="table table-bordered">
					<tr>
						<th width="10%">Admin Id</th>
						<th width="10%">User Name </th>
						<th width="5%"></th>
						<th width="5%"></th>
						
					</tr>
					<?php
					if(isset($_GET['action']))
					{	
						$admin_id = $_SESSION['admin_id'];
						$query = "SELECT * FROM admin WHERE id != '{$admin_id}' ";
						$result = mysqli_query($connect,$query);
						if (mysqli_num_rows($result) > 0 ) {
							while ($row = mysqli_fetch_array($result)) {
					
						
					?>
					<tr>
						<td><?php echo $row["id"]; ?></td>
						<td><?php echo $row["email"];?></td>
						<td><a href='modify-admin.php?<?php echo "id=".$row['id'] ;?>'>edit</a></td>
						<td><a href='delete-admin.php?<?php echo "id=".$row['id']; ?>'>delete</a></td>
						
					</tr>
					<?php
						}	
					}
				}

					?>
					

					
						
				</table>
	


	</div>
</div>

</body>
</html>
