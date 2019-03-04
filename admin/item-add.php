<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
 	header('Location: admin-login.php');
 	
 }
$connect = mysqli_connect("localhost", "root", "", "testing");

 ?>
<?php 
		if (isset($_GET['action'])) {
			if ($_GET['action']=='add') {
				
					$query = "INSERT INTO tbl_product(name,image,price)
					VALUES('{$_POST['item_name']}','{$_POST['item_image']}','{$_POST['item_price']}')";
					$result= mysqli_query($connect,$query);
					if ($result) {
						echo '<script>alert("Item add succsessful")</script>';
						echo '<script>window.location="admin-activity.php?items=yes"</script>';
					
					}


			}
		}

 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Item-ADD</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="../css/main.css">
		<link rel="stylesheet" type="text/css" href="../css/admin.css">
		<script type="text/javascript">
			 function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
		</script>
</head>
<body style="background-color: #eee;">

<section>
  <nav> <h3><a href="logout-admin.php">Hello <?php echo $_SESSION['email'];?>  <span class="badge">Logout</span></a></h3>
  	<!--<div style="color: white;margin-top: 20px;margin-bottom: 30px;" class="loggedin">Welcome <?php echo $_SESSION['email'];?> !<a href="logout-admin.php"> Log Out</a> </div>-->
  	<br>
  	<br>
    <ul style="padding-top: 10px;">
      <li><a href="admin-activity.php?items=yes" class="badge badge-light"><span class="glyphicon glyphicon-th-large"></span> Items</a></li><br>
      <li><a href="item-add.php" class="badge badge-light"><span class="glyphicon glyphicon-plus"> </span> Add Items</a></li><br>
      <li><a href="admin-activity.php?order=yes" class="badge badge-light"><span class="glyphicon glyphicon-sort"></span> User Orders</a></li><br>
      <li><a href="admin-activity.php?order_copy=yes" class="badge badge-light"><span class="glyphicon glyphicon-ok"></span> Orders Histry</a></li><br>
      <li><a href="ams/ams.php" class="badge badge-light"><span class="glyphicon glyphicon-user"></span> Admin Manager</a></li>


      
    </ul>

  </nav>
  
  <article>


		

		<form action="item-add.php?action=add" method="POST" style="padding-left: 330px;">
			
			<fieldset>
				<legend><h1> Item Add</h1></legend>
				<br>
				<h5><a href="admin-activity.php?items=yes">Admin page</a></h5>

				

				 
					
				<?php 
				 		if (isset($_GET['user_added'])) {
				 			echo '<p class="logout">Successfuly Registration </p>';
				 		}
				  ?>
				

				<p>
					<b>Item Name :</b>	<input type="text" name='item_name' id="" placeholder="watch" required style="width: 250px;">
					
				</p>
				<p>
					<b>Item Price :</b>	<input type="text" name='item_price' id="" placeholder="199" required style="width: 250px;">

				</p>	
				
				<p>
					<b>Item Image :</b>	<input type='file' name="item_image" onchange="readURL(this);" style="width: 250px;">
					<img id="blah"   alt="item_image" />


				</p>	
				<p>
					<button type="submit" name="submit" style="width: 250px;" class="btn btn-primary">Add Item </button>
				</p>
				
			</fieldset>

		</form>


 </article>
</section>


</body>
</html>