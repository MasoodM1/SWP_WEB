<?php
$id = $_REQUEST["id"];   // Lesen der Parameter

// Schreiben in die DB
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

$sql = "delete from artikel where id = $id";
$result = $conn->query($sql);

$conn->close();

// Seite datenholen.php anzeigen
header("Location: datenholen.php");
?>