<?php

if(isset($_POST['register'])){
	$Username = addslashes($_POST['username']);
	$Password = $_POST['password'];

	if(checkUsername($Username, $conn)){
		$userid = genUID($conn);
		$hashed_password = password_hash($Password, PASSWORD_DEFAULT);

		$sql = "INSERT INTO `users`(`userid`, `username`, `password`) VALUES ('" . strval($userid) . "','" . $Username . "','" . $hashed_password . "')";

		$insertUser = $conn->query($sql);
		if($insertUser) {
			echo 'User added successfully.';
			sleep(1);
			$cookie_name = "loggedin";
			$cookie_value = $Username;
			setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
			header("Location: ?");
		}
	}

}

function checkUsername($username, $conn){
	$sql = "SELECT * FROM users WHERE username LIKE '" . $username . "'";
	$checkUsername = $conn->query($sql);

	if($checkUsername->num_rows === 0){
		return true;
	}else{
		return false;
	}
}

function genUID($conn){
	$six_digit_random_number = mt_rand(100000, 999999);
	$sql = "SELECT * FROM users WHERE userid LIKE '" . strval($six_digit_random_number) . "'";
	$checkUID = $conn->query($sql);

	if($checkUID->num_rows === 0){
		return $six_digit_random_number;
	}else{
		genUID($conn);
		echo 'error genuid, already in use, trying again.';
	}
}

?>

<body>
	
	
	<form id="register-form" action="#" method="POST">	
		<input type="text" name="username" placeholder="Username"><br>
		<input type="password" name="password" placeholder="Password"><br>
		<input type="submit" name="register" value="Register">
		<a href="?signin=true" id="signin">sign in</a>
	</form>
	
</body>