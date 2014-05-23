<?php
session_start();
// if debug is set to 1, the XML structure is printed instead of the result of the transformation
$debug = 0;

if($debug) {
	header("Content-type:text/xml");
} else {
	include("prefix.php");
}
?>
 <drinklist>
 <?php  
    // connect to the dbm on localhost with the username cappe and password cappe
    $link = mysqli_connect("localhost", "maxwe", "maxwe-xmlpub13", "maxwe") or die("Could not connect"  . mysql_error());
    // choose the database cappe
    //mysqli_select_db("maxwe") or die("Could not select database");
    $returnstring ="";
    
    $terms = strtolower($_GET["filter"]);
    $terms = explode(" ", $terms);
    
    $filter = array();
    if(!empty($_GET["filter"])){
		 foreach ($terms as $term) {
			 $query = "SELECT * from drinks WHERE name='$term'";
			 $result = mysqli_query($link, $query) or die("Query failed" . $query);
			 if(mysqli_num_rows($result) == 1){
				 $d = mysqli_fetch_object($result);
				 array_push($filter, $d->drink_id);
			 }
			 $query = "SELECT * FROM drinks_ingredients NATURAL JOIN ingredients WHERE name='$term'";
			 $result = mysqli_query($link, $query) or die("Query failed" . $query);
			 while ($line = mysqli_fetch_object($result)){
				 if(!in_array($filter, $line->drink_id))
					array_push($filter, $line->drink_id);
			 }
		}
	}
    // the query
    $query = "SELECT * from drinks NATURAL JOIN users";

    // execute the query
    $result = mysqli_query($link, $query)
        or die("Query failed" . $query);
        
    // loop over all lines returned by the query. Make sure special characters are replaced.
    while ($line = mysqli_fetch_object($result)) {
        // store content in variables
        $id = $line->drink_id;
        $uid = $line->user_id; 
        if(!empty($_GET["filter"]) && !in_array($id, $filter))
			continue;
			
        $name = htmlspecialchars($line->name);
        $imagelink = htmlspecialchars($line->imagelink); 
        $username = htmlspecialchars($line->username); 
        $description = htmlspecialchars($line->description);
        
        // add one word to the result
        // concatenate strings with "."
        $returnstring = $returnstring . "<drink id=\"$id\">";
        $returnstring = $returnstring . "<name>$name</name>";
        $returnstring = $returnstring . "<imagelink>$imagelink</imagelink>";
        $returnstring = $returnstring . "<author uid=\"$uid\">$username</author>"; 
        $returnstring = $returnstring . "<description>$description</description>";
        $query = "SELECT * from drinks_ingredients NATURAL JOIN ingredients WHERE drink_id='$id'";
        $result2 = mysqli_query($link, $query) or die("Query failed" . $query);
        while ($line2 = mysqli_fetch_object($result2)) {
			$returnstring = $returnstring . "<ingredience amount=\"$line2->amount\">$line2->name</ingredience>";
		}
        
        $returnstring = $returnstring . "</drink>";
    }
    
    // convert the result to utf8 before it is printed (often not necessary)
    print utf8_encode($returnstring); 
    ?>
</drinklist>
<?php 
if (!($debug)) {
	// do the transformations. Look in the file postfix.php to see how it works.
	include("postfix.php");
}
?>
