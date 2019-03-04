<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
 	header('Location: admin-login.php');
 	
 }
$connect = mysqli_connect("localhost", "root", "", "testing");

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
<title>Admin</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" type="text/css" href="../css/main.css">
<link rel="stylesheet" type="text/css" href="../css/admin.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />

		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

		


</head>
<body style="background-color: white;">





<section>
  <nav><h3><a href="logout-admin.php">Hello <?php echo $_SESSION['email'];?>  <span class="badge">Logout</span></a></h3>
  	<!--<div style="color: white;margin-top: 20px;margin-bottom: 30px;" class="loggedin">Welcome <?php echo $_SESSION['email'];?> !<a href="logout-admin.php"> Log Out</a></div>-->
    <ul style="padding-top: 30px;">
      <li><a href="admin-activity.php?items=yes" class="badge badge-light"><span class="glyphicon glyphicon-th-large"></span> Items</a></li><br>
      <li><a href="item-add.php" class="badge badge-light"><span class="glyphicon glyphicon-plus"> </span> Add Items</a></li><br>
      <li><a href="admin-activity.php?order=yes" class="badge badge-light"><span class="glyphicon glyphicon-sort"></span> User Orders</a></li><br>
      <li><a href="admin-activity.php?order_copy=yes" class="badge badge-light"><span class="glyphicon glyphicon-ok"></span> Orders Histry</a></li><br>
      <li><a href="ams/ams.php" class="badge badge-light"><span class="glyphicon glyphicon-user"></span> Admin Manager</a></li>


      
    </ul>

  </nav>
  
  <article>

  			

 <!--items display-->
    <?php 
    		if (isset($_GET['items'])) 

    		{	
    			
				$query = "SELECT * FROM tbl_product ORDER BY id ASC";
				$result = mysqli_query($connect, $query);
				if(mysqli_num_rows($result) > 0)
				{
					while($row = mysqli_fetch_array($result))
					{
				?>
			<div class="col-md-2">
				<form method="post" action="cart.php?action=add&id=<?php echo $row["id"]; ?>">
					<div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">
						

						<h5 class="text-info"><?php echo $row["name"]; ?></h5>

						<h5 class="text-danger">Rs: <?php echo $row["price"]; ?></h5>
						<img src="../images/<?php echo $row["image"]; ?>" class="img-responsive" /><br />
						<a href="item-modify.php?action=modify&id=<?php echo $row["id"]; ?>">Edit </a><a href="item-delete.php?action=delete&id=<?php echo $row["id"]; ?>">| Delete</a>

						

					</div>
				</form>
			</div>
			<?php
					}
				}
			

    	}
     		?>	

   <!--orders display-->

   	<?php 
   			if (isset($_GET['order'])) {
   				
   				$query=" SELECT * FROM orders ORDER BY id ASC ";
   				$result = mysqli_query($connect,$query);
   				if (mysqli_num_rows($result) > 0) {
   					while ($row = mysqli_fetch_array($result)) 
   					{
   	?>
   						
 

			<br>
			<div class="jumbotron" style="padding-left: 50px;">
					
						User ID : <?php echo $row["id"]; ?> <br>
						Name : <?php echo $row["full_name"]; ?> <br>					
						Email : <?php echo $row["email"]; ?><br>		
						Address : <?php echo $row["address"]; ?><br>
						Phone : <?php echo $row["phone_number"]; ?> <br>
						Payment Method : <?php echo $row["payment_method"]; ?> <br>
							<?php $strenc = urlencode($row["items"]);?>
							<?php $arr = unserialize(urldecode($strenc)); ?>
							<?php $arraay = array_column($arr,'item_quantity' , 'item_name'); ?> 
						Items : 

								<?php 
								foreach ($arraay as $k => $v) {
										echo  "<br>  $k --> $v " ;								    
								}
								?>

								<br><br>
						<a href="item-sent.php?action=sent&id=<?php echo $row["id"]; ?>"> | item Sent |</a>
							
					
				
			</div>



			<?php
					}
				}
			

    	}
     		?>	

<!--orders histry display -->
   

   	<?php 
   			if (isset($_GET['order_copy'])) {
   				
   				$query=" SELECT * FROM orders_copy ORDER BY date_time DESC ";
   				$result = mysqli_query($connect,$query);
   				if (mysqli_num_rows($result) > 0) {
   					while ($row = mysqli_fetch_array($result)) 
   					{
   	?>
   						
 

			<br>
			<div style="background-color:black;color:white;padding:20px; ">
					
						User ID : <?php echo $row["id"]; ?> <br>
						Name : <?php echo $row["full_name"]; ?> <br>					
						Email : <?php echo $row["email"]; ?><br>		
						Address : <?php echo $row["address"]; ?><br>
						Phone : <?php echo $row["phone_number"]; ?> <br>
						Payment Method : <?php echo $row["payment_method"]; ?> <br>
							<?php $strenc = urlencode($row["items"]);?>
							<?php $arr = unserialize(urldecode($strenc)); ?>
							<?php $arraay = array_column($arr,'item_quantity' , 'item_name'); ?> 
						Items : 

								<?php 
								foreach ($arraay as $k => $v) {
										echo  " $k -> $v |" ;								    
								}
								?>

								<br>
						<a href="item-sent.php?action=sent&id=<?php echo $row["id"]; ?>"> | Delete from histry |</a>
							
					
				
			</div>



			<?php
					}
				}
			

    	}
     		?>	

  </article>
</section>


</body>
</html>
