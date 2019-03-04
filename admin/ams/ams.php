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

	<div class="content1">
			<a href="../admin-activity.php" class="badge badge-light"><span class="glyphicon glyphicon-sort"></span> Admin Dashboard</a><br><br>

      		<a href="add-admin.php" class="badge badge-light"><span class="glyphicon glyphicon-th-large"></span> Add Admin</a><br>
	      <a href="edit-admin.php?action=edit" class="badge badge-light"><span class="glyphicon glyphicon-plus"> </span> Modify Admin</a><br>
	      <a href="#" class="badge badge-light"><span class="glyphicon glyphicon-sort"></span> Change Password</a><br>
      


	</div>


	<div class="content2" style="padding-left:px;padding-top:px; ">


<div class="jumbotron jumbotron-fluid" >
  <div class="container">
    <h1 class="display-4">Now you can manage admin panel</h1>
    <p class="lead">Add admin | Edit admin details | Delete admin | Change admin password</p>
  </div>

	


	</div>
</div>

</body>
</html>
