<?php
	session_start();
	include 'includes/conn.php';

	if(isset($_POST['login'])){
		$username = $_POST['username'];
		$password = $_POST['password'];

		$sql = "SELECT * FROM admin WHERE username = '$username'";
		$query = $conn->query($sql);

		if($query->num_rows < 1){
			$_SESSION['error'] = 'کاربری با این نام کاربری یافت نشد';
		}
		else{
			$row = $query->fetch_assoc();
			if(password_verify($password, $row['password'])){
				$_SESSION['admin'] = $row['id'];
			}
			else{
				$_SESSION['error'] = 'گذرواژه درست نیست';
			}
		}
		
	}
	else{
		$_SESSION['error'] = 'اطلاعات کاربر را وارد کنید';
	}

	header('location: index.php');

?>