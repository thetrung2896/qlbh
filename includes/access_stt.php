<?php
	if (isset ($_POST['update_stt'])) {
		$id = $_POST['update_stt'];
		$stt = $_POST['stt'];
		foreach ($stt as $key => $value) {
			// echo '<pre>';
			// var_dump($key);
			// var_dump($value);
			// echo '</pre>';
			$sql = mysqli_query ($connect,"UPDATE orders SET orders_action = '$value' WHERE orders_id = '$key'");
			if ($sql){
				// echo 'thanh cong';
			}else{

				// echo 'that bai';
			}
		}
		
		
	}


 ?>