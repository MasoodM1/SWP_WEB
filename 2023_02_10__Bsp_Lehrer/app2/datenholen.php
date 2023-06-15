
<html>
<body>
  <h1>Daten holen</h1>  
  <p><a href="eingabe.html">Neuer Eintrag</a></p>
<?php
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

$sql = "SELECT id, name, beschreibung FROM artikel";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<table>";
  while($row = $result->fetch_assoc()) {
    // output data of each row"
    echo "<tr>";
    echo "<td>" . $row["id"] .  "</td>";
    echo "<td>  " . $row["name"] . "</td>"; 
    echo "<td>" . $row["beschreibung"] . "</td>";
    echo "<td> <a href='detail.php?id=" . $row["id"] ."'>Detail</a></td>";
	  echo "<td> <a href='delete.php?id=" . $row["id"] ."'>Löschen</a></td>";
    echo "</tr>";
}
  echo "</table>";
} else {
  echo "0 results";
}
$conn->close();
?>

</body>
</html>
