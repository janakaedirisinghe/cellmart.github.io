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
		$first_name=$_POST['first_name'];
		$last_name=$_POST['last_name'];;
		$email=$_POST['email'];;
		
		
		//check req field using function
		$req_fields = array('user_id','first_name','last_name','email');
		$errors= array_merge($errors,check_req_fields($req_fields));

		//checking max length using function
		$max_len_fields = array('first_name'=> 20,'last_name'=>50,'email'=>50);
		$errors = array_merge($errors,check_max_len_fields($max_len_fields));


		//cheking email address
		$email = mysqli_real_escape_string($connect, $_POST['email']);
		$query= "SELECT * FROM user WHERE email ='{$email} ' AND id != {$user_id} Limit 1";
		$result_set=mysqli_query($connect,$query);
		if (mysqli_num_rows($result_set) == 1) {
			$errors[] = 'email address already exist';
		}

	if (empty($errors)) {
		//no error...modify new record
		$first_name = mysqli_real_escape_string($connect, $_POST['first_name']);
		$last_name = mysqli_real_escape_string($connect, $_POST['last_name']);
		
		

		$query = "UPDATE user SET first_name = '{$first_name}', last_name='{$last_name}',email='{$email}' WHERE id = {$user_id}  ";

		$result = mysqli_query($connect,$query);
		if ($result) {
			//query succsessful
					
					$_SESSION['email'] = $email;
					$_SESSION['first_name'] =$first_name ;
					$_SESSION['last_name'] = $last_name;
			header('Location: user-modify.php?modify=true');
		}else{
			$errors[]='failed to modify record';
		}

	}

		
	}
	

	

 ?>



<!DOCTYPE html>
<html>
<head>
	<title>View / Modify User</title>
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
	<h1>View / Modify User<span><a href="cart.php"> < HOME</a></span></h1>

	<?php 
	
	if (!empty($errors)) {
		display_errors($errors);
	}
	
	 ?>
<fieldset>

	<form action="user-modify.php" method="post" class="userform">
		<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
		<p>
			<label for="">First Name:</label>
			<input type="text" name="first_name" <?php echo 'value="' . $first_name .'"'; ?>  >	
		</p>
		<p>
			<label for="">Last Name:</label>
			<input type="text" name="last_name" <?php echo 'value="' . $last_name.'"'; ?> >	
		</p>
		<p> 
			<label for="">Email Address:</label>
			<input type="email" name="email" <?php echo 'value="' . $email .'"'; ?> >
		</p>
		<p>
			<label for="">Password:</label>
			<input type="text" name="" placeholder="******" disabled="">
			<span></span><a href="change-password.php">Change Password</a>
		</p>
		<p>
			<label for="">&nbsp&nbsp</label>
			<button type="submit" name="submit">Change</button>
		</p>
	</form>
</fieldset>


</main>

<br>


</body>
</html>