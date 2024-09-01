
<?php
$servername = "localhost";
$username = "gisaps";
$password = "gisAPS12";
$dbname = "gisaps";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT pii FROM data";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
	 			
	 echo $row['pii'];
	echo ";";
	  
  }
}

$conn->close();
	
?>
