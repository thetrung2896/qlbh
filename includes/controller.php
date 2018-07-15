<?php 
	include 'includes/function.php';
	if (isset ($_POST['confirm'])) {
		$emp_id = $_SESSION['admin2'];
		$orderstotal = $_POST['orderstotal'];
		$date = date('Y-m-d H:i:s');
		$sql = mysqli_query ($connect,"INSERT INTO orders( `emp_id`, `orders_date`, `orders_total`, `orders_action`) VALUES ('$emp_id','$date','$orderstotal','Processed')");
										
		if ($sql) {
			echo 'Success hoa dón';
		}else{
			echo 'Error';
		}
		


		$orders_id = mysqli_insert_id($connect);
		$_SESSION['id'] = $orders_id;
		foreach($_SESSION['shopping_cart'] as $key =>$product){
			$product1 = $product['id'];
			$price = $product['price'];
			$quantity = $product['quantity'];
			$total = $quantity * $price;
			
			$sql1 = mysqli_query ($connect,"INSERT INTO `order_products`(`orders_id`, `id`, `order_price`, `order_quantity`, `order_total`) VALUES ('$orders_id','$product1','$price','$quantity','$total')");
						
			if ($sql1){
				echo 'Succes';
			}else{
				 echo 'Error';
			}
		}


		unset($_SESSION['shopping_cart']);	
		echo '<script type="text/javascript">
			window.location.href="index.php";
		</script>';
	}

?>

