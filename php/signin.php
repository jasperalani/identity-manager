<?php

if(isset($_POST['signin'])){
	$Username = addslashes($_POST['username']);
	$Password = $_POST['password'];

	$sql = "SELECT * FROM users WHERE username LIKE '" . $Username . "'";
	$getUser = $conn->query($sql);

	if($getUser->num_rows >= 1) {
		$foundUser = $getUser->fetch_assoc();
		if(password_verify($Password, $foundUser['password'])) {
			sleep(1);
			$cookie_name = "loggedin";
			$cookie_value = $Username;
			setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
			header("Location: ?");
		}
	}

}

?>

<body>
	
	<form id="signup-form" action="#" method="POST">
		<input type="text" name="username" placeholder="Username"><br>
		<input type="password" name="password" placeholder="Password"><br>
		<input type="submit" name="signin" value="Sign in">
		<a href="?register=true" id="register">register</a>
	</form>

</body>