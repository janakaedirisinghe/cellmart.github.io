<?php session_start() ?> 
<?php 
	require_once('inc/connect.php');
	require_once('inc/functions.php');
	
 ?>
 

<?php 

	$first_name='';
	$last_name='';
	$email='';
	$password='';
	

	$errors =array();

	if (isset($_POST['submit'])) {

		$first_name=$_POST['first_name'];
		$last_name=$_POST['last_name'];;
		$email=$_POST['email'];;
		$password=$_POST['password'];;
		
		//check req field using function
		$req_fields = array('first_name','last_name','email','password');
		$errors= array_merge($errors,check_req_fields($req_fields));

		//checking max length using function
		$max_len_fields = array('first_name'=> 20,'last_name'=>50,'email'=>50,'password'=>10);
		$errors = array_merge($errors,check_max_len_fields($max_len_fields));


		//cheking email address
		$email = mysqli_real_escape_string($connect, $_POST['email']);
		$query= "SELECT * FROM user WHERE email ='{$email} ' Limit 1";
		$result_set=mysqli_query($connect,$query);
		if (mysqli_num_rows($result_set) == 1) {
			$errors[] = 'email address already exist';
		}

	if (empty($errors)) {
		//no error...adding new record
		$first_name = mysqli_real_escape_string($connect, $_POST['first_name']);
		$last_name = mysqli_real_escape_string($connect, $_POST['last_name']);
		$password = mysqli_real_escape_string($connect, $_POST['password']);
		
		$hashed_password = sha1($password);

		$query = "INSERT INTO user (first_name,last_name,email,password,is_deleted)VALUES ('$first_name','$last_name','$email','$hashed_password', 0)    ";

		$result = mysqli_query($connect,$query);
		if ($result) {
			//query succsessful
			
			echo '<script>alert("Registration succsessful")</script>';
			header('Location: index.php?user_added=true');
		}else{
			$errors[]='failed to add the record';
		}

	}

		
	}
	

	

 ?>



<!DOCTYPE html>
<html>
<head>
	<title>User</title>
	<link rel="stylesheet" type="text/css" href='css/main.css'>
</head>

<body background="admin/img/1.jpg">
<header>
	
	


</header>
<main>
	<h1>Register<span><a href="index.php"> < Login</a></span></h1>

	<?php 
	
	if (!empty($errors)) {
		display_errors($errors);
	}
	
	 ?>
	<div class="login">
		<fieldset>
				<legend><h3> User Registration</h3></legend>
	<form action="register.php" method="post" class="userform">
		
		<p>
			<label for="">First Name:</label>
			<input type="text" name="first_name"   >	
		</p>
		<p>
			<label for="">Last Name:</label>
			<input type="text" name="last_name"  >	
		</p>
		<p> 
			<label for="">Email Address:</label>
			<input type="email" name="email"  >
		</p>
		<p>
			<label for="">Password:</label>
			<input type="password" name="password" >
		</p>
		<p>
			<button type="submit" name="submit">Register</button>
		</p>
	</form>
</fieldset>
</div>

</main>

<br>

	

</pre>

</body>
</html>