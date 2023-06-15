<html>
<body>
  <h1>Detaildaten Daten holen</h1>  
<?php
$id = $_REQUEST["id"];   // Lesen des Parameters

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "artikel2023";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, name, beschreibung FROM artikel where id = $id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row"
  if($row = $result->fetch_assoc()) {
    echo "ID: " . $row["id"] .  "<br>";
    echo "Name:  " . $row["name"] . "<br>"; 
    echo "Beschreibung: " . $row["beschreibung"] . "<br>";
    echo "<p> <a href='datenholen.php'>Zur Übersicht</a></p>";
    }
} else {
  echo "0 results";
}
$conn->close();
?> 

</body>
</html>
