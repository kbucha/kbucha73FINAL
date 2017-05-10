<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<?php include("includes/header.html"); ?>
<title>Video Games</title>
</head>
<body>

<?php include("includes/header.html"); ?>
<?php
require_once 'includes/login.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);
//print_r ($_GET);
if (isset($_GET['asin'])) {
	$id = sanitizeMySQL($conn, $_GET['asin']);
	$query = "SELECT * FROM game NATURAL JOIN publisher NATURAL JOIN developer NATURAL JOIN rating WHERE asin=\"$id\"";
	//echo $query;
	$result = $conn->query($query);
	if (!$result) die ("Invalid ASIN.");
	$rows = $result->num_rows;
	if ($rows == 0) {
        echo '<h1>Browse Game</h1>';
        
		echo "No game found for ASIN: $id<br>";
       
	} else {
		while ($row = $result->fetch_assoc()) {
			echo '<h1>Browse Game</h1>';
			echo "<img src=\"pictures/".$row["image"]."\"height=\"250\" width=\"500\">"."<br>"."<h3>"."Title"."</h3>".$row["title"]."<p>"."<h3>"."Description"."</h3>".$row["description"]."<h3>"."Price"."</h3>"."$".$row["price"]."<h3>"."Player(s)"."</h3>".$row["player"]."<h3>"."Publisher / Developer"."</h3>".$row["pub_name"]." / ".$row["dev_name"]."<h3>"."ESRB Rating"."</h3>".$row["esrb"]."<br>".$row["rating_description"];		
		}
	}

} 

function sanitizeString($var)
{
	$var = stripslashes($var);
	$var = strip_tags($var);
	$var = htmlentities($var);
	return $var;
}
function sanitizeMySQL($connection, $var)
{
	$var = sanitizeString($var);
	$var = $connection->real_escape_string($var);
	return $var;
}
?>
</body>
</html>
