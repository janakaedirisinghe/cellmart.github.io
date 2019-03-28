<?php session_start() ?> 
<?php 
	require_once('inc/connect.php');
	require_once('inc/functions.php');
	
 ?>
 <?php 
 //check if a user log
 if (!isset($_SESSION['user_id'])) {
 	header('Location: index.php');
 }
 ?>  

<?php 

	$first_name=$_SESSION['first_name'];
	$last_name=$_SESSION['last_name'];
	$email=$_SESSION['email'];
	$password='';
	$errors =array();
	$user_id =$_SESSION['user_id'];




	if (isset($_POST['submit'])) {
		$user_id = $_POST['user_id'];
		$password =$_POST['password'];
		
		//check req field using function
		$req_fields = array('user_id','password');
		$errors= array_merge($errors,check_req_fields($req_fields));

		//checking max length using function
		$max_len_fields = array('password'=> 40);
		$errors = array_merge($errors,check_max_len_fields($max_len_fields));


		
	if (empty($errors)) {
		//no error...modify new record
		$password = mysqli_real_escape_string($connect, $_POST['password']);
		$hashed_password=sha1($password);
		
		
		

		$query = "UPDATE user SET password = '{$hashed_password}'  WHERE id = {$user_id}  ";

		$result = mysqli_query($connect,$query);
		if ($result) {
			//query succsessful
					
					
			header('Location: user-modify.php?modify=true');
		}else{
			$errors[]='failed to modify password';
		}

	}

		
	}
	

	

 ?>



<!DOCTYPE html>
<html>
<head>
	<title>Change Password</title>
	<link rel="stylesheet" type="text/css" href='css/main.css'>
</head>
<body>

<header>
	
	<div class="appname"><H6>  &nbsp &nbsp  Cell Mart</H6></div>
	<div class="loggedin"><mark><b>Hi <?php echo $_SESSION['first_name'];?>!</b></mark>&nbsp&nbsp<a href="logout.php"> Log Out</a></div>

	<br>
	<br>
	
	


</header>
<main>
	<h1>Change Password<span><a href="cart.php"> < Home</a></span></h1>

	<?php 
	
	if (!empty($errors)) {
		display_errors($errors);
	}
	
	 ?>
<div class="a">
	<form action="change-password.php" method="post" class="userform">
		<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
		<p>
			<label for="">First Name:</label>
			<input type="text" name="first_name" <?php echo 'value="' . $first_name .'"'; ?> disabled  >	
		</p>
		<p>
			<label for="">Last Name:</label>
			<input type="text" name="last_name" <?php echo 'value="' . $last_name.'"'; ?> disabled>	
		</p>
		<p> 
			<label for="">Email Address:</label>
			<input type="email" name="email" <?php echo 'value="' . $email .'"'; ?> disabled>
		</p>
		<p>
			<label for="">New Password:</label>
			<input type="password" name="password" id="password">
		</p>
		<p>
			<label for=""> &nbsp</label>
			<input  type="checkbox" name="show_password" id="show_password" style="width: 20px;height: 20px;">
		</p>
		<p>
			<label  for="">&nbsp&nbsp</label>
			<button type="submit" name="submit">Change Password</button>
		</p>
	</form>
</div>



</main>
<script src="js/jquery.js"></script>
<script>
	$(document).ready(function(){
		$('#show_password').click(function(){
			if ($('#show_password').is(':checked')) {
				$('#password').attr('type','text');
			}else{
				$('#password').attr('type','password');
			}
		});
	});

</script>




</body>
</html>