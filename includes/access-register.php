<?php
include 'includes/function.php';
	if (isset ($_POST['register'])) {
		$emp_name = $_POST['name'];
		$emp_user = $_POST['user'];
		$emp_password = $_POST['password'];
		$emp_email = $_POST['email'];
		$emp_phone = $_POST['phone'];
		$password2 = $_POST['repassword'];

		$check_user = mysqli_query ($connect,"SELECT * FROM emp WHERE emp_user ='$emp_user'");
		$check_email = mysqli_query ($connect,"SELECT * FROM emp WHERE emp_email = '$emp_email'");
		//$rows = mysql_fetch_array($select);

		if (mysqli_num_rows($check_user) ==	 1 ){
			$result = 'Accounts already exists.';
		}elseif (mysqli_num_rows($check_email) == 1) {
			$result = 'email already exists';
		}elseif ($password2 != $emp_password) {
			$result = 'Password match not match.';
		}else{
			$password3 = md5($emp_password);
			$sql = mysqli_query ($connect,"INSERT INTO emp (emp_name, emp_user, emp_password, emp_email, emp_phone) VALUES ('$emp_name','$emp_user','$password3','$emp_email','$emp_phone')");
			if ($sql){
				$result = 'Success';
			}else{
				$result = 'Error';
			}
		}
	}else{
		$result = 'There was an error occurred in the registered loger, please try again!';
	}



?>