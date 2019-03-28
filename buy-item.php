<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
 	header('Location: index.php');
 	
 }

$connect = mysqli_connect("localhost", "root", "", "testing");

?> 

<?php



if(isset($_GET["action"]))
{
	if($_GET["action"] == "ordered")
	{
		

			$serialize_array = serialize($_SESSION['shopping_cart']);
			$strenc = urlencode($serialize_array);
			$arr = unserialize(urldecode($strenc));

			
						
						//echo "<pre>";
						//print_r($arr);
						//echo "</pre>";


			//insert order items into orders table

			$user_id = $_SESSION['user_id'];
			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$email = $_SESSION['email'];
			$address = $_POST['address'];
			$phone_number = $_POST['phone_number'];
			$payment_method = $_POST['payment_method'];
	
			$query ="INSERT INTO orders(id,email,full_name,address,phone_number,payment_method,items,date_time) 
					VALUES ('{$user_id}','{$email}','{$first_name}','{$address}','{$phone_number}','{$payment_method}','{$serialize_array}',NOW())"; 

			$query_copy = "INSERT INTO orders_copy(id,email,full_name,address,phone_number,payment_method,items,date_time) 
					VALUES ('{$user_id}','{$email}','{$first_name}','{$address}','{$phone_number}','{$payment_method}','{$serialize_array}',NOW())"; 

			$result=mysqli_query($connect,$query);
			$result_copy = mysqli_query($connect,$query_copy);


			if ($result) {
				echo '<script>alert("Thank You! Happy Shopping!")</script>';
				unset($_SESSION['shopping_cart']);
				echo '<script>window.location="cart.php"</script>';
			}else
				{
					echo '<script>alert("Error")</script>';
				}
   						
						
					 //display user selected items table

			
			



	}
}


if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete")
	{
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			if($values["item_id"] == $_GET["id"])
			{
				unset($_SESSION["shopping_cart"][$keys]);
				echo '<script>alert("Item Removed")</script>';
				echo '<script>window.location="buy-item.php"</script>';
			}
		}
	}
}




?>


<!DOCTYPE html>
<html>
<head>
	<title>Buy Item </title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	<header>
	<div class="appname"><h6>Cell Mart</h6></div>
	<div class="loggedin"><mark>Welcome <?php echo $_SESSION['first_name'];?> </mark>&nbsp <a href="logout.php" style="text-decoration: none;color: white"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Log Out</a></div>
	</header>
	<h3><a href="cart.php"> << Back to cart </a></h3>



			<h3>Order Details</h3>
			<div class="table-responsive">
				<table class="table table-bordered">
					<tr>
						<th width="40%">Item Name</th>
						<th width="10%">Quantity</th>
						<th width="20%">Price</th>
						<th width="15%">Total</th>
						<th width="5%">Action</th>
					</tr>
					<?php
					if(!empty($_SESSION["shopping_cart"]))
					{
						$total = 0;
						foreach($_SESSION["shopping_cart"] as $keys => $values)
						{
					?>
					<tr>
						<td><?php echo $values["item_name"]; ?></td>
						<td><?php echo $values["item_quantity"]; ?></td>
						<td>Rs: <?php echo $values["item_price"]; ?></td>
						<td>Rs: <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
						<td><a href="buy-item.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
					</tr>
					<?php
							$total = $total + ($values["item_quantity"] * $values["item_price"]);
						}
					?>
					<!--<tr>
						<td colspan="3" align="right">Total</td>
						<td align="right">$ <?php echo number_format($total, 2); ?></td>
						<td></td>
					</tr>-->
					<?php
					}
					?>

				
						
				</table>

			<br>
			</div>
	<!--order form-->
			<div class="order">

			<form action='buy-item.php?action=ordered' method="POST" class="userform">
		
		<p>
			<label for="">First Name:</label>
			<input type="text" name="first_name" <?php echo 'value="' . $_SESSION['first_name'] .'"'; ?>  >	
		</p>
		<p>
			<label for="">Last Name:</label>
			<input type="text" name="last_name" <?php echo 'value="' . $_SESSION['last_name'].'"'; ?> >	
		</p>
		<p> 
			<label for="">Address:</label>
			<input type="text" name="address"  >
		</p>
		<p> 
			<label for="">Phone Number:</label>
			<input type="text" name="phone_number"  >
		</p>
		<p>
			<label for="">Payment method:</label>
			<select name="payment_method" size="1">
   			 	<option value="credit_card">Credit Card</option>
    			<option value="Paypal">Paypal</option>
   				
 			 </select>
		</p>
		
		<p> 
			<label for="">Total Amount:</label>
			<input type="text" name="total_amount" readonly <?php if(!isset($total)){echo "value=0.00";}else{echo 'value="' . number_format($total, 2).'"';} ?> >
		</p>
		<p>
			<button type="submit" name="submit">Pay & Order</button>
		</p>
	</form>
	</div>

</body>
</html>

<?php
mysqli_close($connect);
?>