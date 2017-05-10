<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<?php include("includes/header.html"); ?>
<title>Video Games</title>
</head>
<body>

<h1>Search Games</h1>
<div class="searchBox">
Please type the Title of the game you're looking for.    
</div>    
<div class="buttonHolder">
    <form  method="GET" action=""> 
    <input  type="text" name="name"> 
    <input  type="submit" name="submit" value="Search">
    <p></p> <!-- find out how to add PADDING for forms -->
    </form>
</div>
<?php
#Login
require_once 'includes/login.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);


if (isset($_GET["submit"])) {
	$id = sanitizeMySQL($conn, $_GET['name']);
	$query = "SELECT * FROM game NATURAL JOIN game_to_platform NATURAL JOIN platform NATURAL JOIN rating WHERE title like '%".$id."%'";
	$result = $conn->query($query);
	if (!$result) die ("Invalid Input");
	$rows = $result->num_rows;
	if ($rows == 0) {
		echo '<div class="searchError">';
        echo "Game does not exist in this collection.<br> Please try again.";
        echo '</div>';
	} else {
        echo "<table><tr><th>Title</th><th>Date</th><th>Price</th><th>Platform</th>
	<th>ESRB</th></tr>";
		while ($row = $result->fetch_assoc()) {
		echo '<tr>';
	   //Link game to game page @ viewgame.php
	   echo "<td>"."<a href=\"viewgame.php?asin=".$row["asin"]."\">".$row["title"]."</td><td>".$row["date"]."</td><td>"."$".$row["price"]."</td>
	   <td>".$row["platform"]."</td><td>".$row["esrb"]."</td>";		
	echo '</tr>';
        
        }
    echo "</table>";
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