<?php
	session_start();
	if(isset($_GET["email"]) && isset($_GET["password"]) && isset($_GET["username"])){
		$link = mysqli_connect("localhost", "maxwe", "maxwe-xmlpub13", "maxwe") or die("Could not connect"  . mysql_error());
		$query = "SELECT * from users WHERE email='$_GET[email]'";
		$result = mysqli_query($link, $query) or die("Query failed " . $query);
		if($result->num_rows == 0){
			$query = "INSERT INTO users (email , password , username) VALUES ('$_GET[email]', '$_GET[password]', '$_GET[username]')";
			$result = mysqli_query($link, $query) or die("Query failed " . $query);
			header( 'Location: login.php' ) ;
		}
	}

?>
<html>
	<body>
	Användaruppgifter
	<form action="register.php">
	E-mail<br>
	<input type="text" name="email" /><br>
	Lösenord<br>
	<input type="text" name="password" /><br>
	Namn<br>
	<input type="text" name="username" /><br>

	<button type="submit">Login</button>
	</form>
</body>
</html>
