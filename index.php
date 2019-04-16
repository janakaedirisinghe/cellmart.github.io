<?php session_start() ?> 
<?php require_once('inc/connect.php'); ?>
<?php require_once('inc/functions.php'); ?>

<?php 

	//check for form submission

	if(isset($_POST['submit'])){

		$errors = array();
		//check if the username and password has been entered

		if(!isset($_POST['email']) || strlen(trim($_POST['email'])) <1 ){
			$errors[]='Username is missing or invalid';

		}

		if(!isset($_POST['password']) || strlen(trim($_POST['password'])) <1 ){
			$errors[]='password is missing or invalid!';

		}

	//check if there are any error in the form 

		if(empty($errors)){

		//save user name and password into variable
			$email = mysqli_real_escape_string($connect,$_POST['email']);
			$password = mysqli_real_escape_string($connect,$_POST['password']);
			$hashed_password = sha1($password);

	
		//prepare databse query //
			$query = "SELECT * FROM user 
						WHERE email='{$email}'
						AND password='{$hashed_password}'
							lIMIT 1";

			$result_set = mysqli_query($connect,$query);
			verify_query($result_set);
				//query succsessful
				if(mysqli_num_rows($result_set) == 1)
				{
					//valid user found

					$user = mysqli_fetch_assoc($result_set);
					$_SESSION['user_id'] = $user['id'];
					$_SESSION['email'] = $user['email'];
					$_SESSION['first_name'] = $user['first_name'];
					$_SESSION['last_name'] = $user['last_name'];
						
					//update last login
					$query = "UPDATE user SET last_login = NOW()";
					$query .= "WHERE id = {$_SESSION['user_id']} LIMIT 1";	
					$result_set = mysqli_query($connect,$query);
					verify_query($result_set);


					//redirect to users.php
					header('Location: cart.php');
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
	<title> Tech Store </title>

	<link rel="stylesheet" type="text/css" href="login-form.css">

</head>
<body>
	


	<div class="body"></div>
		<div class="grad"></div>
		<div class="header">
			<div>Cell<span>Mart</span></div>
		</div>
		<br>
		<div class="login">
			<form action="index.php" method="POST">
				<?php 
					if (isset($errors) && !empty($errors)) {
						echo '<p class="error">'.$errors[0].'</p>';
					}
				 ?>

				 <?php 
				 		if (isset($_GET['logout'])) {
				 			echo '<p class="logout">Successfuly Logged Out!</p>';
				 		}
				  ?>
					
				<?php 
				 		if (isset($_GET['user_added'])) {
				 			echo '<p class="logout">Successfuly Registration </p>';
				 		}
				  ?>
				<input type="text" placeholder="username" name="email"><br>
				<input type="password" placeholder="password" name="password"><br>
				<input type="submit" value="Login" name="submit">
				<hr>
				<a href="register.php">Register Now</a>
			</form>
		</div>


</body>
</html>


<?php
mysqli_close($connect);
?>
