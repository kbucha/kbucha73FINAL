<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<?php include("includes/header.html"); ?>
</head>
<body>

<h1>ESRB Ratings</h1>

<?php
session_start();

#Login
require_once 'includes/login.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$query = "SELECT * FROM rating";

$result = $conn->query($query);
if (!$result) die ("Database access failed: " . $conn->error);
$rows = $result->num_rows;

#print_r ($result);

echo "<table>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>"."<td>"."<img src=\"pictures/".$row["esrb_symbol"]."\">"."</td>"."<td>"."<h2>".$row["esrb"]."</h2>".$row["rating_description"]."</td>";	
    	
	echo "</tr>";
	}
echo "</table>";
?>


</body>
</html>