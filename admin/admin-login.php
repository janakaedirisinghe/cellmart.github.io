
<?php session_start() ?> 
<?php require_once('../inc/connect.php'); ?>
<?php require_once('../inc/functions.php'); ?>

<?php 

	//check for form submission

	if(isset($_POST['submit'])){

		$errors = array();
		//check if the username and password has been entered

		if(!isset($_POST['email']) || strlen(trim($_POST['email'])) <1 ){
			$errors[]='Username is missing or invalid';

		}

		if(!isset($_POST['password']) || strlen(trim($_POST['password'])) <1 ){
			$errors[]='password is missing or invalid';

		}

	//check if there are any error in the form 

		if(empty($errors)){

		//save user name and password into variable
			$email = mysqli_real_escape_string($connect,$_POST['email']);
			$password = mysqli_real_escape_string($connect,$_POST['password']);
			

	
		//prepare databse query
			$query = "SELECT * FROM admin 
						WHERE email='{$email}'
						AND password='{$password}'
							lIMIT 1";

			$result_set = mysqli_query($connect,$query);
			verify_query($result_set);
				//query succsessful
				if(mysqli_num_rows($result_set) == 1)
				{
					//valid user found

					$user = mysqli_fetch_assoc($result_set);
					$_SESSION['admin_id'] = $user['id'];
					$_SESSION['email'] = $user['email'];
						
					/*
					//update last login
					$query = "UPDATE user SET last_login = NOW()";
					$query .= "WHERE id = {$_SESSION['user_id']} LIMIT 1";	
					$result_set = mysqli_query($connection,$query);
					verify_query($result_set);
					*/


					//redirect to users.php
					header('Location: admin-activity.php');
				}else{
					//user name and password invalid
					$errors[]='Invalid User name and password';
				}
			
		
		
		

		}
		
	

	}
	
	
 ?>





<!DOCTYPE html>
<html>
<head>
	<title> ADMIN Login </title>
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body background="img/1.jpg">

	<div class='admin_login'>

		<form action="admin-login.php" method="POST">
			
			<fieldset>
				<legend><h1> Admin LogIn</h1></legend>

				<?php 
					if (isset($errors) && !empty($errors)) {
						echo '<div class="alert alert-danger"><strong>'.$errors[0].'</strong> </div>';

						
					}
				 ?>

				 <?php 
				 		if (isset($_GET['logout'])) {
				 			echo '<div class="alert alert-success"><strong>Successfuly Logged Out!</strong></div>';
				 		}
				  ?>
				
				

				<p>
					<label for=""><b>Username:</b></label>
					<input type="text" name='email' id="" placeholder="Email Address">
				</p>
				<p>
					<label for=""><b>Password</b></label>
					<input type="password" name='password' id="" placeholder="Password">

				</p>	
				<p>
					<button type="submit" name="submit">Log In</button>
				</p>

			</fieldset>

		</form>


	</div>



</body>
</html>


<?php
mysqli_close($connect);
?>
