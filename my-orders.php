<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
	header('Location: index.php');


}

$connect= mysqli_connect('localhost','root','','testing');

 ?>


 <!DOCTYPE html>
 <html>
 <head>
 	<title>My orders</title>
 	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
 </head>
 <body>
 	<span class="d-block p-3 bg-dark text-white">
 		<a href="cart.php" style="text-decoration: none; color: white"><h2>Cell Mart</h2></a>
 		<a href="logout.php" style="float: right; margin-top: -50px;">Logout</a>

 	</span>
 

	<?php 
   			if (isset($_GET['my_orders'])) {
   				$user_id = $_SESSION['user_id'];
   				$query=" SELECT * FROM orders_copy WHERE id = '{$user_id}' ORDER BY date_time DESC ";
   				$result = mysqli_query($connect,$query);
   				if (mysqli_num_rows($result) > 0) {
   					while ($row = mysqli_fetch_array($result)) 
   					{
   	?>
   						
 

			<br>
			<div class="jumbotron jumbotron-fluid"  >
				<div class="container">
					<p class="lead" style="font-size: 16px; font-family: 'Courier'">	
						Date/Time : <?php echo $row["date_time"]; ?><br>
						
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

								<br><br>
						<?php if ($row['status'] == 'Item Shipped') {
							$attr = 'lime';
						}else{
							$attr = 'red';
						}
						?>
						&nbsp&nbsp&nbsp		&nbsp 	<b>Status :</b> <mark style="background-color: <?php echo $attr; ?> ; border-radius: 7px ;"><?php echo $row['status']; ?></mark>
						
							</p>
					</div>
				
			</div>



			<?php
					}
				}
			

    	}
     		?>	


 </body>
 </html>

 