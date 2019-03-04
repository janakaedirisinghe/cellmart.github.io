

 

<?php 
 //check if a user log
session_start();
 if (!isset($_SESSION['user_id'])) {
 	header('Location: index.php');
 	
 }
 ?>

<?php 



$user_id = $_SESSION['user_id'];

$connect = mysqli_connect("localhost", "root", "", "testing");


if(isset($_POST["add_to_cart"]))
{
	if(isset($_SESSION["shopping_cart"]))
	{
		$item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
		if(!in_array($_GET["id"], $item_array_id))
		{
			$count = count($_SESSION["shopping_cart"]);
			$item_array = array(
				'item_id'			=>	$_GET["id"],
				'item_name'			=>	$_POST["hidden_name"],
				'item_price'		=>	$_POST["hidden_price"],
				'item_quantity'		=>	$_POST["quantity"]
			);
			$_SESSION["shopping_cart"][$count] = $item_array;


		



		}
		else
		{
			echo '<script>alert("Item Already Added")</script>';
		}
	}
	else
	{
		$item_array = array(
			'item_id'			=>	$_GET["id"],
			'item_name'			=>	$_POST["hidden_name"],
			'item_price'		=>	$_POST["hidden_price"],
			'item_quantity'		=>	$_POST["quantity"]
		);
		$_SESSION["shopping_cart"][0] = $item_array;
			
			
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
				echo '<script>window.location="cart.php"</script>';
			}
		}
	}
}



?>
<!DOCTYPE html>
<html>
	<head>
		<title>Shopping Cart</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/main.css">



	</head>
	<body class="cart">
		
		<header>
	
	<div class="appname"><H6>  &nbsp &nbsp  Cell Mart</H6></div>
	<div class="loggedin"><mark><b>Hi <?php echo $_SESSION['first_name'];?>!</b></mark><a href="user-modify.php?user_id=<?php echo $user_id; ?>" style="padding-left: 30px;">&nbspMy Account&nbsp</a><a href="logout.php" style="padding-left: 20px;"> Log Out </a><a href="my-orders.php?my_orders=yes" style="padding-left: 20px;">My orders</a></div>


	<br>
	<br>
	<div class="loggedin"><a href="buy-item.php?action="><button type="button" class="btn btn-primary">
  Goto My Cart <span class="badge badge-light"><?php 

  if (!isset($_SESSION['shopping_cart'])) {
  	echo "0";
  }else{
  	 echo sizeof($_SESSION['shopping_cart']);
  }


  ?></span>
</button></a>

</div>



	


</header>



		<div class="container">
			<br />
			<br />
			<br />
			<br />
			<br /><br />
			<?php
				$query = "SELECT * FROM tbl_product ORDER BY id ASC";
				$result = mysqli_query($connect, $query);
				if(mysqli_num_rows($result) > 0)
				{
					while($row = mysqli_fetch_array($result))
					{
				?>
			<div class="col-md-3">
				<form method="post" action="cart.php?action=add&id=<?php echo $row["id"]; ?>">
					<div style="border:1px dashed	#484848; background-color:#eee; border-radius:15px; padding:16px;" align="center">
						

						<h4 class="text-info"><?php echo $row["name"]; ?></h4>
						<img src="images/<?php echo $row["image"]; ?>" class="img-responsive" >

						<h4 class="text-danger">Rs: <?php echo number_format($row["price"], 2); ?></h4>

						<input type="text" name="quantity" value="1" class="form-control" >

						<input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" >

						<input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" >

						<input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-light" value="Add to Cart" >

					</div>
				</form>                  
			</div>
			<?php
					}
				}

			?>
			<div style="clear:both"></div>
			<br />
<!--			
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
						<td><a href="cart.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
					</tr>
					<?php
							$total = $total + ($values["item_quantity"] * $values["item_price"]);
							
						}
					?>
					<tr>
						<td colspan="3" align="right">Total</td>
						<td align="right">Rs: <?php echo number_format($total, 2); ?></td>
						<td><td><a href="buy-item.php?action="><span class="text-danger">Buy</span></a></td></td>
					</tr>
					<?php
						
					}
					?>
					

					
						
				</table>
			</div>
		</div>
	</div>
	<br />
-->	
	</body>
</html>

<?php
//If you have use Older PHP Version, Please Uncomment this function for removing error 

/*function array_column($array, $column_name)
{
	$output = array();
	foreach($array as $keys => $values)
	{
		$output[] = $values[$column_name];
	}
	return $output;
}*/
?>

<?php
mysqli_close($connect);
?>