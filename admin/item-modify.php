<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
 	header('Location: admin-login.php');
 	
 }
$connect = mysqli_connect("localhost", "root", "", "testing");

 ?>

<?php 
	$item_id='';
	$errors =array();
	$item_name='';
	$item_price = '';
	$item_image = '';

	

		if (isset($_GET["action"])) {
			
			$item_id = mysqli_real_escape_string($connect,$_GET['id']);
			$_SESSION['item_id'] = $item_id;
			$query = "SELECT * FROM tbl_product WHERE id = {$item_id} LIMIT 1 ";
			$result_set = mysqli_query($connect,$query);
			if ($result_set) {
				if (mysqli_num_rows($result_set)==1) {
					$result = mysqli_fetch_assoc($result_set);
					$item_name=$result['name'];
					$item_price=$result['price'];
					$item_image =$result['image'];
					$category=$result['category'];

					switch ($category) {
						case '1':
							$category_name  = "Samsung";
							break;
						case '2':
							$category_name = 'apple';
							break;
						default:
							$category_name = 'null';
							break;
					}



				}else{
					header('Location: admin-activity.php?modify=error1');
				}
			}else
			{
				header('Location: admin-activity.php?modify=error2');
			}
		}

		if(isset($_POST['submit'])) {
 					$item_name = $_POST['item_name'];
 					$item_price = $_POST['item_price'];
 					$item_image = $_POST['item_image'];
 					echo $item_id;

 					

 				$query = "UPDATE tbl_product SET name='{$item_name}',price = '{$item_price}' WHERE id = {$_SESSION['item_id']}  ";
 				$result = mysqli_query($connect,$query);

 					if ($result) {

 						header('Location: admin-activity.php?items=yes');

 					}else{
 						//header('Location: admin-activity.php?modify=errors');
 						echo $item_id;
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
<body background="img/1.jpg">

		<div class='login'>

		<form action="item-modify.php" method="POST">
			
			<fieldset>
				<legend><h1> Item Modify</h1></legend>
				<br>
				<h5><a href="admin-activity.php?items=yes">Admin page</a></h5>

				

				 
					
				
				

				<p>
					<b>Item Name :</b>	<input type="text" name='item_name' id="" <?php echo 'value="' . $item_name.'"'; ?> required>
					
				</p>
				<p>
					<b>Item Price :</b>	<input type="text" name='item_price' id="" <?php echo 'value="' . $item_price.'"'; ?> required>

				</p>
				<p>
						<label for="">Item Category:</label>
						<?php echo $category_name; ?>
							
				</p>	
				<p>
					<b>Item Image :</b>	<input type='file' name="item_image" onchange="readURL(this);" />
				<img id="blah" <?php echo 'src="../images/'.$item_image.'"'; ?> alt="item_image" />


				</p>	
				<p>
					<button type="submit" name="submit">Modify Item </button>
				</p>
				
			</fieldset>

		</form>


	</di


</body>
</html>