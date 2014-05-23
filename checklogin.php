<?php
session_start();

	$link = mysqli_connect("localhost", "maxwe", "maxwe-xmlpub13", "maxwe") or die("Could not connect"  . mysql_error());
	$query = "SELECT * from users WHERE email='$_GET[email]'";
	$result = mysqli_query($link, $query) or die("Query failed " . $query);
	$user = mysqli_fetch_object($result);
	
	if($user->password == $_GET[password]){
		$_SESSION["user_id"] = $user->user_id;
		$_SESSION["username"] = $user->username;
	}
	header( 'Location: ./' ) ;
?>

