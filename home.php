<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<?php include("includes/header.html"); ?>
<title>Video Games</title>
</head>
<body>

<h1>Browse Games</h1>

<?php

#Login
require_once 'includes/login.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$query = "SELECT * FROM game NATURAL JOIN game_to_platform NATURAL JOIN platform 
		NATURAL JOIN rating";

$result = $conn->query($query);
if (!$result) die ("Database access failed: " . $conn->error);
$rows = $result->num_rows;

#print_r ($result);

echo "<table><tr><th>Title</th><th>Date</th><th>Price</th><th>Platform</th>
	<th>ESRB</th></tr>";
while ($row = $result->fetch_assoc()) {
	echo '<tr>';
	//Link game to game page @ viewgame.php
	echo "<td>"."<a href=\"viewgame.php?asin=".$row["asin"]."\">".$row["title"]."</td><td>".$row["date"]."</td><td>"."$".$row["price"]."</td>
	<td>".$row["platform"]."</td><td>";
    echo "<a href=\"esrb.php?asin=".$row["esrb"]."\">".$row["esrb"]."</td>";		
	echo '</tr>';
	
	}
echo "</table>";
?>  


</body>
</html>