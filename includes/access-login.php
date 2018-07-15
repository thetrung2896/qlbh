<?php
	include ("includes/function.php");
	if (isset ($_POST['sign'])) {
		$user = $_POST['email'];
		$password = md5($_POST['password']);
		
		$sql = mysqli_query ($connect,"SELECT * FROM emp WHERE emp_user = '$user'");
		
		$rows_sql = mysqli_fetch_array ($sql);
		
		
		if (mysqli_num_rows ($sql) == 0) {
			$kq = '<div class="alert alert-danger"><strong>Tài khoản không tồn tại!</strong></div>';
		}elseif ($password != $rows_sql['emp_password']) {
			$kq = '<div class="alert alert-danger"><strong>Sai mật khẩu!</strong></div>';	
		}else {
			$_SESSION['admin'] = $user;
			$_SESSION['admin1'] = $rows_sql['emp_name'];
			$_SESSION['admin2'] = $rows_sql['emp_id'];
			echo '<script type="text/javascript">
				window.location.href = "index.php";
			</script>';
		}
		
		
	}
?>