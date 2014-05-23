<?php
	session_start();
	if(!isset($_SESSION[user_id]))
		header( 'Location: ./' ) ;
		
	$id = $_GET["drink_id"];
	
	$link = mysqli_connect("localhost", "maxwe", "maxwe-xmlpub13", "maxwe") or die("Could not connect"  . mysql_error());
	
	$query = "DELETE FROM  drinks_ingredients WHERE drink_id=$id";
	$result = mysqli_query($link, $query) or die("Query failed " . $query);
	
	$query = "DELETE FROM drinks WHERE drink_id=$id";
	$result = mysqli_query($link, $query) or die("Query failed " . $query);
	
	header( 'Location: ./' ) ;
?>

