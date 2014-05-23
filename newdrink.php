<?php
session_start();
if(!isset($_SESSION[user_id])){
	die("Access denied");
}
	
$link = mysqli_connect("localhost", "maxwe", "maxwe-xmlpub13", "maxwe") or die("Could not connect"  . mysql_error());

if(!empty($_GET["name"])){
	echo "Due";
	
	$query = "INSERT INTO drinks (name , imagelink,  description , user_id) VALUES ('$_GET[name]', '$_GET[imagelink]', '$_GET[description]', '$_SESSION[user_id]')";
						
	$result = mysqli_query($link, $query) or die("Query failed " . $query);
				
	$query = "SELECT * from drinks WHERE name='$_GET[name]'";
	
	$drink = mysqli_query($link, $query) or die("Query failed " . $query);
	
	$drink = mysqli_fetch_object($drink);
	
	$query = "SELECT * FROM ingredients";
						
	$ing = mysqli_query($link, $query) or die("Query failed " . $query);

	for($i = 0; $i < sizeof($_GET["amount"]); $i++){
		$ami = $_GET["amount"][$i];
		$inga = mysqli_fetch_object($ing);
		if(!empty($ami)){
			$query = "INSERT INTO drinks_ingredients (drink_id, ingredient_id, amount) VALUES('$drink->drink_id', '$inga->ingredient_id', '$ami')";
			$res = mysqli_query($link, $query) or die("Query failed " . $query);
		}
	}
}
?>
<html>
	<body>
		<form>
			Drinknamn<br>
			<input type="text" name="name" value=""><br>
			Bildlänk<br>
			<input type="text" name="imagelink" value=""><br>
			Beskrivning<br>
			Beskrivning<br>
			<textarea name="description"></textarea>
			<br>
			Ingridienser<br>
			<?php
			$query = "SELECT name
						FROM ingredients";

			$result = mysqli_query($link, $query)
				or die("Query failed" . $query);
			
			echo "Ingrediens 	M'a'ngd 	Enhet<br>";
			while ($line = mysqli_fetch_object($result)) {
				$name = htmlspecialchars($line->name);

				echo "$name	";
				echo "<input type=\"text\" size=\"3\" name=\"amount[]\">	";
				echo "<br>";
				
			}
			?>
			<br>
			<button type="submit">L'a'gg till!</button>

</form> 
<?php
if(!empty($_GET["name"])){
	
	for($i = 0; $i < sizeof($_GET["amount"]); $i++){
		$am = $_GET["amount"][$i];
		echo " $am<br>";
	}
}
?>
	<a href="./">Tillbaka till drinklistan</a>
	</body>
</html>
