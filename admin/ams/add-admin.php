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
		 
	      <a href="edit-admin.php?action=edit" class="badge badge-light"><span class="glyphicon glyphicon-plus"> </span> Modify Admin</a><br>
	      <a href="#" class="badge badge-light"><span class="glyphicon glyphicon-sort"></span> Change Password</a><br>

      
	     

	</div>
	<div class="content2" style="padding-left:700px;padding-top: 200px;">

<!--Add Admin -->				
	
	<?php 
			if (isset($_POST['submit1'])) {
				$user_name = mysqli_real_escape_string($connect,$_POST['user_name']);
				$password = mysqli_real_escape_string($connect,$_POST['password']);
				$query = "SELECT * FROM admin WHERE email = '{$user_name}' LIMIT 1";
				$result = mysqli_query($connect,$query);

				if (mysqli_num_rows($result) == 1) {
					echo "<mark>Your username already taken!</mark>";
				}elseif (isset($_GET['action'])) {
				$query = "INSERT INTO admin (email , password) VALUES('{$user_name}','{$password}')";
				$result = mysqli_query($connect,$query);
					
					 		echo '<script>alert("Admin added!")</script>';
					 		echo '<script>window.location="ams.php"</script>';
					 		
				}



				
			}
			
	 ?>
				<form action="add-admin.php?action=add" method="POST">
				  <div class="form-group">
				    <label for="exampleInputEmail1">User Name </label>
				    <input type="text"  name="user_name" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="User Name" style="width: 200px;" required="">
				    
				  </div>
				  <div class="form-group">
				    <label for="exampleInputPassword1">Password</label>
				    <input type="password" name="password" class="form-control form-control-sm" id="exampleInputPassword1"  placeholder="Password"  style="width: 200px;" required="">
				  </div>
				  
				  <button type="submit" name="submit1" class="btn btn-dark">Add Admin</button>
				</form>

	


	</div>
</div>

</body>
</html>
