<?php
	session_start();
	if(isset($_SESSION[user_id]))
		header( 'Location: newdrink.php' ) ;

?>
<html>
	<body>
	Logga in
	<form action="checklogin.php">
	E-mail<br>
	<input type="text" name="email" /><br>
	Lösenord<br>
	<input type="text" name="password" /><br>

	<button type="submit">Login</button>
	</form>
	Eller <a href="register.php">registrera</a> en ny användare
	
</body>
</html>
